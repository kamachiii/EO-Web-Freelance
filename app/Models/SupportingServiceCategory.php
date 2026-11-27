<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'slug', 'sort_order'])]
class SupportingServiceCategory extends Model
{
    /**
     * Kategori urut sesuai sort_order, lalu nama.
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    public function items(): HasMany
    {
        return $this->hasMany(SupportingServiceItem::class, 'category_id')
            ->orderBy('sort_order')
            ->orderBy('name');
    }
}
