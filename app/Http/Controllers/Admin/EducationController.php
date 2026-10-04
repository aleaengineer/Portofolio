<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EducationController extends Controller
{
    /**
     * Daftar riwayat pendidikan.
     */
    public function index(): View
    {
        $educations = Education::query()
            ->orderBy('sort_order')
            ->orderByDesc('start_date')
            ->paginate(15)
            ->withQueryString();

        return view('admin.educations.index', [
            'educations' => $educations,
        ]);
    }

    /**
     * Form tambah pendidikan.
     */
    public function create(): View
    {
        return view('admin.educations.create', [
            'education' => new Education(['sort_order' => 0]),
        ]);
    }

    /**
     * Simpan pendidikan baru.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateRequest($request);
        $education = Education::create($validated);

        return redirect()
            ->route('admin.educations.index')
            ->with('success', "Pendidikan \"{$education->institution}\" berhasil ditambahkan.");
    }

    /**
     * Form edit pendidikan.
     */
    public function edit(Education $education): View
    {
        return view('admin.educations.edit', [
            'education' => $education,
        ]);
    }

    /**
     * Perbarui pendidikan.
     */
    public function update(Request $request, Education $education): RedirectResponse
    {
        $education->update($this->validateRequest($request));

        return redirect()
            ->route('admin.educations.index')
            ->with('success', "Pendidikan \"{$education->institution}\" berhasil diperbarui.");
    }

    /**
     * Hapus pendidikan.
     */
    public function destroy(Education $education): RedirectResponse
    {
        $institution = $education->institution;
        $education->delete();

        return back()->with('success', "Pendidikan \"{$institution}\" berhasil dihapus.");
    }

    /**
     * Validasi yang dipakai store() dan update().
     */
    private function validateRequest(Request $request): array
    {
        $validated = $request->validate([
            'institution' => ['required', 'string', 'max:255'],
            'degree' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'description' => ['nullable', 'string', 'max:5000'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
        ], [
            'institution.required' => 'Institusi wajib diisi.',
            'end_date.after_or_equal' => 'Tanggal selesai tidak boleh sebelum tanggal mulai.',
        ]);

        $validated['sort_order'] = $request->integer('sort_order', 0);

        return $validated;
    }
}
