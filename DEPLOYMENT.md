# Panduan Deployment ke VPS — Ubuntu 22.04 / Debian 12

Panduan lengkap mendeploy aplikasi **Portofolio Farhan** (Laravel 12 + Nginx + PHP 8.2-FPM + MySQL/MariaDB) dari nol ke server produksi.

> Semua perintah dijalankan sebagai user dengan hak `sudo`. Ganti `portfolio.example.com` dengan domain Anda, dan sesuaikan nilai password/database.

---

## 1. Persiapan Server Awal

```bash
# Login ke server, lalu perbarui sistem
sudo apt update && sudo apt upgrade -y

# Utilitas dasar
sudo apt install -y curl git unzip software-properties-common ufw

# (Opsional tapi disarankan) buat user deploy khusus:
# sudo adduser deploy && sudo usermod -aG sudo deploy
```

Arahkan **DNS A record** domain Anda (`portfolio.example.com` dan `www`) ke IP publik VPS sebelum lanjut ke langkah SSL.

---

## 2. Install PHP 8.2 + Ekstensi

```bash
sudo apt install -y php8.2-fpm php8.2-cli php8.2-common \
    php8.2-mysql php8.2-mbstring php8.2-xml php8.2-curl \
    php8.2-zip php8.2-gd php8.2-intl php8.2-bcmath php8.2-opcache
```

> **Debian 12**: jika `php8.2` tidak tersedia di repo default, tambahkan repo Sury:
> ```bash
> sudo curl -sSLo /usr/share/keyrings/deb.sury.org-php.gpg https://packages.sury.org/php/apt.gpg
> echo "deb [signed-by=/usr/share/keyrings/deb.sury.org-php.gpg] https://packages.sury.org/php/ $(lsb_release -sc) main" | sudo tee /etc/apt/sources.list.d/php.list
> sudo apt update && sudo apt install -y php8.2-fpm php8.2-cli php8.2-mysql php8.2-mbstring php8.2-xml php8.2-curl php8.2-zip php8.2-gd php8.2-intl php8.2-bcmath
> ```

Pastikan FPM berjalan:

```bash
sudo systemctl enable --now php8.2-fpm
sudo systemctl status php8.2-fpm --no-pager
```

---

## 3. Install Nginx & MySQL

```bash
sudo apt install -y nginx mysql-server
sudo systemctl enable --now nginx mysql
```

### Setup Database & User MySQL

```bash
sudo mysql
```

Jalankan di dalam konsol MySQL (ganti `PasswordKuatAnda123!`):

```sql
CREATE DATABASE portfolio CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'portfolio_user'@'localhost' IDENTIFIED BY 'PasswordKuatAnda123!';
GRANT ALL PRIVILEGES ON portfolio.* TO 'portfolio_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

> Gunakan user khusus — jangan pakai `root` untuk aplikasi. Simpan kredensial ini, dipakai di `.env` pada langkah 6.

---

## 4. Install Composer

```bash
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
composer --version
```

---

## 5. Clone Proyek ke `/var/www/portfolio`

```bash
sudo mkdir -p /var/www
sudo chown $USER:$USER /var/www

git clone https://github.com/username/portfolio.git /var/www/portfolio
cd /var/www/portfolio
```

---

## 6. Install Dependency & Konfigurasi `.env`

```bash
# Dependency produksi (tanpa package dev, autoloader dioptimalkan)
composer install --no-dev --optimize-autoloader

# Buat file .env dari template
cp .env.example .env
php artisan key:generate
```

Edit `.env`:

```bash
nano .env
```

Sesuaikan bagian berikut:

```dotenv
APP_NAME="Portofolio Farhan"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://portfolio.example.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=portfolio
DB_USERNAME=portfolio_user
DB_PASSWORD=PasswordKuatAnda123!

# Kredensial akun admin saat pertama kali seeding (WAJIB diganti!)
ADMIN_EMAIL=farhan@domainanda.com
ADMIN_PASSWORD=GantiDenganPasswordKuat!
```

> `APP_DEBUG=false` wajib di produksi agar detail error tidak bocor ke pengunjung.

---

## 7. Migrasi Database, Seeder & Storage Link

```bash
php artisan migrate --force

# Buat akun admin (membaca ADMIN_EMAIL / ADMIN_PASSWORD dari .env)
php artisan db:seed --force

# Symlink public/storage -> storage/app/public (untuk thumbnail proyek)
php artisan storage:link
```

---

## 8. Permission Folder (PENTING)

Web server (`www-data`) harus bisa menulis ke `storage/` dan `bootstrap/cache/`:

```bash
sudo chown -R www-data:www-data /var/www/portfolio
sudo chgrp -R www-data storage bootstrap/cache
sudo chmod -R ug+rwx storage bootstrap/cache
```

> Bila ingin user Anda tetap bisa mengubah file tanpa `sudo` (nyaman saat `git pull`):
> ```bash
> sudo usermod -aG www-data $USER   # lalu logout & login ulang
> sudo chmod -R g+rwX storage bootstrap/cache
> ```

---

## 9. Konfigurasi Nginx

Salin file konfigurasi dari repo ini:

```bash
sudo cp deploy/nginx/portfolio.conf /etc/nginx/sites-available/portfolio
sudo nano /etc/nginx/sites-available/portfolio   # ganti server_name dengan domain Anda
```

Aktifkan site & nonaktifkan default:

```bash
sudo ln -s /etc/nginx/sites-available/portfolio /etc/nginx/sites-enabled/
sudo rm -f /etc/nginx/sites-enabled/default

# Validasi konfigurasi lalu reload
sudo nginx -t
sudo systemctl reload nginx
```

---

## 10. Firewall (UFW)

```bash
sudo ufw allow OpenSSH
sudo ufw allow 'Nginx Full'   # HTTP + HTTPS
sudo ufw enable
sudo ufw status
```

---

## 11. SSL Gratis dengan Let's Encrypt (Certbot)

```bash
sudo apt install -y certbot python3-certbot-nginx

# Certbot akan mendeteksi vhost, meminta email, lalu menambahkan
# blok server 443 + redirect HTTP->HTTPS otomatis ke file vhost.
sudo certbot --nginx -d portfolio.example.com -d www.portfolio.example.com
```

Verifikasi:

```bash
curl -I https://portfolio.example.com    # harus HTTP/2 200
```

Renewal otomatis sudah aktif via systemd timer — cek dengan:

```bash
sudo certbot renew --dry-run
```

Setelah HTTPS stabil, aktifkan header HSTS di `/etc/nginx/sites-available/portfolio` (buang tanda `#`):

```nginx
add_header Strict-Transport-Security "max-age=31536000; includeSubDomains" always;
```

lalu `sudo systemctl reload nginx`.

---

## 12. Optimasi Akhir Laravel

```bash
cd /var/www/portfolio

php artisan config:cache
php artisan route:cache
php artisan view:cache
```

> Setiap kali mengubah `.env`, ulangi `php artisan config:cache`. Setiap ada route/view baru, ulangi cache terkait.

---

## 13. Cek Akhir & Akses

| Halaman | URL |
|---|---|
| Situs publik | `https://portfolio.example.com` |
| Login admin | `https://portfolio.example.com/login` |
| Panel admin | `https://portfolio.example.com/admin` |

Login memakai `ADMIN_EMAIL` / `ADMIN_PASSWORD` yang Anda set di `.env`.
**Segera ganti password** setelah login pertama jika memakai password seeding.

---

## Pembaruan Aplikasi (Rutinitas Deploy Ulang)

```bash
cd /var/www/portfolio
php artisan down          # (opsional) mode maintenance

git pull origin main
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan storage:link

sudo chgrp -R www-data storage bootstrap/cache
php artisan optimize      # config + route + view cache sekaligus

php artisan up
```

---

## Troubleshooting Cepat

| Gejala | Penyebab umum | Solusi |
|---|---|---|
| Blank page 500 | `storage/` tidak writable | Ulangi langkah 8 |
| `The stream or file ... failed to open` | Permission log | `chown -R www-data:www-data storage` |
| CSS/JS tidak termuat (404) | Aset belum dibangun di server | Jalankan `npm install && npm run build` secara lokal, commit hasil `public/build/`, lalu `git pull` |
| 502 Bad Gateway | PHP-FPM mati / socket salah | `systemctl status php8.2-fpm`, cek path socket di vhost |
| `419 Page Expired` saat login | Session/cache bermasalah | Pastikan `APP_KEY` terisi & `config:cache` dijalankan ulang |
