<?php

use App\Http\Controllers\Admin\CertificationController;
use App\Http\Controllers\Admin\ContactSettingController;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SeoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Halaman Publik
|--------------------------------------------------------------------------
*/
Route::get('/', [PortfolioController::class, 'index'])
    ->name('portfolio.index');

Route::get('/keahlian', [PortfolioController::class, 'skills'])
    ->name('portfolio.skills');

Route::get('/proyek', [PortfolioController::class, 'projects'])
    ->name('portfolio.projects');

Route::get('/proyek/{project:slug}', [PortfolioController::class, 'showProject'])
    ->name('portfolio.projects.show');

Route::get('/pengalaman', [PortfolioController::class, 'experience'])
    ->name('portfolio.experience');

Route::get('/pengalaman/{experience}', [PortfolioController::class, 'showExperience'])
    ->name('portfolio.experience.show');

Route::get('/kontak', [PortfolioController::class, 'contact'])
    ->name('portfolio.contact.show');

Route::get('/cv', [PortfolioController::class, 'cv'])
    ->name('portfolio.cv');

Route::post('/contact', [PortfolioController::class, 'storeContact'])
    ->middleware('throttle:5,1')
    ->name('portfolio.contact');

Route::get('/blog', [BlogController::class, 'index'])
    ->name('blog.index');

Route::get('/blog/feed', [SeoController::class, 'feed'])->name('blog.feed');

Route::get('/blog/{post:slug}', [BlogController::class, 'show'])
    ->name('blog.show');

Route::get('/cari', [SearchController::class, 'index'])
    ->name('search.index');

Route::get('/sitemap.xml', [SeoController::class, 'sitemap'])->name('sitemap');
Route::get('/robots.txt', [SeoController::class, 'robots'])->name('robots');

/*
|--------------------------------------------------------------------------
| Autentikasi Admin
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])
        ->middleware('throttle:5,1');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Panel Admin (wajib login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('projects', ProjectController::class)
        ->except(['show'])
        ->parameters(['projects' => 'project']);

    Route::patch('/projects/{project}/toggle-featured', [ProjectController::class, 'toggleFeatured'])
        ->name('projects.toggleFeatured');

    Route::resource('posts', PostController::class)
        ->except(['show'])
        ->parameters(['posts' => 'post']);

    Route::patch('/posts/{post}/toggle-published', [PostController::class, 'togglePublished'])
        ->name('posts.togglePublished');

    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::patch('/messages/{message}/toggle-read', [MessageController::class, 'toggleRead'])->name('messages.toggleRead');
    Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');

    Route::get('/contact-setting', [ContactSettingController::class, 'edit'])->name('contact-setting.edit');
    Route::put('/contact-setting', [ContactSettingController::class, 'update'])->name('contact-setting.update');

    Route::resource('experiences', ExperienceController::class)
        ->except(['show'])
        ->parameters(['experiences' => 'experience']);

    Route::resource('certifications', CertificationController::class)
        ->except(['show'])
        ->parameters(['certifications' => 'certification']);

    Route::resource('educations', EducationController::class)
        ->except(['show'])
        ->parameters(['educations' => 'education']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
});
