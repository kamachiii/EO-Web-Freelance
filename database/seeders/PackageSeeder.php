<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Kerangka paket contoh. Harga dan ruang lingkup belum ada dari klien,
     * jadi semua nonaktif dan label harga memakai "Hubungi kami".
     */
    public function run(): void
    {
        foreach ($this->items() as $order => $item) {
            Package::updateOrCreate(
                ['slug' => $item['slug']],
                [
                    'name' => $item['name'],
                    'description' => $item['description'],
                    'price_label' => 'Hubungi kami',
                    'features' => $item['features'],
                    'is_featured' => false,
                    'is_active' => false,
                    'sort_order' => $order,
                ],
            );
        }
    }

    /**
     * @return array<int, array{name: string, slug: string, description: string, features: array<int, string>}>
     */
    private function items(): array
    {
        return [
            [
                'name' => 'Contoh: Paket Korporat',
                'slug' => 'contoh-paket-korporat',
                'description' => 'Kerangka paket untuk event perusahaan. Isi dan harga menunggu keputusan klien.',
                'features' => [
                    'Contoh poin layanan',
                    'Contoh poin dokumentasi',
                    'Contoh poin koordinasi',
                ],
            ],
            [
                'name' => 'Contoh: Paket Sekolah',
                'slug' => 'contoh-paket-sekolah',
                'description' => 'Kerangka paket untuk study tour dan kegiatan sekolah. Belum untuk dipublikasikan.',
                'features' => [
                    'Contoh poin itinerary',
                    'Contoh poin pendampingan',
                ],
            ],
        ];
    }
}
