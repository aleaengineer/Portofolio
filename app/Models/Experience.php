<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Experience extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'position',
        'company',
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
     * Rentang tanggal terformat, cth: "Jan 2023 — Sekarang".
     */
    public function getPeriodAttribute(): string
    {
        $start = $this->start_date?->translatedFormat('M Y') ?? '-';
        $end = $this->end_date?->translatedFormat('M Y') ?? 'Sekarang';

        return "{$start} — {$end}";
    }

    /**
     * Deskripsi Markdown sudah di-render menjadi HTML (mendukung H1/H2/H3).
     */
    public function getHtmlDescriptionAttribute(): string
    {
        return Str::markdown((string) $this->description, [
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);
    }

    /**
     * Ringkasan polos untuk meta description & cuplikan list.
     */
    public function excerpt(int $limit = 140): string
    {
        if (blank($this->description)) {
            return (string) $this->company;
        }

        return Str::limit(strip_tags($this->html_description), $limit);
    }
}
