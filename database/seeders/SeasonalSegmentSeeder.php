<?php

namespace Database\Seeders;

use App\Models\SeasonalSegment;
use Illuminate\Database\Seeder;

class SeasonalSegmentSeeder extends Seeder
{
    /**
     * Segmen musiman dari docs/CONTENT.md. Target Ramadan belum ada dari klien,
     * jadi segmen itu disimpan tanpa deskripsi dan tidak ditampilkan.
     */
    public function run(): void
    {
        foreach ($this->segments() as $order => $segment) {
            SeasonalSegment::updateOrCreate(
                ['name' => $segment['name']],
                [
                    'label' => $segment['label'],
                    'period' => $segment['period'],
                    'description' => $segment['description'],
                    'sort_order' => $order,
                    'is_active' => $segment['is_active'],
                ],
            );
        }
    }

    /**
     * @return array<int, array{name: string, label: string, period: string, description: ?string, is_active: bool}>
     */
    private function segments(): array
    {
        return [
            [
                'name' => 'Ramadan',
                'label' => 'Ramadan',
                'period' => 'Ramadan',
                'description' => null,
                'is_active' => false,
            ],
            [
                'name' => 'Sekolah dan Universitas',
                'label' => 'Sekolah dan Universitas',
                'period' => 'Setelah Ramadan',
                'description' => null,
                'is_active' => false,
            ],
        ];
    }
}
