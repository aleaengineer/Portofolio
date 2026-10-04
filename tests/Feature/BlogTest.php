<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlogTest extends TestCase
{
    use RefreshDatabase;

    public function test_halaman_blog_hanya_menampilkan_artikel_terbit(): void
    {
        $published = Post::create([
            'title' => 'Pengalaman Deploy Laravel Pertama Saya ke VPS Ubuntu',
            'content' => 'Isi artikel pengalaman deploy.',
            'category' => 'Web Dev',
            'is_published' => true,
            'published_at' => now()->subDay(),
        ]);

        Post::create([
            'title' => 'Draft Belum Selesai',
            'content' => 'Artikel ini masih dalam penyusunan.',
            'is_published' => false,
        ]);

        $response = $this->get(route('blog.index'));

        $response->assertOk();
        $response->assertSee($published->title);
        $response->assertSee('Web Dev');
        $response->assertDontSee('Draft Belum Selesai');
    }

    public function test_detail_artikel_menampilkan_konten_markdown(): void
    {
        $post = Post::create([
            'title' => 'Tips Provisioning ONU dengan Python',
            'content' => "# Bagian Awal\n\nBeberapa kalimat pembuka.\n\n```python\nimport paramiko\n```",
            'category' => 'Otomasi',
            'is_published' => true,
            'published_at' => now(),
        ]);

        $response = $this->get(route('blog.show', $post));

        $response->assertOk();
        $response->assertSee('Tips Provisioning ONU dengan Python');
        $response->assertSee('<h1>Bagian Awal</h1>', false);
        $response->assertSee('import paramiko', false);
    }

    public function test_artikel_draft_tidak_bisa_diakses(): void
    {
        $post = Post::create([
            'title' => 'Draft Rahasia',
            'content' => 'Belum terbit.',
            'is_published' => false,
        ]);

        $this->get(route('blog.show', $post))->assertNotFound();
    }

    public function test_view_counter_hanya_naik_sekali_per_sesi(): void
    {
        $post = Post::create([
            'title' => 'Artikel Populer',
            'content' => 'Isi artikel.',
            'is_published' => true,
            'published_at' => now(),
        ]);

        $this->get(route('blog.show', $post));
        $this->get(route('blog.show', $post));

        $this->assertSame(1, $post->fresh()->views);
    }

    public function test_pencarian_dan_filter_kategori_bekerja(): void
    {
        $ftth = Post::create([
            'title' => 'Tips Monitoring Jaringan FTTH',
            'content' => 'Artikel tentang jaringan.',
            'category' => 'Networking',
            'is_published' => true,
            'published_at' => now()->subDay(),
        ]);

        $deploy = Post::create([
            'title' => 'Pengalaman Deploy ke VPS',
            'content' => 'Artikel tentang deployment.',
            'category' => 'Web Dev',
            'is_published' => true,
            'published_at' => now(),
        ]);

        $this->get(route('blog.index', ['q' => 'FTTH']))
            ->assertOk()
            ->assertSee($ftth->title)
            ->assertDontSee($deploy->title);

        $this->get(route('blog.index', ['kategori' => 'Web Dev']))
            ->assertOk()
            ->assertSee($deploy->title)
            ->assertDontSee($ftth->title);
    }
}
