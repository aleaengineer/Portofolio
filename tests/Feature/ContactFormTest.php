<?php

namespace Tests\Feature;

use App\Models\Message;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_form_kontak_menyimpan_pesan_yang_valid(): void
    {
        $payload = [
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'subject' => 'Permintaan kerja sama',
            'message' => 'Halo, saya ingin berdiskusi mengenai proyek jaringan.',
        ];

        $response = $this->post(route('portfolio.contact'), $payload);

        $response->assertRedirect(route('portfolio.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('messages', [
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'subject' => 'Permintaan kerja sama',
            'is_read' => false,
        ]);

        $this->assertSame(1, Message::count());
    }

    public function test_form_kontak_menolak_email_tidak_valid(): void
    {
        $response = $this->from(route('portfolio.index'))
            ->post(route('portfolio.contact'), [
                'name' => 'Budi Santoso',
                'email' => 'bukan-email',
                'subject' => 'Tes',
                'message' => 'Isi pesan.',
            ]);

        $response->assertRedirect(route('portfolio.index'));
        $response->assertSessionHasErrors('email');

        $this->assertDatabaseCount('messages', 0);
    }

    public function test_form_kontak_wajib_mengisi_semua_kolom(): void
    {
        $response = $this->from(route('portfolio.index'))
            ->post(route('portfolio.contact'), []);

        $response->assertSessionHasErrors(['name', 'email', 'subject', 'message']);

        $this->assertDatabaseCount('messages', 0);
    }

    public function test_form_kontak_menolak_subjek_terlalu_panjang(): void
    {
        $response = $this->from(route('portfolio.index'))
            ->post(route('portfolio.contact'), [
                'name' => 'Budi Santoso',
                'email' => 'budi@example.com',
                'subject' => str_repeat('x', 201),
                'message' => 'Isi pesan.',
            ]);

        $response->assertSessionHasErrors('subject');

        $this->assertDatabaseCount('messages', 0);
    }
}
