<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Nama, slug, dan deskripsi diambil dari docs/CONTENT.md
     * (excerpt = ringkasan untuk kartu, description = deskripsi klien).
     */
    public function run(): void
    {
        foreach ($this->services() as $order => $service) {
            Service::updateOrCreate(
                ['slug' => $service['slug']],
                [
                    'name' => $service['name'],
                    'excerpt' => $service['excerpt'],
                    'description' => $service['description'],
                    'sort_order' => $order,
                    'is_active' => true,
                ],
            );
        }
    }

    /**
     * @return array<int, array{name: string, slug: string, excerpt: string, description: string}>
     */
    private function services(): array
    {
        return [
            [
                'name' => 'Outbound Fun Games & Team Building',
                'slug' => 'outbound-fun-games-team-building',
                'excerpt' => 'Ice breaking dan penguatan komunikasi kelompok.',
                'description' => 'Program pencairan kebekuan (ice breaking) dan penguatan komunikasi kelompok.',
            ],
            [
                'name' => 'Capacity Building',
                'slug' => 'capacity-building',
                'excerpt' => 'Pelatihan kapasitas diri, mental, dan kepemimpinan tim.',
                'description' => 'Pelatihan peningkatan kapasitas diri, mental, dan kepemimpinan tim.',
            ],
            [
                'name' => 'Inflatable Games',
                'slug' => 'inflatable-games',
                'excerpt' => 'Permainan seru dengan properti balon raksasa yang kompetitif.',
                'description' => 'Permainan seru menggunakan properti balon raksasa yang kompetitif dan menghibur.',
            ],
            [
                'name' => 'Amazing Race / Treasure Hunt',
                'slug' => 'amazing-race-treasure-hunt',
                'excerpt' => 'Petualangan menyusuri pos dengan teka-teki yang memicu kerja sama.',
                'description' => 'Tantangan petualangan menyusuri pos-pos dengan teka-teki strategis yang memicu kerja sama.',
            ],
            [
                'name' => 'Trekking & Hiking',
                'slug' => 'trekking-hiking',
                'excerpt' => 'Menjelajahi jalur alam untuk menyegarkan fisik dan pikiran.',
                'description' => 'Penjelajahan alam menyusuri jalur pegunungan atau perbukitan untuk menyegarkan fisik dan pikiran.',
            ],
            [
                'name' => 'Extreme & Water Adventure',
                'slug' => 'extreme-water-adventure',
                'excerpt' => 'Offroad 4x4, paintball, dan rafting untuk memicu adrenalin.',
                'description' => 'Offroad 4x4, Paintball Battle, & Rafting (Arung Jeram) untuk memicu adrenalin.',
            ],
            [
                'name' => 'Special Program, Custom Event, & MICE',
                'slug' => 'special-program-custom-event-mice',
                'excerpt' => 'Gathering besar, rapat kerja, seminar, hingga acara tematik.',
                'description' => 'Penyelenggaraan gathering skala besar, rapat kerja, seminar, hingga acara tematik perusahaan.',
            ],
        ];
    }
}
