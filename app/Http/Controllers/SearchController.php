<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Project;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Pencarian global: proyek unggulan + artikel terbit.
     */
    public function index(Request $request): View
    {
        $q = trim((string) $request->string('q'));

        $projects = collect();
        $posts = collect();

        if ($q !== '') {
            // Escape wildcard LIKE (!, %, _) agar pencarian literal.
            // ESCAPE '!' tanpa backslash: aman di MySQL & SQLite.
            $escaped = str_replace(['!', '%', '_'], ['!!', '!%', '!_'], $q);
            $term = '%'.$escaped.'%';

            $projects = Project::query()
                ->where(function ($query) use ($term) {
                    $query->whereRaw("title LIKE ? ESCAPE '!'", [$term])
                        ->orWhereRaw("description LIKE ? ESCAPE '!'", [$term]);
                })
                ->orderByDesc('is_featured')
                ->orderByDesc('id')
                ->take(6)
                ->get();

            $posts = Post::query()
                ->published()
                ->where(function ($query) use ($term) {
                    $query->whereRaw("title LIKE ? ESCAPE '!'", [$term])
                        ->orWhereRaw("excerpt LIKE ? ESCAPE '!'", [$term])
                        ->orWhereRaw("content LIKE ? ESCAPE '!'", [$term]);
                })
                ->orderByDesc('published_at')
                ->orderByDesc('id')
                ->take(6)
                ->get();
        }

        return view('search.index', [
            'q' => $q,
            'projects' => $projects,
            'posts' => $posts,
        ]);
    }
}
