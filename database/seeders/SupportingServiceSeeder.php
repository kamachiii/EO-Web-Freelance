<?php

namespace Database\Seeders;

use App\Models\SupportingServiceCategory;
use App\Models\SupportingServiceItem;
use Illuminate\Database\Seeder;

class SupportingServiceSeeder extends Seeder
{
    /**
     * Kategori add-on dan itemnya diambil dari docs/CONTENT.md
     * (bagian "Add-on dan layanan pendukung acara").
     */
    public function run(): void
    {
        foreach ($this->categories() as $order => $category) {
            $model = SupportingServiceCategory::updateOrCreate(
                ['slug' => $category['slug']],
                [
                    'name' => $category['name'],
                    'sort_order' => $order,
                ],
            );

            foreach ($category['items'] as $itemOrder => $item) {
                SupportingServiceItem::updateOrCreate(
                    ['category_id' => $model->id, 'name' => $item['name']],
                    [
                        'description' => $item['description'],
                        'sort_order' => $itemOrder,
                    ],
                );
            }
        }
    }

    /**
     * @return array<int, array{name: string, slug: string, items: array<int, array{name: string, description: string}>}>
     */
    private function categories(): array
    {
        return [
            [
                'name' => 'Perlengkapan & Infrastruktur Acara',
                'slug' => 'perlengkapan-infrastruktur-acara',
                'items' => [
                    [
                        'name' => 'Tenda & Alat Pesta',
                        'description' => 'Penyediaan tenda (kerucut, roder, atau dekorasi), meja, kursi futura/iffany, AC portabel, dan perlengkapan pesta lainnya.',
                    ],
                    [
                        'name' => 'Videotron',
                        'description' => 'Layanan sewa layar LED (videotron) indoor/outdoor untuk presentasi, latar panggung, atau live cam acara korporat.',
                    ],
                    [
                        'name' => 'Backdrop & Photobooth',
                        'description' => 'Pembuatan dekorasi panggung (backdrop), instalasi visual perusahaan, serta photobooth interaktif untuk area penyambutan tamu.',
                    ],
                ],
            ],
            [
                'name' => 'Hiburan & Kesenian (Entertainment)',
                'slug' => 'hiburan-kesenian',
                'items' => [
                    [
                        'name' => 'Modern & Band Panggung',
                        'description' => 'Organ tunggal, full band, atau acoustic band untuk memeriahkan acara.',
                    ],
                    [
                        'name' => 'Musik Etnik & Tradisional',
                        'description' => 'Pilihan musik otentik seperti keroncong, gamelan, atau musik khas daerah nusantara (sangat cocok untuk konsep gathering kultural atau penyambutan tamu VVIP).',
                    ],
                ],
            ],
            [
                'name' => 'Kecantikan & Penampilan',
                'slug' => 'kecantikan-penampilan',
                'items' => [
                    [
                        'name' => 'Make Up Artist (MUA)',
                        'description' => 'Layanan tata rias profesional untuk pengisi acara, pembawa acara (MC), panitia inti, maupun kebutuhan wedding atau private party.',
                    ],
                ],
            ],
            [
                'name' => 'Merchandise & Atribut Perusahaan',
                'slug' => 'merchandise-atribut-perusahaan',
                'items' => [
                    [
                        'name' => 'Merchandise & Atribut Perusahaan',
                        'description' => 'Sablon kaos/jersey tim, topi rimba (jungle hat), tas goodie bag kain, tumbler, hingga lanyard ID card tematik.',
                    ],
                ],
            ],
            [
                'name' => 'Konsumsi & Dokumentasi',
                'slug' => 'konsumsi-dokumentasi',
                'items' => [
                    [
                        'name' => 'Konsumsi & Dokumentasi',
                        'description' => 'Paket lunch, snack box, kambing guling, air mineral, serta dokumentasi foto & video sinematik (drone).',
                    ],
                ],
            ],
        ];
    }
}
