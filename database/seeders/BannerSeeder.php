<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Satu banner aktif untuk peluncuran. Foto hero belum ada dari klien,
     * jadi kolom gambar dibiarkan kosong dan beranda menampilkan panel logo
     * (docs/DESIGN.md bagian 8).
     */
    public function run(): void
    {
        Banner::updateOrCreate(
            ['sort_order' => 0],
            [
                'seasonal_label' => null,
                'subheadline' => null,
                'image_desktop' => null,
                'image_mobile' => null,
                'image_alt' => null,
                'is_active' => true,
            ],
        );
    }
}
