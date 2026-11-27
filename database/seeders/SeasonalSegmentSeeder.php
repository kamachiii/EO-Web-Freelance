<?php

namespace Database\Seeders;

use App\Models\SeasonalSegment;
use Illuminate\Database\Seeder;

class SeasonalSegmentSeeder extends Seeder
{
    /**
     * Segmen musiman dari docs/CONTENT.md. Target Ramadan belum ada dari klien,
     * jadi segmen itu disimpan tanpa deskripsi dan tidak ditampilkan.
     * Tanggal di bawah adalah contoh untuk mencoba kalender admin, bukan
     * kalender final dari klien.
     */
    public function run(): void
    {
        foreach ($this->segments() as $order => $segment) {
            SeasonalSegment::updateOrCreate(
                ['name' => $segment['name']],
                [
                    'label' => $segment['label'],
                    'period' => $segment['period'],
                    'starts_at' => $segment['starts_at'],
                    'ends_at' => $segment['ends_at'],
                    'description' => $segment['description'],
                    'sort_order' => $order,
                    'is_active' => $segment['is_active'],
                ],
            );
        }
    }

    /**
     * @return array<int, array{name: string, label: string, period: string, starts_at: string, ends_at: string, description: ?string, is_active: bool}>
     */
    private function segments(): array
    {
        return [
            [
                'name' => 'Contoh: Year-End Gathering',
                'label' => 'Contoh: Year-End Gathering',
                'period' => 'November–Desember 2026',
                'starts_at' => '2026-11-01',
                'ends_at' => '2026-12-31',
                'description' => 'Data contoh untuk mencoba kalender musiman. Jangan diaktifkan sebelum konten dan tanggal disetujui klien.',
                'is_active' => false,
            ],
            [
                'name' => 'Ramadan',
                'label' => 'Ramadan',
                'period' => 'Februari–Maret 2027',
                'starts_at' => '2027-02-08',
                'ends_at' => '2027-03-09',
                'description' => null,
                'is_active' => false,
            ],
            [
                'name' => 'Sekolah dan Universitas',
                'label' => 'Sekolah dan Universitas',
                'period' => 'Juni–Juli 2027',
                'starts_at' => '2027-06-01',
                'ends_at' => '2027-07-31',
                'description' => null,
                'is_active' => false,
            ],
        ];
    }
}
