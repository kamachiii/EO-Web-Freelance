<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Testimoni klien. Hanya testimoni asli yang boleh diaktifkan.
 */
#[Fillable(['name', 'role', 'quote', 'rating', 'is_featured', 'is_active', 'sort_order'])]
class Testimonial extends Model
{
    /**
     * Testimoni yang boleh tampil di situs publik.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->latest();
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'rating' => 'integer',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ];
    }
}
