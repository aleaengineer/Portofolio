<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Buat (atau perbarui) akun admin pemilik situs.
     *
     * Email & password dibaca dari config/admin.php (sumber: .env
     * ADMIN_EMAIL / ADMIN_PASSWORD) agar tetap berfungsi saat
     * `config:cache` aktif di produksi.
     *
     * Di produksi, ADMIN_PASSWORD wajib diisi — seeder akan gagal
     * daripada membuat akun dengan password default yang publicly known.
     */
    public function run(): void
    {
        $email = (string) config('admin.email', 'admin@portfolio.test');
        $password = (string) config('admin.password', '');
        $name = (string) config('admin.name', 'Farhan Maulana Syidiq');

        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \RuntimeException("ADMIN_EMAIL tidak valid: {$email}");
        }

        if ($password === '') {
            if (app()->environment('production')) {
                throw new \RuntimeException(
                    'ADMIN_PASSWORD wajib diisi di environment production. '.
                    'Set di .env lalu jalankan ulang seeder.'
                );
            }

            // Non-produksi: paksa operator mengganti password default
            // setelah login pertama, jangan diam-diam memakai default lama.
            $password = 'FarhanAdmin#2026';
            $this->command?->warn(
                "ADMIN_PASSWORD kosong — memakai password default sementara untuk {$email}. ".
                'Ganti segera setelah login!'
            );
        }

        if (strlen($password) < 8) {
            throw new \RuntimeException('ADMIN_PASSWORD minimal 8 karakter.');
        }

        User::updateOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'password' => Hash::make($password),
            ],
        );

        if (app()->environment('local')) {
            $this->command?->info("Akun admin: {$email} — ganti password default ini sebelum produksi!");
        }
    }
}
