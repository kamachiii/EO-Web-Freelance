<?php

namespace Database\Seeders;

use App\Models\PortfolioItem;
use Illuminate\Database\Seeder;

class PortfolioItemSeeder extends Seeder
{
    /**
     * Data contoh untuk mencoba halaman admin. Semua nonaktif dan tanpa foto
     * sampai klien memberi materi asli dan izin tampil.
     */
    public function run(): void
    {
        foreach ($this->items() as $order => $item) {
            PortfolioItem::updateOrCreate(
                ['slug' => $item['slug']],
                [
                    'title' => $item['title'],
                    'client_name' => null,
                    'event_date' => $item['event_date'],
                    'location' => null,
                    'description' => $item['description'],
                    'image' => null,
                    'is_featured' => false,
                    'is_active' => false,
                    'sort_order' => $order,
                ],
            );
        }
    }

    /**
     * @return array<int, array{title: string, slug: string, event_date: string, description: string}>
     */
    private function items(): array
    {
        return [
            [
                'title' => 'Contoh: Gathering Tahunan Perusahaan',
                'slug' => 'contoh-gathering-tahunan-perusahaan',
                'event_date' => '2026-12-12',
                'description' => 'Data contoh untuk mencoba galeri portofolio. Ganti dengan event asli setelah foto dan izin klien tersedia.',
            ],
            [
                'title' => 'Contoh: Study Tour Sekolah',
                'slug' => 'contoh-study-tour-sekolah',
                'event_date' => '2027-06-18',
                'description' => 'Data contoh untuk mencoba galeri portofolio. Jangan diaktifkan sebelum konten disetujui klien.',
            ],
            [
                'title' => 'Contoh: Capacity Building Tim',
                'slug' => 'contoh-capacity-building-tim',
                'event_date' => '2027-02-20',
                'description' => 'Data contoh untuk mencoba galeri portofolio. Deskripsi asli menyusul dari klien.',
            ],
        ];
    }
}
