<?php

namespace Database\Seeders;

use App\Models\SeasonalSegment;
use App\Models\Service;
use Illuminate\Database\Seeder;

class SeasonalSegmentSeeder extends Seeder
{
    /**
     * Segmen musiman dari docs/CONTENT.md. Target Ramadan belum ada dari klien,
     * jadi segmen itu disimpan tanpa deskripsi dan tidak ditampilkan.
     * Tanggal dan konten sorotan di bawah adalah contoh untuk mencoba kalender
     * dan band musiman, bukan kalender final dari klien.
     */
    public function run(): void
    {
        $serviceIds = Service::query()
            ->whereIn('slug', [
                'outbound-fun-games-team-building',
                'amazing-race-treasure-hunt',
                'special-program-custom-event-mice',
            ])
            ->pluck('id', 'slug');

        foreach ($this->segments() as $order => $segment) {
            $featuredIds = collect($segment['featured_slugs'] ?? [])
                ->map(fn (string $slug): ?int => $serviceIds->get($slug))
                ->filter()
                ->values()
                ->all();

            SeasonalSegment::updateOrCreate(
                ['name' => $segment['name']],
                [
                    'label' => $segment['label'],
                    'period' => $segment['period'],
                    'starts_at' => $segment['starts_at'],
                    'ends_at' => $segment['ends_at'],
                    'description' => $segment['description'],
                    'hero_subheadline' => $segment['hero_subheadline'],
                    'spotlight_title' => $segment['spotlight_title'],
                    'spotlight_description' => $segment['spotlight_description'],
                    'cta_label' => $segment['cta_label'],
                    'whatsapp_message' => $segment['whatsapp_message'],
                    'featured_service_ids' => $featuredIds ?: null,
                    'priority' => $segment['priority'],
                    'sort_order' => $order,
                    'is_active' => $segment['is_active'],
                ],
            );
        }
    }

    /**
     * @return array<int, array{
     *     name: string,
     *     label: string,
     *     period: string,
     *     starts_at: string,
     *     ends_at: string,
     *     description: ?string,
     *     hero_subheadline: ?string,
     *     spotlight_title: ?string,
     *     spotlight_description: ?string,
     *     cta_label: ?string,
     *     whatsapp_message: ?string,
     *     featured_slugs: array<int, string>,
     *     priority: int,
     *     is_active: bool
     * }>
     */
    private function segments(): array
    {
        return [
            [
                'name' => 'Contoh: Year-End Gathering',
                'label' => 'Contoh: Year-End Gathering',
                'period' => 'November-Desember 2026',
                'starts_at' => '2026-11-01',
                'ends_at' => '2026-12-31',
                'description' => 'Data contoh untuk mencoba kalender musiman. Jangan diaktifkan sebelum konten dan tanggal disetujui klien.',
                'hero_subheadline' => 'Contoh sub-headline musim: tutup tahun dengan gathering yang menyatukan tim.',
                'spotlight_title' => 'Contoh: Year-End Gathering',
                'spotlight_description' => 'Contoh data untuk mencoba band sorotan musim. Konten ini belum disetujui klien.',
                'cta_label' => 'Contoh: Minta Proposal Gathering',
                'whatsapp_message' => 'Halo, saya ingin bertanya tentang gathering akhir tahun. (data contoh)',
                'featured_slugs' => [
                    'outbound-fun-games-team-building',
                    'amazing-race-treasure-hunt',
                    'special-program-custom-event-mice',
                ],
                'priority' => 10,
                'is_active' => false,
            ],
            [
                'name' => 'Ramadan',
                'label' => 'Ramadan',
                'period' => 'Februari-Maret 2027',
                'starts_at' => '2027-02-08',
                'ends_at' => '2027-03-09',
                'description' => null,
                'hero_subheadline' => null,
                'spotlight_title' => null,
                'spotlight_description' => null,
                'cta_label' => null,
                'whatsapp_message' => null,
                'featured_slugs' => [],
                'priority' => 0,
                'is_active' => false,
            ],
            [
                'name' => 'Sekolah dan Universitas',
                'label' => 'Sekolah dan Universitas',
                'period' => 'Juni-Juli 2027',
                'starts_at' => '2027-06-01',
                'ends_at' => '2027-07-31',
                'description' => null,
                'hero_subheadline' => null,
                'spotlight_title' => null,
                'spotlight_description' => null,
                'cta_label' => null,
                'whatsapp_message' => null,
                'featured_slugs' => [],
                'priority' => 0,
                'is_active' => false,
            ],
        ];
    }
}
