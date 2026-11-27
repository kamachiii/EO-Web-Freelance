<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Portofolio event. Data contoh disimpan nonaktif sampai konten asli masuk.
 */
#[Fillable(['title', 'slug', 'client_name', 'event_date', 'location', 'description', 'image', 'is_featured', 'is_active', 'sort_order'])]
class PortfolioItem extends Model
{
    /**
     * Portofolio yang boleh tampil di situs publik.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('event_date');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'event_date' => 'date',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ];
    }
}
