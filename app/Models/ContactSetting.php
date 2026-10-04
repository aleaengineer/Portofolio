<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactSetting extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'email',
        'phone',
        'location',
        'response_hours',
    ];

    /**
     * Nilai default yang tampil di halaman kontak publik.
     *
     * @return array<string, string>
     */
    public static function defaults(): array
    {
        return [
            'email' => 'farhanmsyidiq@gmail.com',
            'phone' => '+62 821 2944-8933',
            'location' => 'Indonesia — Remote Friendly',
            'response_hours' => 'Senin – Sabtu, 09.00 – 21.00 WIB',
        ];
    }

    /**
     * Ambil baris tunggal pengaturan (buat dengan default bila belum ada).
     */
    public static function current(): self
    {
        return static::query()->firstOrCreate([], static::defaults());
    }
}
