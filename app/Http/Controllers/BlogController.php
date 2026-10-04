<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Daftar artikel terbit — mendukung pencarian & filter kategori.
     */
    public function index(Request $request): View
    {
        $posts = Post::query()
            ->published()
            ->when($request->filled('q'), function ($query) use ($request) {
                // Escape wildcard LIKE (!, %, _) agar pencarian literal.
                // ESCAPE '!' tanpa backslash: aman di MySQL & SQLite.
                $escaped = str_replace(['!', '%', '_'], ['!!', '!%', '!_'], (string) $request->string('q'));
                $term = '%'.$escaped.'%';

                $query->where(function ($query) use ($term) {
                    $query->whereRaw("title LIKE ? ESCAPE '!'", [$term])
                        ->orWhereRaw("excerpt LIKE ? ESCAPE '!'", [$term])
                        ->orWhereRaw("content LIKE ? ESCAPE '!'", [$term]);
                });
            })
            ->when($request->filled('kategori'), function ($query) use ($request) {
                $query->where('category', (string) $request->string('kategori'));
            })
            ->when($request->filled('tag'), function ($query) use ($request) {
                $query->whereJsonContains('tags', (string) $request->string('tag'));
            })
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->paginate(9)
            ->withQueryString();

        $categories = Post::query()
            ->published()
            ->whereNotNull('category')
            ->select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        $tags = Post::query()
            ->published()
            ->whereNotNull('tags')
            ->pluck('tags')
            ->flatten()
            ->filter()
            ->unique()
            ->sort()
            ->values();

        return view('blog.index', [
            'posts' => $posts,
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    /**
     * Detail artikel: hitung view (1x per sesi), kirim
     * navigasi prev/next dan artikel terkait satu kategori.
     */
    public function show(Request $request, Post $post): View
    {
        abort_unless($post->is_published, 404);

        $sessionKey = 'viewed_post_'.$post->id;

        if (! $request->session()->has($sessionKey)) {
            $post->increment('views');
            $request->session()->put($sessionKey, true);
        }

        $related = Post::query()
            ->published()
            ->where('category', $post->category)
            ->whereKeyNot($post->id)
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->take(3)
            ->get();

        $previous = Post::query()
            ->published()
            ->where(function ($query) use ($post) {
                $query->where('published_at', '<', $post->published_at)
                    ->orWhere(function ($query) use ($post) {
                        $query->where('published_at', $post->published_at)
                            ->where('id', '<', $post->id);
                    });
            })
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->first();

        $next = Post::query()
            ->published()
            ->where(function ($query) use ($post) {
                $query->where('published_at', '>', $post->published_at)
                    ->orWhere(function ($query) use ($post) {
                        $query->where('published_at', $post->published_at)
                            ->where('id', '>', $post->id);
                    });
            })
            ->orderBy('published_at')
            ->orderBy('id')
            ->first();

        return view('blog.show', [
            'post' => $post,
            'related' => $related,
            'previous' => $previous,
            'next' => $next,
        ]);
    }
}
