# Panduan Setup Lokal (XAMPP / Laragon) — Windows

Proyek ini sudah ter-setup di `C:\xampp\htdocs\Website`. Dokumen ini merangkum langkah dari nol jika ingin mengulang di komputer lain, atau jika folder dihapus.

---

## Prasyarat

| Tool | Versi | Cek |
|---|---|---|
| PHP (XAMPP) | 8.2+ | `php -v` |
| Composer | 2.x | `composer --version` |
| Node.js + npm | 18+ / 9+ | `node -v && npm -v` |
| MySQL/MariaDB (XAMPP) | 5.7+ / 10.4+ | nyalakan dari XAMPP Control Panel |
| Git | 2.x | `git --version` |

---

## 1. Buat Proyek & Database

```bash
composer create-project laravel/laravel portfolio "^12.0"
cd portfolio

# Nyalakan MySQL di XAMPP Control Panel, lalu buat database:
C:/xampp/mysql/bin/mysql.exe -u root -e "CREATE DATABASE portfolio CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

## 2. Konfigurasi `.env`

```dotenv
APP_NAME="Portofolio Farhan"
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=portfolio
DB_USERNAME=root
DB_PASSWORD=
```

(XAMPP default: user `root` tanpa password. Sesuaikan bila MySQL Anda diprotect.)

## 3. Install Dependensi Frontend

```bash
npm install
npm install alpinejs
```

## 4. Migrasi + Data Contoh + Storage Link

```bash
php artisan migrate --seed
php artisan storage:link
```

Seeder otomatis membuat:
- Akun admin: `admin@portfolio.test` / `FarhanAdmin#2026` *(default — ganti lewat `.env` `ADMIN_EMAIL`/`ADMIN_PASSWORD` sebelum `db:seed`)*
- 3 proyek contoh (Peta FTTH, Otomasi ONU ZTE C300, Monitoring NOC).

## 5. Build Aset & Jalankan

```bash
npm run build          # build produksi (sekali saja / setelah ubah CSS/JS)
php artisan serve      # server dev: http://127.0.0.1:8000
```

Mode pengembangan front-end (hot reload):

```bash
npm run dev            # biarkan jalan, buka http://localhost:5173 via halaman Laravel
```

## 6. URL Lokal

| Halaman | URL |
|---|---|
| Situs publik | http://127.0.0.1:8000 |
| Login admin | http://127.0.0.1:8000/login |
| Panel admin | http://127.0.0.1:8000/admin |

---

## Alternatif: Pakai Apache Bawaan XAMPP (tanpa artisan serve)

Tambahkan VirtualHost di `C:\xampp\apache\conf\extra\httpd-vhosts.conf`:

```apache
<VirtualHost *:8001>
    DocumentRoot "C:/xampp/htdocs/Website/public"
    ServerName portfolio.test
    <Directory "C:/xampp/htdocs/Website/public">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

Lalu di `C:\Windows\System32\drivers\etc\hosts` (edit sebagai Administrator):

```
127.0.0.1    portfolio.test
```

Restart Apache dari XAMPP Control Panel → akses `http://portfolio.test:8001`.
Pastikan `mod_rewrite` aktif (default XAMPP sudah aktif).

---

## Menjalankan Test

```bash
php artisan test
```

Test menggunakan SQLite in-memory — tidak menyentuh database MySQL Anda.
