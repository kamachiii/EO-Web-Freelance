# AGENTS.md

Panduan untuk AI coding agent (dan developer) yang mengerjakan website **MR Global Events & Solutions**. Baca seluruh file ini sebelum mengubah apa pun. Untuk pekerjaan tampilan (UI, warna, font, gambar), baca juga **`DESIGN.md`**, yang menjadi sumber kebenaran visual.

## 1. Ringkasan proyek

- **Klien:** Zahra, brand **MR Global Events & Solutions** (event organizer).
- **Developer:** Muhammad Kamil (Laravel developer, freelance).
- **Tujuan website:** menampilkan profil dan layanan, membawa calon klien ke WhatsApp (konsultasi gratis), dan muncul di Google saat orang mencari event organizer / outbound / team building di area Bogor, Puncak, Jabodetabek, Sukabumi, Bandung.
- **Target klien:** perusahaan swasta, instansi pemerintah, komunitas & organisasi, universitas, sekolah. Usulan segmen tambahan yang perlu dikonfirmasi klien: yayasan & asosiasi, brand & agensi, lembaga keuangan. Jangan menampilkan segmen tambahan sebagai klien aktif sebelum dikonfirmasi.
- **Segmen musiman:** Ramadan (target berbeda) dan sekolah setelah Ramadan. Korporat dan pemerintah tersedia sepanjang tahun. Label musiman tidak ditampilkan di hero sampai kontennya dikonfirmasi klien.
- **Website akan di-upgrade terus.** Tulis kode yang mudah dikembangkan, jangan membuat jalan pintas yang menyulitkan fase berikutnya.

## 2. Asumsi yang perlu dikonfirmasi

Agent tidak boleh menganggap ini sudah final. Jika kamu perlu mengubahnya, beri tahu developer.

- Stack: Laravel + Blade + Tailwind CSS (lihat bagian 3).
- Admin dashboard memakai Filament (Fase 3).
- Hosting: shared hosting dengan cPanel (PHP + MySQL), tanpa Node.js di server.
- Nama domain belum ditentukan. Usulan: `mrglobalevents.com` atau `mrglobal-events.id`. Jangan hardcode domain, pakai `APP_URL`.
- Logo belum ada. Gunakan placeholder teks "MR Global Events & Solutions" sampai logo masuk ke `public/images/brand/`.
- Email kontak `mrayaglobal@gmail.com` perlu dicek ejaannya ke klien.
- Badan hukum: klien menulis belum punya, tetapi teks Tentang Kami menyebut Mitra Raya Global. Intro memakai "Mitra Raya Global Events & Solutions" tanpa "PT". Sampai dikonfirmasi, **jangan** menampilkan nama PT di footer, schema markup, atau dokumen legal.

## 3. Tech stack

| Bagian | Pilihan |
|---|---|
| Backend | Laravel (versi stabil terbaru, cek `composer.json`), PHP sesuai kebutuhan Laravel tersebut |
| Frontend | Blade, Tailwind CSS, Vite, Alpine.js untuk interaksi kecil |
| Database | MySQL di produksi, SQLite atau MySQL untuk lokal |
| Admin (Fase 3) | Filament |
| Testing | Pest atau PHPUnit |
| Code style | Laravel Pint |

Aturan penting untuk shared hosting tanpa Node: **build aset di lokal** (`npm run build`) dan commit `public/build`, atau upload hasil build saat deploy. Jangan membuat fitur yang mewajibkan Node berjalan di server.

## 4. Perintah

```bash
# setup awal
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm install

# development
php artisan serve
npm run dev

# kualitas
php artisan test
./vendor/bin/pint

# build produksi
npm run build
```

Jalankan `pint` dan `php artisan test` sebelum menyatakan pekerjaan selesai.

## 5. Struktur dan konvensi kode

- Ikuti konvensi Laravel standar dan PSR-12. Format dengan Pint.
- Nama kode (class, variabel, route name, kolom DB) memakai **bahasa Inggris**. Teks yang tampil ke pengunjung memakai **bahasa Indonesia**.
- Controller tipis. Logika bisnis ke Action atau Service class kalau mulai panjang.
- Validasi lewat Form Request.
- Konten tidak boleh hardcode di dalam view. Pola yang dipakai:
  - Data situs yang jarang berubah (nama brand, tagline, kontak, area layanan) di `config/site.php`.
  - Konten yang akan dikelola klien nanti (layanan, segmen musiman, banner, portofolio, testimoni, paket) disimpan di **database lewat Eloquent model dan seeder sejak Fase 1**, supaya Fase 3 (dashboard) tinggal menambah UI admin tanpa migrasi besar.
- Gunakan komponen Blade untuk bagian yang berulang (kartu layanan, CTA WhatsApp, hero, footer).
- Satu tempat untuk membuat link WhatsApp (helper atau komponen), jangan menulis ulang URL di banyak view.
- Jangan menambah package baru tanpa alasan jelas. Sebutkan alasannya di pesan commit.

## 6. Halaman dan fase

### Fase 1: launching

| Route | Isi |
|---|---|
| `/` | Hero, Tentang singkat, Mengapa Memilih Kami (3 pilar), ringkasan layanan, CTA, kontak |
| `/tentang` | Siapa Kami, visi, misi |
| `/layanan` | Daftar layanan utama |
| `/layanan-pendukung` | Add-on: tenda dan alat pesta, videotron, backdrop dan photobooth, hiburan, MUA, merchandise, konsumsi dan dokumentasi |
| `/kontak` | WhatsApp, email, alamat, area layanan, form inquiry |

### Fase 2: konten dan SEO

| Route | Isi |
|---|---|
| `/layanan/{slug}` | Halaman per layanan (lihat daftar di bagian 7) |
| `/portofolio` | Galeri event (aktif setelah konten tersedia) |
| `/segmen/ramadan`, `/segmen/sekolah-universitas` | Halaman per segmen musiman |
| Testimoni | Section di beranda dan halaman terkait (aktif setelah ada testimoni nyata) |

Rancangan sorotan musim ada di `SEASONAL.md`. Ringkasnya: audiens (sekolah, kampus, perusahaan, instansi, komunitas) adalah halaman evergreen; musim adalah lapisan terjadwal di beranda dan halaman audiens. Hanya satu kampanye aktif pada satu waktu, H1 tidak berubah, dan kampanye tidak punya URL sendiri. Label musiman tetap tidak ditampilkan sampai kontennya dikonfirmasi klien.

### Fase 3: dashboard

- `/admin` (Filament): kelola banner dan highlight musiman, layanan, segmen, portofolio, testimoni, paket.
- Blog atau artikel untuk SEO.
- Beranda membaca banner aktif dari database sehingga klien bisa mengganti tampilan per musim tanpa developer.


## 7. Konten yang sudah pasti

### Brand

- **Nama:** MR Global Events & Solutions
- **Headline:** Push Your Limits, Build Your Team
- **Sub-headline:** Mitra profesional terpercaya untuk penyelenggaraan Corporate Outbound, Team Building, Adventure Experience, & MICE yang energik dan berdampak nyata.
- **CTA utama:** "Konsultasi Gratis Sekarang" (membuka WhatsApp) dan "Lihat Program Kami" (menuju `/layanan`).

### Kontak

- **WhatsApp:** +62 8577-123-9861, URL: `https://wa.me/6285771239861` (boleh diberi parameter `?text=` berisi pesan awal)
- **Email:** mrayaglobal@gmail.com (perlu konfirmasi, lihat bagian 2)
- **Basecamp:** Bogor (alamat lengkap belum ada)
- **Area layanan:** basis operasional Bogor & Puncak; jangkauan rutin Jabodetabek, Sukabumi, dan Bandung; skala nasional seluruh Indonesia

### Layanan utama (satu slug per layanan, bisa diatur di admin)

| Layanan | Slug |
|---|---|
| Outbound Fun Games & Team Building | `outbound-fun-games-team-building` |
| Capacity Building | `capacity-building` |
| Inflatable Games | `inflatable-games` |
| Amazing Race / Treasure Hunt | `amazing-race-treasure-hunt` |
| Trekking & Hiking | `trekking-hiking` |
| Extreme & Water Adventure (offroad 4x4, paintball, rafting) | `extreme-water-adventure` |
| Special Program, Custom Event, & MICE | `special-program-custom-event-mice` |

Deskripsi singkat tiap layanan ada di file brief klien. Salin maknanya, jangan mengarang detail baru (durasi, harga, kapasitas).

### Tiga pilar "Mengapa Memilih Kami"

Personnel, Program, Prices. Tampilkan sebagai tiga baris bernomor, bukan grid kartu. Keunggulan pendukung (fasilitator berpengalaman, harga kompetitif, fleksibilitas paket, konsultasi gratis) sudah tercakup di tiga pilar; jangan diulang sebagai grid terpisah.

### Misi (ringkas)

Integritas dan kejujuran, solusi menyeluruh full-service, serta standar keamanan dan kualitas. Tampilkan sebagai tiga komitmen bernomor.

## 8. Aturan konten dan kejujuran

- **Jangan mengarang** testimoni, nama klien, logo klien, angka event atau peserta, sertifikasi, penghargaan, atau harga. Jika datanya belum ada, sembunyikan section-nya (feature flag di `config/site.php` atau cek kosong di database) atau tampilkan placeholder yang jelas bertanda TODO untuk developer, bukan untuk pengunjung.
- **Harga paket belum ada.** Selama belum ada, gunakan CTA "Minta Penawaran". Jangan menulis angka harga.
- Klaim "tim bersertifikat" hanya ditampilkan jika klien memberi bukti sertifikatnya.
- Jangan menyalin foto atau teks dari website lain (termasuk situs referensi dan situs lokasi seperti Camp Hulu Cai Resort) tanpa izin. Gunakan foto milik klien, foto berlisensi jelas, atau placeholder netral.
- Bahasa: Indonesia, sapaan "Anda", nada profesional tapi hangat dan energik. Kalimat aktif, jelas, tanpa klise. Tombol menyebut hasilnya ("Konsultasi Gratis Sekarang", "Minta Penawaran"), bukan "Submit".

## 9. Desain

**Sumber kebenaran visual adalah `DESIGN.md`** (palet, tipografi, layout, komponen, hero, logo, aksesibilitas). Baca sebelum membuat atau mengubah UI. Jika `AGENTS.md` dan `DESIGN.md` berbeda soal tampilan, `DESIGN.md` menang. Untuk aturan kejujuran konten, bagian 8 di sini menang.

Referensi visual:

- Kanvas logo: ../resources/icon/*
- Gaya yang diminta klien mengikuti tigaenterprise.co.id dan fastmanagement.id. Referensi dipakai untuk struktur dan pola, bukan disalin.

Aturan desain yang tidak boleh dilanggar (ringkasan, detail di `DESIGN.md`):

- **Palet enam warna saja**, didefinisikan sebagai token di `tailwind.config.js`:

  ```js
  colors: {
    navy: '#14305B',
    white: '#FFFFFF',
    mist: '#E9F0F9',
    forest: '#1E7A5C',
    signal: '#F5821F',
    charcoal: '#1F2937',
  }
  ```

- **Oranye (`signal`) terutama untuk aksi** (CTA, WhatsApp, garis eyebrow, titik akhir headline). Teks di atas oranye wajib navy, jangan putih. Hijau (`forest`) hanya untuk keselamatan dan alam. Tanpa gradient dekoratif dan tanpa warna tambahan.
- **Font:** Montserrat untuk judul, Inter untuk isi, dimuat dari paket lokal.
- **Logo:** pakai file di `public/images/brand/` (`logo-icon.svg` untuk latar terang, `logo-icon-dark.svg` untuk latar navy), dan tag favicon di `DESIGN.md` bagian 3. Jangan mewarnai ulang atau mengubah bentuk logo.
- **Gambar hero memakai elemen `<img>`** (bukan background CSS), dengan `alt` spesifik, `width` dan `height`, `fetchpriority="high"`, format WebP di bawah 150 KB, dan `<picture>` dua potongan (6:5 desktop, 7:4 mobile). Hanya foto milik klien atau berizin. Jika foto belum ada, tampilkan panel `mist` dengan lambang logo, bukan kotak "menunggu foto" (itu khusus staging). Spesifikasi lengkap di `DESIGN.md` bagian 8.
- **Mobile-first.** Uji di lebar 360, 768, dan 1280 px. Tombol WhatsApp tampil di setiap halaman.
- **Aksesibilitas:** kontras teks minimal 4,5:1, elemen interaktif asli (`button`, `a`), fokus keyboard terlihat, `alt` pada semua gambar bermakna, heading berurutan, target sentuh minimal 44 px.
- Satu tempat untuk token dan gaya. Jangan menyebar nilai warna atau ukuran acak.
- Halaman yang belum punya desain (Tentang, detail layanan, portofolio, Kontak, dll.) harus mengikuti pola komponen di `DESIGN.md`. Jangan menambah gaya baru tanpa persetujuan developer.
- Palet dan logo adalah usulan developer dan belum disetujui klien. Jika klien meminta perubahan, ubah di `tailwind.config.js`, `DESIGN.md`, dan file logo saja.

## 10. SEO (prioritas utama klien)

- Setiap halaman punya `title` unik, `meta description`, canonical URL, dan Open Graph.
- Satu `h1` per halaman, struktur heading logis.
- URL pendek, huruf kecil, kata dipisah tanda hubung.
- `sitemap.xml` dan `robots.txt`.
- Structured data JSON-LD: `Organization` / `LocalBusiness` dengan nama brand, URL, kontak, dan area layanan. Isi hanya data yang sudah dikonfirmasi.
- Kata kunci awal: outbound Bogor, outbound Puncak, team building Jakarta, event organizer outbound, rafting Sukabumi, paintball Bogor, EO gathering perusahaan, amazing race team building. Pakai secara natural di judul, heading, dan isi, bukan diulang paksa.
- Performa: gambar dikompres dan memakai format modern (WebP), `loading="lazy"`, ukuran gambar eksplisit untuk mencegah layout shift. Gambar hero adalah elemen terbesar di layar pertama, jadi muat dengan prioritas tinggi dan ukuran terkontrol agar LCP baik. Target skor Lighthouse mobile di atas 90 untuk Performance, SEO, dan Accessibility.
- Siapkan embed Google Maps hanya setelah alamat basecamp dikonfirmasi. Google Business Profile dibuat terpisah oleh developer dan klien.

## 11. Keamanan dan privasi

- Jangan commit `.env`, kunci API, atau kredensial. Perbarui `.env.example` saat menambah variabel.
- Semua form memakai CSRF, validasi server-side, honeypot, dan `throttle` untuk mencegah spam.
- Data inquiry (nama, kontak, pesan) disimpan seperlunya, dan tidak ditampilkan publik.
- Jangan mencatat data pribadi pengunjung di log.
- Admin (Fase 3) wajib login, password kuat, dan tidak diindeks mesin pencari (`noindex`).
- Perbarui dependensi bila ada patch keamanan.

## 12. Git dan deployment

- Branch: `main` untuk yang siap rilis, `feature/<nama>` untuk pekerjaan baru.
- Commit kecil dengan pesan jelas (bahasa Indonesia atau Inggris, konsisten).
- Jangan force-push ke `main`.
- Deploy ke shared hosting: upload kode (atau `git pull`), `composer install --no-dev --optimize-autoloader`, jalankan migrasi, pastikan `public/build` sudah ada, set document root ke folder `public`, `php artisan config:cache`, `php artisan route:cache`, `php artisan view:cache`, dan `php artisan storage:link` bila perlu.
- `public/.htaccess` sudah mengatur cache aset statis: build Vite dan font 1 tahun, gambar 1 bulan. Jangan hapus blok `mod_expires` saat menambah aturan rewrite.
- Sebelum deploy: cek `APP_ENV=production`, `APP_DEBUG=false`, dan `APP_URL` benar.

## 13. Definisi selesai

Pekerjaan dianggap selesai jika:

1. Berjalan lokal tanpa error dan `php artisan test` lulus.
2. `./vendor/bin/pint` tidak menghasilkan perubahan.
3. Tampilan sudah dicek di mobile dan desktop.
4. Tidak ada konten karangan atau placeholder yang terlihat oleh pengunjung.
5. Meta SEO halaman yang dikerjakan sudah terisi.
6. Perubahan dijelaskan singkat: apa yang dibuat, asumsi yang dipakai, dan hal yang masih butuh input dari developer atau klien.

## 14. Hal yang masih menunggu dari klien

Daftar pertanyaan lengkap dan terprioritas ada di `CLIENT-QUESTIONS.md`.

- Logo dan panduan warna
- Foto hero (kegiatan tim dalam aksi, lihat `DESIGN.md` bagian 8) serta foto dan video lain (aktivitas, lokasi, event sebelumnya)
- Portofolio, testimoni, logo klien
- Paket dan harga (atau format "mulai dari")
- Detail tiap layanan: durasi, kapasitas, lokasi
- Alamat lengkap basecamp, Instagram dan sosmed lain, jam operasional
- Nama domain
- Warna atau mood yang disetujui
- Konfirmasi badan hukum, email, dan klaim sertifikasi
- Kalender musim, label, sub-headline, CTA, dan program unggulan per musim (`SEASONAL.md`)
