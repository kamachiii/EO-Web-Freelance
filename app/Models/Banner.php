<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * Gambar hero, label musiman, dan sub-headline yang bisa diganti klien per musim (Fase 3).
 * H1 tetap dari config('site.headline').
 */
#[Fillable(['seasonal_label', 'subheadline', 'image_desktop', 'image_mobile', 'image_alt', 'sort_order', 'is_active'])]
class Banner extends Model
{
    /**
     * Gambar bawaan di public/images/hero yang tidak boleh dihapus.
     *
     * @var list<string>
     */
    private const DEFAULT_IMAGES = ['hero-desktop.webp', 'hero-mobile.webp'];

    /**
     * Hapus berkas lama saat gambar diganti atau banner dihapus,
     * supaya unggahan tidak menumpuk di disk.
     */
    protected static function booted(): void
    {
        static::updated(function (Banner $banner): void {
            foreach (['image_desktop', 'image_mobile'] as $field) {
                $old = $banner->getOriginal($field);

                if ($old && $old !== $banner->{$field}) {
                    static::deleteImage($old);
                }
            }
        });

        static::deleted(function (Banner $banner): void {
            static::deleteImage($banner->image_desktop);
            static::deleteImage($banner->image_mobile);
        });
    }

    private static function deleteImage(?string $file): void
    {
        if ($file && ! in_array($file, self::DEFAULT_IMAGES, true)) {
            Storage::disk('hero')->delete($file);
        }
    }

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
