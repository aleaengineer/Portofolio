<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PortfolioPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_halaman_utama_menampilkan_proyek_unggulan(): void
    {
        $featured = Project::create([
            'title' => 'Web Peta Sebaran & Coverage FTTH',
            'description' => 'Platform pemetaan sebaran jaringan FTTH.',
            'tech_stack' => ['Laravel', 'Leaflet.js', 'MySQL'],
            'is_featured' => true,
        ]);

        Project::create([
            'title' => 'Proyek Internal Lama',
            'description' => 'Proyek ini tidak ditampilkan di halaman publik.',
            'tech_stack' => ['PHP'],
            'is_featured' => false,
        ]);

        $response = $this->get(route('portfolio.index'));

        $response->assertOk();
        $response->assertSee('Farhan Maulana Syidiq');
        $response->assertSee($featured->title);
        $response->assertSee('Leaflet.js');

        $response->assertDontSee('Proyek Internal Lama');
    }

    public function test_halaman_utama_tetap_terbuka_tanpa_proyek(): void
    {
        $response = $this->get(route('portfolio.index'));

        $response->assertOk();
        $response->assertSee('Belum ada proyek unggulan');
    }

    public function test_guest_diarahkan_ke_halaman_login_saat_membuka_admin(): void
    {
        $response = $this->get('/admin');

        $response->assertRedirect(route('login'));
    }
}
