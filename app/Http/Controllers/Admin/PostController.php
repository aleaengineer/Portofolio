<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Daftar seluruh artikel blog.
     */
    public function index(): View
    {
        $posts = Post::query()
            ->latest('published_at')
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        return view('admin.posts.index', [
            'posts' => $posts,
        ]);
    }

    /**
     * Form tulis artikel baru.
     */
    public function create(): View
    {
        return view('admin.posts.create', [
            'post' => new Post(['is_published' => false]),
        ]);
    }

    /**
     * Simpan artikel baru.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateRequest($request);
        $validated['thumbnail'] = $this->storeThumbnail($request);

        $post = Post::create($validated);

        return redirect()
            ->route('admin.posts.index')
            ->with('success', "Artikel \"{$post->title}\" berhasil disimpan.");
    }

    /**
     * Form edit artikel.
     */
    public function edit(Post $post): View
    {
        return view('admin.posts.edit', [
            'post' => $post,
        ]);
    }

    /**
     * Perbarui artikel.
     */
    public function update(Request $request, Post $post): RedirectResponse
    {
        $validated = $this->validateRequest($request, $post);

        if ($request->hasFile('thumbnail')) {
            // Ganti file lama bila ada, lalu simpan yang baru.
            $this->deleteThumbnailFile($post->thumbnail);
            $validated['thumbnail'] = $this->storeThumbnail($request);
        } elseif ($request->boolean('remove_thumbnail')) {
            $this->deleteThumbnailFile($post->thumbnail);
            $validated['thumbnail'] = null;
        } else {
            // Pertahankan thumbnail lama: jangan timpa dengan null
            // dari hasil validasi saat tidak ada file baru.
            unset($validated['thumbnail']);
        }

        $post->update($validated);

        return redirect()
            ->route('admin.posts.index')
            ->with('success', "Artikel \"{$post->title}\" berhasil diperbarui.");
    }

    /**
     * Hapus artikel beserta file thumbnail-nya.
     */
    public function destroy(Post $post): RedirectResponse
    {
        $this->deleteThumbnailFile($post->thumbnail);
        $post->delete();

        return back()->with('success', "Artikel \"{$post->title}\" berhasil dihapus.");
    }

    /**
     * Terbitkan / tarik artikel dari halaman publik dengan cepat.
     */
    public function togglePublished(Post $post): RedirectResponse
    {
        $post->update(['is_published' => ! $post->is_published]);

        return back()->with(
            'success',
            $post->is_published
                        ? "Artikel \"{$post->title}\" sekarang tayang di halaman blog."
                        : "Artikel \"{$post->title}\" ditarik dari halaman blog."
        );
    }

    /**
     * Validasi yang dipakai store() dan update().
     */
    private function validateRequest(Request $request, ?Post $post = null): array
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'nullable', 'string', 'max:255', 'alpha_dash',
                \Illuminate\Validation\Rule::unique('posts', 'slug')->ignore($post),
            ],
            'excerpt' => ['nullable', 'string', 'max:300'],
            'category' => ['nullable', 'string', 'max:50'],
            'tags' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'is_published' => ['nullable', 'boolean'],
        ], [
            'title.required' => 'Judul artikel wajib diisi.',
            'content.required' => 'Isi artikel wajib diisi.',
            'excerpt.max' => 'Ringkasan maksimal 300 karakter.',
            'thumbnail.image' => 'Thumbnail harus berupa gambar (JPG/PNG/WebP, maks 2MB).',
        ]);

        // Checkbox yang tidak dicentang tidak ikut terkirim.
        $validated['is_published'] = $request->boolean('is_published');

        // Kategori dinormalisasi: trim, kosong menjadi null.
        $category = trim((string) ($validated['category'] ?? ''));
        $validated['category'] = $category !== '' ? $category : null;

        // Tags berupa teks dipisah koma: "ftth, monitoring, olt"
        $validated['tags'] = collect(explode(',', (string) ($validated['tags'] ?? '')))
            ->map(fn ($tag) => trim($tag))
            ->filter()
            ->values()
            ->all();

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
     * Hapus file thumbnail dari disk public — aman dipanggil untuk artikel
     * yang belum pernah memiliki thumbnail (path null).
     */
    private function deleteThumbnailFile(?string $path): void
    {
        if ($path !== null && $path !== '') {
            Storage::disk('public')->delete($path);
        }
    }
}
