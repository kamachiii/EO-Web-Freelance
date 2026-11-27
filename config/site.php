<?php

/*
 * Data situs yang jarang berubah (docs/AGENTS.md bagian 5).
 * Teks diambil dari docs/CONTENT.md. Jangan menambah klaim, angka, nama klien,
 * testimoni, atau sertifikasi yang tidak ada di sana (docs/AGENTS.md bagian 8).
 * Konten yang akan dikelola klien (layanan, segmen, banner) tersimpan di database.
 */
return [

    'name' => 'MR Global Events & Solutions',

    'headline' => 'Push Your Limits, Build Your Team',

    'subheadline' => 'Mitra profesional terpercaya untuk penyelenggaraan Corporate Outbound, Team Building, Adventure Experience, & MICE yang energik dan berdampak nyata.',

    'whatsapp' => [
        'number' => '6285771239861',
        'display' => '+62 8577-123-9861',
        'default_message' => 'Halo, saya ingin berkonsultasi mengenai acara yang saya rencanakan.',
    ],

    // TODO(developer): konfirmasikan ejaan email ke klien (docs/AGENTS.md bagian 2).
    'email' => 'mrayaglobal@gmail.com',

    // Basecamp di Bogor; alamat lengkap belum ada dari klien.
    'basecamp' => 'Bogor',

    'service_areas' => [
        'Bogor',
        'Puncak',
        'Jabodetabek',
        'Sukabumi',
        'Bandung',
        'Seluruh Indonesia',
    ],

    // Area ditampilkan bertingkat, bukan daftar datar yang saling tumpang tindih.
    'service_area_groups' => [
        ['label' => 'Basis operasional', 'areas' => ['Bogor & Puncak']],
        ['label' => 'Jangkauan rutin', 'areas' => ['Jabodetabek', 'Sukabumi', 'Bandung']],
        ['label' => 'Skala nasional', 'areas' => ['Seluruh Indonesia']],
    ],

    'service_area_summary' => 'Berbasis di Bogor & Puncak. Melayani Jabodetabek, Sukabumi, dan Bandung, serta seluruh Indonesia.',

    'supporting_summary' => 'Tenda, videotron, backdrop dan photobooth, hiburan, MUA, merchandise, konsumsi, dan dokumentasi.',

    'target_clients' => [
        'Perusahaan Swasta',
        'Instansi Pemerintah',
        'Komunitas & Organisasi',
        'Universitas',
        'Sekolah',
    ],

    /*
     * Foto stok sementara sampai foto klien tersedia (docs/IMAGE-CREDITS.md).
     * Banner di database tetap menang atas nilai ini, sehingga klien bisa
     * mengganti foto hero dari dashboard di Fase 3.
     */
    'hero_image' => [
        'desktop' => 'images/hero/hero-desktop.webp',
        'mobile' => 'images/hero/hero-mobile.webp',
        'alt' => 'Ilustrasi peserta dalam kaos merah dan biru memberi semangat kepada rekan tim di taman.',
        'width' => 960,
        'height' => 800,
        'mobile_width' => 900,
        'mobile_height' => 514,
    ],

    'service_images' => [
        'outbound-fun-games-team-building' => [
            'file' => 'images/services/outbound-fun-games-team-building.webp',
            'alt' => 'Ilustrasi peserta berbagi tawa saat mengikuti permainan tim di taman.',
        ],
        'capacity-building' => [
            'file' => 'images/services/capacity-building.webp',
            'alt' => 'Ilustrasi peserta workshop berdiri di depan layar presentasi.',
        ],
        'inflatable-games' => [
            'file' => 'images/services/inflatable-games.webp',
            'alt' => 'Ilustrasi peserta bermain bowling dengan pin balon raksasa di lapangan rumput.',
        ],
        'amazing-race-treasure-hunt' => [
            'file' => 'images/services/amazing-race-treasure-hunt.webp',
            'alt' => 'Ilustrasi kelompok peserta membaca peta saat menyusuri hutan.',
        ],
        'trekking-hiking' => [
            'file' => 'images/services/trekking-hiking.webp',
            'alt' => 'Ilustrasi pendaki berjalan di punggung bukit menghadap pegunungan.',
        ],
        'extreme-water-adventure' => [
            'file' => 'images/services/extreme-water-adventure.webp',
            'alt' => 'Ilustrasi peserta rafting mengayuh perahu kuning di sungai berjeram.',
        ],
        'special-program-custom-event-mice' => [
            'file' => 'images/services/special-program-custom-event-mice.webp',
            'alt' => 'Ilustrasi pembicara di atas panggung menghadap peserta konferensi.',
        ],
    ],

    'og_image' => [
        'file' => 'images/og/og-default.jpg',
        'width' => 1200,
        'height' => 630,
    ],

    'about' => [
        // Intro memakai "Mitra Raya Global Events & Solutions" tanpa "PT".
        // Frasa "di bawah naungan PT Mitra Raya Global" tidak dipakai sampai
        // klien mengonfirmasi badan hukum (docs/CONTENT.md, catatan Tentang Kami).
        'intro' => [
            'Mitra Raya Global Events & Solutions hadir sebagai perusahaan event organizer (full-service) terpercaya yang siap menangani berbagai kebutuhan acara Anda: mulai dari corporate gathering, outbound, team building, hingga MICE berskala nasional.',
            'Kami percaya acara yang sukses tidak hanya diukur dari kemegahannya, tetapi juga dari kejujuran, transparansi, dan eksekusi yang bisa diandalkan. Lebih dari sekadar menyelenggarakan acara, kami berkomitmen menghadirkan pengalaman berkesan yang tertata, aman, dan sesuai tujuan Anda.',
        ],
    ],

    'vision' => 'Menjadi perusahaan event organizer pilihan utama yang jujur, terpercaya, dan profesional melalui penyelenggaraan acara berstandar tinggi.',

    'mission' => [
        [
            'title' => 'Integritas & Kejujuran',
            'text' => 'Menjalankan setiap kerja sama, perencanaan anggaran, dan operasional acara dengan prinsip transparansi penuh dan kejujuran kepada klien maupun vendor.',
        ],
        [
            'title' => 'Solusi Menyeluruh (Full-Service)',
            'text' => 'Menyediakan layanan terpadu dari A sampai Z, mulai dari konsep program, pengelolaan lapangan, logistik, konsumsi, merchandise, hingga dokumentasi secara profesional.',
        ],
        [
            'title' => 'Standar Keamanan & Kualitas',
            'text' => 'Mengutamakan keselamatan dan kenyamanan peserta melalui pengelolaan program adventure dan outbound yang terstruktur serta didukung oleh tim berpengalaman.',
        ],
    ],

    // Tiga pilar "Mengapa Memilih Kami".
    'pillars' => [
        [
            'title' => 'Personnel',
            'text' => 'Didukung tim, fasilitator, game master, dan kru lapangan yang berpengalaman mengelola dinamika kelompok serta keselamatan peserta.',
        ],
        [
            'title' => 'Program',
            'text' => 'Konsep kegiatan yang fleksibel dan dapat disesuaikan: outbound, team building, fun games, offroad, rafting, hingga MICE korporat.',
        ],
        [
            'title' => 'Prices',
            'text' => 'Estimasi biaya yang transparan dan kompetitif, disusun mengikuti kebutuhan, jumlah peserta, fasilitas, dan anggaran perusahaan Anda.',
        ],
    ],

    // Judul dan deskripsi meta tiap halaman (docs/AGENTS.md bagian 10).
    'seo' => [
        'home' => [
            'title' => 'MR Global Events & Solutions | Outbound & Team Building',
            'description' => 'Event organizer outbound, team building, adventure, dan MICE di Bogor & Puncak. Melayani Jabodetabek, Sukabumi, Bandung, dan seluruh Indonesia.',
        ],
        'about' => [
            'title' => 'Tentang Kami | MR Global Events & Solutions',
            'description' => 'Siapa kami, visi, dan misi MR Global Events & Solutions, event organizer full-service untuk acara perusahaan, instansi, komunitas, dan sekolah.',
        ],
        'services' => [
            'title' => 'Layanan Outbound & Team Building | MR Global',
            'description' => 'Outbound, team building, capacity building, inflatable games, amazing race, trekking, water adventure, hingga MICE. Minta penawaran.',
        ],
        'supporting_services' => [
            'title' => 'Layanan Pendukung Acara | MR Global Events & Solutions',
            'description' => 'Tenda dan alat pesta, videotron, backdrop dan photobooth, hiburan, MUA, merchandise, konsumsi, dan dokumentasi untuk melengkapi acara Anda.',
        ],
        'contact' => [
            'title' => 'Kontak dan Konsultasi Gratis | MR Global Events & Solutions',
            'description' => 'Konsultasi gratis via WhatsApp, atau kirim pesan untuk meminta penawaran acara perusahaan, instansi, komunitas, dan sekolah.',
        ],
        'privacy' => [
            'title' => 'Kebijakan Privasi | MR Global Events & Solutions',
            'description' => 'Cara MR Global Events & Solutions mengumpulkan, menggunakan, dan menyimpan data yang Anda kirim melalui situs ini.',
        ],
    ],

    // Section yang isinya belum ada dari klien disembunyikan sampai datanya masuk.
    'features' => [
        'testimonials' => false,
        'portfolio' => false,
        'packages' => false,
        'map' => false,          // alamat lengkap basecamp belum ada
        'social_media' => false, // Instagram dan sosmed lain belum ada
        'schema_email' => false, // email belum dikonfirmasi; jangan masukkan ke JSON-LD
    ],
];
