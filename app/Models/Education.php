<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Education extends Model
{
    /**
     * Nama tabel eksplisit (inflector tidak jamak untuk kata ini).
     *
     * @var string
     */
    protected $table = 'education';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'institution',
        'degree',
        'location',
        'start_date',
        'end_date',
        'description',
        'sort_order',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'sort_order' => 'integer',
        ];
    }

    /**
     * Rentang tahun terformat, cth: "2023 — Sekarang".
     */
    public function getPeriodAttribute(): string
    {
        $start = $this->start_date?->translatedFormat('Y') ?? '-';
        $end = $this->end_date?->translatedFormat('Y') ?? 'Sekarang';

        return "{$start} — {$end}";
    }

    /**
     * Deskripsi Markdown sudah di-render menjadi HTML.
     */
    public function getHtmlDescriptionAttribute(): string
    {
        return Str::markdown((string) $this->description, [
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);
    }
}
