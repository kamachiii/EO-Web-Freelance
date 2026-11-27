<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Placeholder yang jelas bukan testimoni nyata. Semua nonaktif supaya
     * tidak ada kutipan karangan yang tampil di situs publik.
     */
    public function run(): void
    {
        foreach ($this->items() as $order => $item) {
            Testimonial::updateOrCreate(
                ['name' => $item['name']],
                [
                    'role' => null,
                    'quote' => $item['quote'],
                    'rating' => null,
                    'is_featured' => false,
                    'is_active' => false,
                    'sort_order' => $order,
                ],
            );
        }
    }

    /**
     * @return array<int, array{name: string, quote: string}>
     */
    private function items(): array
    {
        return [
            [
                'name' => 'Contoh Klien 1',
                'quote' => 'Contoh kutipan testimoni. Ganti dengan kutipan asli dari klien sebelum diaktifkan.',
            ],
            [
                'name' => 'Contoh Klien 2',
                'quote' => 'Contoh kutipan testimoni. Jangan aktifkan sebelum klien menyetujui teks dan namanya.',
            ],
        ];
    }
}
