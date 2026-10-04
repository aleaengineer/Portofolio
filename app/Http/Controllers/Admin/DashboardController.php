<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certification;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Message;
use App\Models\Post;
use App\Models\Project;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Ringkasan panel admin.
     */
    public function index(): View
    {
        return view('admin.dashboard', [
            'totalProjects' => Project::count(),
            'featuredProjects' => Project::featured()->count(),
            'totalPosts' => Post::count(),
            'publishedPosts' => Post::published()->count(),
            'totalMessages' => Message::count(),
            'unreadMessages' => Message::unread()->count(),
            'latestMessages' => Message::orderByDesc('id')->take(5)->get(),
            'totalExperiences' => Experience::count(),
            'totalCertifications' => Certification::count(),
            'totalEducations' => Education::count(),
        ]);
    }
}
