<?php

namespace App\Http\Controllers;

use App\Models\Certification;
use App\Models\ContactSetting;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Message;
use App\Models\Post;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    /**
     * Halaman utama: tampilkan proyek unggulan.
     */
    public function index(): View
    {
        $projects = Project::query()
            ->featured()
            ->orderByDesc('id')
            ->get();

        $earliestStart = Experience::query()->min('start_date');

        return view('portfolio.index', [
            'projects' => $projects,
            'contactSetting' => ContactSetting::current(),
            'stats' => [
                'years' => $earliestStart
                    ? max(1, now()->diffInYears(\Illuminate\Support\Carbon::parse($earliestStart)))
                    : 0,
                'projects' => Project::featured()->count(),
                'posts' => Post::published()->count(),
                'certifications' => Certification::count(),
            ],
        ]);
    }

    /**
     * Halaman Keahlian (standalone, seperti Blog).
     */
    public function skills(): View
    {
        return view('portfolio.skills');
    }

    /**
     * Halaman Proyek: tampilkan semua proyek (unggulan dulu).
     */
    public function projects(): View
    {
        $projects = Project::query()
            ->orderByDesc('is_featured')
            ->orderByDesc('id')
            ->get();

        return view('portfolio.projects', [
            'projects' => $projects,
        ]);
    }

    /**
     * Detail proyek berdasarkan slug.
     */
    public function showProject(Project $project): View
    {
        $related = Project::query()
            ->whereKeyNot($project->id)
            ->orderByDesc('is_featured')
            ->orderByDesc('id')
            ->take(3)
            ->get();

        return view('portfolio.projects-show', [
            'project' => $project,
            'related' => $related,
        ]);
    }

    /**
     * Halaman Pengalaman & Sertifikasi (standalone, seperti Blog).
     */
    public function experience(): View
    {
        return view('portfolio.experience', [
            'experiences' => Experience::query()
                ->orderBy('sort_order')
                ->orderByDesc('start_date')
                ->get(),
            'certifications' => Certification::query()
                ->orderBy('sort_order')
                ->orderByDesc('issue_date')
                ->get(),
            'educations' => Education::query()
                ->orderBy('sort_order')
                ->orderByDesc('start_date')
                ->get(),
        ]);
    }

    /**
     * Detail pengalaman kerja.
     */
    public function showExperience(Experience $experience): View
    {
        $others = Experience::query()
            ->whereKeyNot($experience->id)
            ->orderBy('sort_order')
            ->orderByDesc('start_date')
            ->take(3)
            ->get();

        return view('portfolio.experience-show', [
            'experience' => $experience,
            'others' => $others,
        ]);
    }

    /**
     * Halaman CV siap cetak (data live dari database).
     */
    public function cv(): View
    {
        return view('portfolio.cv', [
            'contactSetting' => ContactSetting::current(),
            'experiences' => Experience::query()
                ->orderBy('sort_order')
                ->orderByDesc('start_date')
                ->get(),
            'certifications' => Certification::query()
                ->orderBy('sort_order')
                ->orderByDesc('issue_date')
                ->get(),
            'educations' => Education::query()
                ->orderBy('sort_order')
                ->orderByDesc('start_date')
                ->get(),
            'projects' => Project::query()
                ->featured()
                ->orderByDesc('id')
                ->take(6)
                ->get(),
        ]);
    }

    /**
     * Halaman Kontak (standalone, seperti Blog).
     */
    public function contact(): View
    {
        return view('portfolio.contact', [
            'contactSetting' => ContactSetting::current(),
        ]);
    }

    /**
     * Simpan pesan dari form kontak.
     */
    public function storeContact(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email:filter', 'max:150'],
            'subject' => ['required', 'string', 'max:200'],
            'message' => ['required', 'string', 'max:5000'],
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format alamat email tidak valid.',
            'subject.required' => 'Subjek wajib diisi.',
            'message.required' => 'Isi pesan wajib diisi.',
        ]);

        Message::create($validated);

        return back()->with(
            'success',
            'Terima kasih! Pesan Anda sudah terkirim dan akan saya balas secepatnya.'
        );
    }
}
