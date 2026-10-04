<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProjectController extends Controller
{
    /**
     * Daftar seluruh proyek.
     */
    public function index(): View
    {
        $projects = Project::query()
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('admin.projects.index', [
            'projects' => $projects,
        ]);
    }

    /**
     * Form tambah proyek.
     */
    public function create(): View
    {
        return view('admin.projects.create', [
            'project' => new Project(['tech_stack' => [], 'is_featured' => false]),
        ]);
    }

    /**
     * Simpan proyek baru.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateRequest($request);
        $validated['thumbnail'] = $this->storeThumbnail($request);

        $project = Project::create($validated);

        return redirect()
            ->route('admin.projects.index')
            ->with('success', "Proyek \"{$project->title}\" berhasil ditambahkan.");
    }

    /**
     * Form edit proyek.
     */
    public function edit(Project $project): View
    {
        return view('admin.projects.edit', [
            'project' => $project,
        ]);
    }

    /**
     * Perbarui proyek.
     */
    public function update(Request $request, Project $project): RedirectResponse
    {
        $validated = $this->validateRequest($request, $project);

        if ($request->hasFile('thumbnail')) {
            // Ganti file lama bila ada, lalu simpan yang baru.
            $this->deleteThumbnailFile($project->thumbnail);
            $validated['thumbnail'] = $this->storeThumbnail($request);
        } elseif ($request->boolean('remove_thumbnail')) {
            $this->deleteThumbnailFile($project->thumbnail);
            $validated['thumbnail'] = null;
        } else {
            // Pertahankan thumbnail lama: jangan timpa dengan null
            // dari hasil validasi saat tidak ada file baru.
            unset($validated['thumbnail']);
        }

        $project->update($validated);

        return redirect()
            ->route('admin.projects.index')
            ->with('success', "Proyek \"{$project->title}\" berhasil diperbarui.");
    }

    /**
     * Hapus proyek beserta file thumbnail-nya.
     */
    public function destroy(Project $project): RedirectResponse
    {
        $this->deleteThumbnailFile($project->thumbnail);
        $project->delete();

        return back()->with('success', "Proyek \"{$project->title}\" berhasil dihapus.");
    }

    /**
     * Tampilkan/sembunyikan proyek dari beranda dengan cepat.
     */
    public function toggleFeatured(Project $project): RedirectResponse
    {
        $project->update(['is_featured' => ! $project->is_featured]);

        return back()->with(
            'success',
            $project->is_featured
                        ? "Proyek \"{$project->title}\" sekarang ditampilkan di beranda."
                        : "Proyek \"{$project->title}\" disembunyikan dari beranda."
        );
    }

    /**
     * Validasi yang dipakai store() dan update().
     */
    private function validateRequest(Request $request, ?Project $project = null): array
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'nullable', 'string', 'max:255', 'alpha_dash',
                \Illuminate\Validation\Rule::unique('projects', 'slug')->ignore($project),
            ],
            'description' => ['required', 'string'],
            'tech_stack' => ['nullable', 'string', 'max:1000'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'github_url' => ['nullable', 'url:http,https', 'max:255'],
            'demo_url' => ['nullable', 'url:http,https', 'max:255'],
            'is_featured' => ['nullable', 'boolean'],
        ], [
            'title.required' => 'Judul proyek wajib diisi.',
            'description.required' => 'Deskripsi proyek wajib diisi.',
            'thumbnail.image' => 'Thumbnail harus berupa gambar (JPG/PNG/WebP, maks 2MB).',
            'github_url.url' => 'URL GitHub tidak valid.',
            'demo_url.url' => 'URL demo tidak valid.',
        ]);

        // Input tech stack berupa teks dipisah koma: "Laravel, MySQL, Leaflet.js"
        $validated['tech_stack'] = collect(explode(',', (string) ($validated['tech_stack'] ?? '')))
            ->map(fn ($tech) => trim($tech))
            ->filter()
            ->values()
            ->all();

        // Checkbox yang tidak dicentang tidak ikut terkirim.
        $validated['is_featured'] = $request->boolean('is_featured');

        return $validated;
    }

    /**
     * Simpan file thumbnail ke disk public, kembalikan path-nya.
     */
    private function storeThumbnail(Request $request): ?string
    {
        if (! $request->hasFile('thumbnail')) {
            return null;
        }

        return $request->file('thumbnail')->store('thumbnails', 'public');
    }

    /**
     * Hapus file thumbnail dari disk public — aman dipanggil untuk proyek
     * yang belum pernah memiliki thumbnail (path null).
     */
    private function deleteThumbnailFile(?string $path): void
    {
        if ($path !== null && $path !== '') {
            Storage::disk('public')->delete($path);
        }
    }
}
