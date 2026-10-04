# Portofolio Farhan — Laravel 12

Website portofolio & internal tools untuk **Farhan Maulana Syidiq** (NOC Engineer, Network Administrator, & Web Developer), dibangun dengan stack tradisional tanpa panel eksternal.

## Stack

- **Backend:** Laravel 12 (PHP 8.2+), MySQL/MariaDB
- **Frontend:** Blade + Tailwind CSS v4 (Vite) + Alpine.js
- **Admin:** Panel CRUD custom Blade + auth session bawaan Laravel (tanpa Filament/Breeze)
- **Produksi:** Nginx + PHP8.2-FPM di Ubuntu 22.04 / Debian 12

## Fitur

- Halaman publik one-page: hero, keahlian (Networking / Server & DevOps / Web Dev), proyek unggulan, form kontak (dengan validasi, flash message, dan rate-limit 5/menit).
- Panel admin (`/admin`): dashboard statistik, CRUD proyek (upload thumbnail, tech stack sebagai badge, toggle unggulan), inbox pesan kontak (tandai dibaca/hapus).
- Slug otomatis + unik dari judul proyek.

## Dokumen

| Dokumen | Isi |
|---|---|
| [LOCAL_SETUP.md](LOCAL_SETUP.md) | Setup lokal XAMPP/Laragon step-by-step |
| [DEPLOYMENT.md](DEPLOYMENT.md) | Deploy VPS Ubuntu/Debian lengkap + SSL Let's Encrypt |
| [deploy/nginx/portfolio.conf](deploy/nginx/portfolio.conf) | Virtual host Nginx produksi |

## Perintah Cepat

```bash
php artisan migrate --seed   # siapkan database + data contoh
php artisan storage:link     # symlink thumbnail publik
npm run build                # build aset front-end
php artisan serve            # jalankan di http://127.0.0.1:8000
php artisan test             # jalankan test suite
```

## Struktur Kode Utama

```
app/
├── Http/Controllers/
│   ├── PortfolioController.php      # halaman publik + form kontak
│   ├── AuthController.php           # login/logout admin
│   └── Admin/
│       ├── DashboardController.php
│       ├── ProjectController.php    # CRUD proyek + upload thumbnail
│       └── MessageController.php    # inbox pesan kontak
├── Models/
│   ├── Project.php
│   └── Message.php
database/
├── migrations/                      # projects & messages
└── seeders/                         # admin user + proyek contoh
resources/views/
├── portfolio/index.blade.php        # halaman publik
├── auth/login.blade.php
└── admin/                           # dashboard, projects, messages
routes/web.php
```
