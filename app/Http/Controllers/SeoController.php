<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Post;
use App\Models\Project;
use Illuminate\Http\Response;

class SeoController extends Controller
{
    /**
     * Sitemap XML dinamis: halaman statis + proyek + pengalaman + artikel.
     */
    public function sitemap(): Response
    {
        $static = collect([
            route('portfolio.index'),
            route('portfolio.skills'),
            route('portfolio.projects'),
            route('portfolio.experience'),
            route('portfolio.contact.show'),
            route('portfolio.cv'),
            route('blog.index'),
            route('search.index'),
        ]);

        $projects = Project::query()
            ->orderByDesc('updated_at')
            ->get(['slug', 'updated_at']);

        $experiences = Experience::query()
            ->orderByDesc('updated_at')
            ->get(['id', 'updated_at']);

        $posts = Post::query()
            ->published()
            ->orderByDesc('published_at')
            ->get(['slug', 'published_at', 'updated_at']);

        $xml = view('seo.sitemap', [
            'static' => $static,
            'projects' => $projects,
            'experiences' => $experiences,
            'posts' => $posts,
        ])->render();

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }

    /**
     * RSS 2.0: 20 artikel terbaru.
     */
    public function feed(): Response
    {
        $posts = Post::query()
            ->published()
            ->orderByDesc('published_at')
            ->take(20)
            ->get();

        $xml = view('seo.feed', ['posts' => $posts])->render();

        return response($xml, 200)->header('Content-Type', 'application/rss+xml');
    }

    /**
     * robots.txt dinamis agar Sitemap selalu absolut mengikuti APP_URL.
     */
    public function robots(): Response
    {
        $content = "User-agent: *\nAllow: /\nSitemap: ".route('sitemap')."\n";

        return response($content, 200)->header('Content-Type', 'text/plain');
    }
}
