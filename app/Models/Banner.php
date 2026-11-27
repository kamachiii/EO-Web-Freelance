<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Gambar hero, label musiman, dan sub-headline yang bisa diganti klien per musim (Fase 3).
 * H1 tetap dari config('site.headline').
 */
#[Fillable(['seasonal_label', 'subheadline', 'image_desktop', 'image_mobile', 'image_alt', 'sort_order', 'is_active'])]
class Banner extends Model
{
    /**
     * Banner aktif pertama (urut sesuai sort_order).
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query
            ->where('is_active', true)
            ->orderBy('sort_order');
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }
}
