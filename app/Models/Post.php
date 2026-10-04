<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'category',
        'tags',
        'content',
        'thumbnail',
        'is_published',
        'published_at',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'published_at' => 'datetime',
            'tags' => 'array',
        ];
    }

    /**
     * Normalisasi slug otomatis dari title saat slug kosong,
     * dan pastikan selalu unik (akhiri dengan -2, -3, dst. bila bentrok).
     */
    protected static function booted(): void
    {
        static::saving(function (self $post) {
            if (blank($post->slug)) {
                $post->slug = $post->title;
            }

            $base = $slug = Str::slug($post->slug);
            $suffix = 2;

            while (static::query()
                ->where('slug', $slug)
                ->whereKeyNot($post->getKey())
                ->exists()
            ) {
                $slug = "{$base}-{$suffix}";
                $suffix++;
            }

            $post->slug = $slug;
        });

        // Catat tanggal terbit pertama kali saat artikel dipublikasikan.
        // Bila artikel sempat di-unpublish lalu diterbitkan lagi, tanggal lama tetap dipakai.
        static::saving(function (self $post) {
            if ($post->is_published && blank($post->published_at)) {
                $post->published_at = now();
            }
        });
    }

    /**
     * Scope: hanya artikel yang sudah terbit.
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /**
     * URL publik untuk thumbnail (disk "public"), null bila tidak ada.
     */
    public function getThumbnailUrlAttribute(): ?string
    {
        return $this->thumbnail ? Storage::disk('public')->url($this->thumbnail) : null;
    }

    /**
     * Konten Markdown sudah di-render menjadi HTML.
     */
    public function getHtmlContentAttribute(): string
    {
        return Str::markdown($this->content, [
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);
    }

    /**
     * Ringkasan otomatis dari konten bila kolom excerpt kosong.
     */
    public function getExcerptTextAttribute(): string
    {
        if (filled($this->excerpt)) {
            return $this->excerpt;
        }

        return Str::limit(strip_tags($this->html_content), 160);
    }

    /**
     * Estimasi waktu baca (asumsi 200 kata per menit).
     */
    public function getReadingTimeAttribute(): int
    {
        $words = str_word_count(strip_tags($this->html_content));

        return max(1, (int) ceil($words / 200));
    }
}
