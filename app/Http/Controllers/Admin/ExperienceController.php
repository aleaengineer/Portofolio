<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ExperienceController extends Controller
{
    /**
     * Daftar riwayat pengalaman.
     */
    public function index(): View
    {
        $experiences = Experience::query()
            ->orderBy('sort_order')
            ->orderByDesc('start_date')
            ->paginate(15)
            ->withQueryString();

        return view('admin.experiences.index', [
            'experiences' => $experiences,
        ]);
    }

    /**
     * Form tambah pengalaman.
     */
    public function create(): View
    {
        return view('admin.experiences.create', [
            'experience' => new Experience(['sort_order' => 0]),
        ]);
    }

    /**
     * Simpan pengalaman baru.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateRequest($request);
        $experience = Experience::create($validated);

        return redirect()
            ->route('admin.experiences.index')
            ->with('success', "Pengalaman \"{$experience->position}\" berhasil ditambahkan.");
    }

    /**
     * Form edit pengalaman.
     */
    public function edit(Experience $experience): View
    {
        return view('admin.experiences.edit', [
            'experience' => $experience,
        ]);
    }

    /**
     * Perbarui pengalaman.
     */
    public function update(Request $request, Experience $experience): RedirectResponse
    {
        $experience->update($this->validateRequest($request));

        return redirect()
            ->route('admin.experiences.index')
            ->with('success', "Pengalaman \"{$experience->position}\" berhasil diperbarui.");
    }

    /**
     * Hapus pengalaman.
     */
    public function destroy(Experience $experience): RedirectResponse
    {
        $position = $experience->position;
        $experience->delete();

        return back()->with('success', "Pengalaman \"{$position}\" berhasil dihapus.");
    }

    /**
     * Validasi yang dipakai store() dan update().
     */
    private function validateRequest(Request $request): array
    {
        $validated = $request->validate([
            'position' => ['required', 'string', 'max:255'],
            'company' => ['required', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'description' => ['nullable', 'string', 'max:5000'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
        ], [
            'position.required' => 'Posisi wajib diisi.',
            'company.required' => 'Perusahaan wajib diisi.',
            'start_date.required' => 'Tanggal mulai wajib diisi.',
            'end_date.after_or_equal' => 'Tanggal selesai tidak boleh sebelum tanggal mulai.',
        ]);

        $validated['sort_order'] = $request->integer('sort_order', 0);

        return $validated;
    }
}
