<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Draf contoh untuk mencoba editor artikel. Tidak terbit dan tanpa
     * tanggal terbit supaya tidak muncul di situs publik.
     */
    public function run(): void
    {
        foreach ($this->items() as $item) {
            Post::updateOrCreate(
                ['slug' => $item['slug']],
                [
                    'title' => $item['title'],
                    'excerpt' => $item['excerpt'],
                    'body' => $item['body'],
                    'cover_image' => null,
                    'published_at' => null,
                    'is_published' => false,
                ],
            );
        }
    }

    /**
     * @return array<int, array{title: string, slug: string, excerpt: string, body: string}>
     */
    private function items(): array
    {
        return [
            [
                'title' => 'Contoh: Cara Memilih Format Gathering Perusahaan',
                'slug' => 'contoh-cara-memilih-format-gathering-perusahaan',
                'excerpt' => 'Draf artikel contoh. Ganti dengan artikel asli sebelum diterbitkan.',
                'body' => "Artikel ini masih berupa contoh untuk mencoba editor.\n\nTulis isi artikel asli di sini, lalu atur tanggal terbit dan aktifkan status terbit.",
            ],
            [
                'title' => 'Contoh: Pertimbangan Menyusun Study Tour Sekolah',
                'slug' => 'contoh-pertimbangan-menyusun-study-tour-sekolah',
                'excerpt' => 'Draf artikel contoh. Belum untuk dibaca pengunjung.',
                'body' => "Artikel ini masih berupa contoh untuk mencoba editor.\n\nGanti seluruh isi dengan materi yang sudah disetujui klien.",
            ],
        ];
    }
}
