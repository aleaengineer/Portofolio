<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Project extends Model
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
        'description',
        'thumbnail',
        'tech_stack',
        'github_url',
        'demo_url',
        'is_featured',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'tech_stack' => 'array',
            'is_featured' => 'boolean',
        ];
    }

    /**
     * Normalisasi slug otomatis dari title saat slug kosong,
     * dan pastikan selalu unik (akhiri dengan -2, -3, dst. bila bentrok).
     */
    protected static function booted(): void
    {
        static::saving(function (self $project) {
            if (blank($project->slug)) {
                $project->slug = $project->title;
            }

            $base = $slug = Str::slug($project->slug);
            $suffix = 2;

            while (static::query()
                ->where('slug', $slug)
                ->whereKeyNot($project->getKey())
                ->exists()
            ) {
                $slug = "{$base}-{$suffix}";
                $suffix++;
            }

            $project->slug = $slug;
        });
    }

    /**
     * Scope: hanya proyek unggulan.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * URL publik untuk thumbnail (disk "public"), null bila tidak ada.
     */
    public function getThumbnailUrlAttribute(): ?string
    {
        return $this->thumbnail ? Storage::disk('public')->url($this->thumbnail) : null;
    }

    /**
     * Ringkasan description untuk kartu di halaman publik.
     */
    public function excerpt(int $limit = 140): string
    {
        return Str::limit(strip_tags($this->description), $limit);
    }
}
