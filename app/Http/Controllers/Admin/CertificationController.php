<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CertificationController extends Controller
{
    /**
     * Daftar sertifikasi.
     */
    public function index(): View
    {
        $certifications = Certification::query()
            ->orderBy('sort_order')
            ->orderByDesc('issue_date')
            ->paginate(15)
            ->withQueryString();

        return view('admin.certifications.index', [
            'certifications' => $certifications,
        ]);
    }

    /**
     * Form tambah sertifikasi.
     */
    public function create(): View
    {
        return view('admin.certifications.create', [
            'certification' => new Certification(['sort_order' => 0]),
        ]);
    }

    /**
     * Simpan sertifikasi baru.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateRequest($request);
        $validated['image'] = $this->storeImage($request);
        $certification = Certification::create($validated);

        return redirect()
            ->route('admin.certifications.index')
            ->with('success', "Sertifikasi \"{$certification->name}\" berhasil ditambahkan.");
    }

    /**
     * Form edit sertifikasi.
     */
    public function edit(Certification $certification): View
    {
        return view('admin.certifications.edit', [
            'certification' => $certification,
        ]);
    }

    /**
     * Perbarui sertifikasi.
     */
    public function update(Request $request, Certification $certification): RedirectResponse
    {
        $validated = $this->validateRequest($request);

        if ($request->hasFile('image')) {
            $this->deleteImageFile($certification->image);
            $validated['image'] = $this->storeImage($request);
        } elseif ($request->boolean('remove_image')) {
            $this->deleteImageFile($certification->image);
            $validated['image'] = null;
        } else {
            // Pertahankan gambar lama saat tidak ada file baru.
            unset($validated['image']);
        }

        $certification->update($validated);

        return redirect()
            ->route('admin.certifications.index')
            ->with('success', "Sertifikasi \"{$certification->name}\" berhasil diperbarui.");
    }

    /**
     * Hapus sertifikasi beserta file gambarnya.
     */
    public function destroy(Certification $certification): RedirectResponse
    {
        $name = $certification->name;
        $this->deleteImageFile($certification->image);
        $certification->delete();

        return back()->with('success', "Sertifikasi \"{$name}\" berhasil dihapus.");
    }

    /**
     * Validasi yang dipakai store() dan update().
     */
    private function validateRequest(Request $request): array
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'issuer' => ['required', 'string', 'max:255'],
            'issue_date' => ['nullable', 'date'],
            'expiry_date' => ['nullable', 'date', 'after_or_equal:issue_date'],
            'credential_id' => ['nullable', 'string', 'max:255'],
            'credential_url' => ['nullable', 'url:http,https', 'max:500'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
        ], [
            'name.required' => 'Nama sertifikasi wajib diisi.',
            'issuer.required' => 'Penerbit wajib diisi.',
            'credential_url.url' => 'URL kredensial tidak valid.',
            'image.image' => 'Gambar harus berupa file gambar (JPG/PNG/WebP, maks 2MB).',
            'expiry_date.after_or_equal' => 'Tanggal kedaluwarsa tidak boleh sebelum tanggal terbit.',
        ]);

        $validated['sort_order'] = $request->integer('sort_order', 0);

        return $validated;
    }

    /**
     * Simpan file gambar ke disk public, kembalikan path-nya.
     */
    private function storeImage(Request $request): ?string
    {
        if (! $request->hasFile('image')) {
            return null;
        }

        return $request->file('image')->store('certifications', 'public');
    }

    /**
     * Hapus file gambar dari disk public — aman untuk path null.
     */
    private function deleteImageFile(?string $path): void
    {
        if ($path !== null && $path !== '') {
            Storage::disk('public')->delete($path);
        }
    }
}
