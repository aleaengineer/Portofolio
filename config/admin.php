<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Kredensial Admin Awal
    |--------------------------------------------------------------------------
    |
    | Dibaca oleh AdminUserSeeder. Didefinisikan di sini (bukan env()
    | langsung di seeder) agar nilainya ikut ter-cache saat
    | `php artisan config:cache` dijalankan di produksi.
    |
    */

    'email' => env('ADMIN_EMAIL', 'admin@portfolio.test'),

    'password' => env('ADMIN_PASSWORD'),

    'name' => env('ADMIN_NAME', 'Farhan Maulana Syidiq'),

];
