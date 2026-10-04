<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Artikel contoh — idempoten (slug dipakai sebagai acuan).
     */
    public function run(): void
    {
        $posts = [
            [
                'title' => 'Pengalaman Deploy Laravel Pertama Saya ke VPS Ubuntu',
                'category' => 'Web Dev',
                'is_published' => true,
                'published_at' => now()->subDays(7),
                'content' => <<<MD
Deploy aplikasi pertama ke VPS selalu terasa menegangkan. Kali ini saya mau berbagi langkah yang saya pakai untuk deploy proyek Laravel ke VPS Ubuntu 22.04 — dari nol sampai HTTPS aktif.

## Persiapan Server

Saya mulai dari VPS kosong dengan spesifikasi minim: 1 vCPU dan 1 GB RAM. Untuk kebutuhan portofolio, itu sudah lebih dari cukup. Hal pertama yang selalu saya lakukan:

```bash
sudo apt update && sudo apt upgrade -y
sudo apt install -y nginx mysql-server php8.2-fpm php8.2-cli php8.2-mysql
```

> **Tips:** buat user khusus untuk deploy, jangan pakai `root` sehari-hari. Ini kebiasaan kecil yang menyelamatkan banyak hal.

## Setup Database

Database dibuat dengan user khusus aplikasi — bukan root:

```sql
CREATE DATABASE portfolio CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'portfolio_user'@'localhost' IDENTIFIED BY 'password-kuat';
GRANT ALL PRIVILEGES ON portfolio.* TO 'portfolio_user'@'localhost';
```

## Hal yang Saya Lewati Dulu (dan Menyesalinya)

1. **Permission `storage/`** — aplikasi langsung error 500 karena log tidak bisa ditulis.
2. **`APP_DEBUG=false`** — stack trace sempat bocor ke publik.
3. **Cache konfigurasi** — `php artisan config:cache` bikin respons jauh lebih cepat.

Setelah semua beres, SSL Let's Encrypt cuma butuh satu perintah:

```bash
sudo certbot --nginx -d domainku.com -d www.domainku.com
```

## Penutup

Deploy itu bukan sihir — cuma daftar panjang hal kecil yang harus benar semua. Sekarang proses ini sudah jadi checklist yang saya pakai setiap kali ada proyek baru.
MD,
            ],
            [
                'title' => 'Tips Monitoring Jaringan FTTH agar Port ODP Tidak Overload',
                'category' => 'Networking',
                'is_published' => true,
                'published_at' => now()->subDays(3),
                'content' => <<<MD
Salah satu masalah paling sering di lapangan saat ini: calon pelanggan sudah terlanjur ditawarkan layanan, ternyata port ODP di sekitarnya penuh. Padahal ini bisa dicegah dengan monitoring yang disiplin.

## Kenapa Port Bisa "Penuh Diam-diam"

ODP 8 port (atau 16) terlihat lega di awal. Enam bulan berjalan, instalasi PSB datang bertahap tanpa pencatatan yang rapi — dan tiba-tiba tim lapangan menyerah karena semua port sudah terpakai.

## yang Saya Terapkan di NOC

- **Inventaris live, bukan Excel basi.** Setiap aktivasi ONU harus tercatat otomatis, minimal berupa log provisioning.
- **Alert kapasitas di 80%.** Begitu port terpakai menyentuh batas itu, tiket "perluas ODP" dibuat sebelum ada komplain.
- **Cek ONT unregistered tiap pagi.** ONT yang nyala tapi belum terdaftar sering jadi sinyal adanya instalasi liar.

## Contoh Cek Cepat ke OLT

```bash
# ZTE C300 — lihat status ONU di satu PON
show gpon onu state gpon-olt_1/2/1
```

Dari output itu saya hitung onu yang `working` dibanding total port yang tersedia. Sederhana, tapi menyelamatkan banyak eskalasi.

## Penutup

Monitoring bukan soal tools mahal — tapi soal disiplin menjaga data tetap benar. Mulai dari yang manual pun tidak apa-apa, asal konsisten.
MD,
            ],
            [
                'title' => 'Membangun Otomasi Provisioning ONU dengan Python + Paramiko',
                'category' => 'Otomasi',
                'is_published' => true,
                'published_at' => now()->subDays(1),
                'content' => <<<MD
Provisioning ONU manual di OLT itu repetitif: login, create ONU, set profile, cek status — berulang puluhan kali sehari. Akhirnya saya buat tool otomasi kecil pakai Python dan Paramiko, dan waktu provisioning turun dari beberapa menit menjadi hitungan detik.

## Kenapa Paramiko

Paramiko mengizinkan kita membuka sesi SSH (atau shell Telnet via jump) dan membaca output perintah secara programatik. Pola dasarnya:

```python
import paramiko

client = paramiko.SSHClient()
client.set_missing_host_key_policy(paramiko.AutoAddPolicy())
client.connect("10.10.10.10", username="admin", password="rahasia")

stdin, stdout, stderr = client.exec_command("show gpon onu state gpon-olt_1/2/1")
print(stdout.read().decode())
```

## Alur Tool yang Saya Bangun

1. Terima data pelanggan (nama, PON, SN/Password ONU, VLAN).
2. Susun daftar perintah sesuai template profil layanan.
3. Eksekusi berurutan ke OLT, tangkap output tiap langkah.
4. Validasi hasil (ONU muncul dan status `working`?).
5. Catat hasil provisioning ke database.

## Pelajaran Penting

- **Jangan pernah hardcode kredensial.** Simpan di `.env`, bukan di source code.
- **Parsing output itu 80% pekerjaan.** Output CLI OLT tidak stabil rapi — buat parser yang toleran terhadap spasi dan header.
- **Selalu sediakan mode dry-run.** Cetak perintah tanpa mengeksekusi, untuk uji template baru.

## Penutup

Otomasi kecil yang konsisten mengalahkan otomasi canggih yang tidak pernah jadi. Mulai dari satu perintah yang paling sering Anda ketik ulang.
MD,
            ],
        ];

        foreach ($posts as $data) {
            Post::firstOrCreate(
                ['slug' => Str::slug($data['title'])],
                $data,
            );
        }
    }
}
