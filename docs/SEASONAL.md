# SEASONAL.md

Rancangan sistem **sorotan musim** untuk website MR Global Events & Solutions. Dokumen ini menjelaskan konsep, aturan konten, model data, alur teknis, dan rencana implementasi. Aturan visual tetap mengikuti `DESIGN.md`; aturan kejujuran konten tetap mengikuti `AGENTS.md` bagian 8.

Status: **inti sorotan musim sudah diimplementasikan (Fase 3).** Yang aktif: resolver satu kampanye, perubahan hero (eyebrow, sub-headline, CTA, pesan WhatsApp), band sorotan dengan maksimal tiga program unggulan, dan pratinjau admin. Halaman audiens, foto kampanye, dan konten musiman final masih menunggu klien. Tidak ada label musiman yang tampil ke pengunjung sampai admin mengaktifkan kampanye yang sudah disetujui.

Catatan implementasi: tabel tetap bernama `seasonal_segments` (rename ke `seasonal_campaigns` ditunda). Kolom tambahan yang sudah ada: `priority`, `hero_subheadline`, `spotlight_title`, `spotlight_description`, `cta_label`, `whatsapp_message`, dan `featured_service_ids`. Pratinjau memakai `/?preview={id}` dan hanya berlaku untuk admin atau `APP_ENV=local`.

---

## 1. Tujuan

Website harus terasa sedang berada di musim yang tepat tanpa mengubah identitas brand.

- Saat musim sekolah/kampus, pengunjung dari segmen pendidikan melihat program, bahasa, gambar, dan CTA yang paling relevan.
- Saat musim korporat, pengunjung korporat melihat hal yang setara untuk kebutuhan mereka.
- Perubahan harus bisa dijadwalkan, tidak mengubah URL, tidak merusak SEO, dan tetap menampilkan website yang utuh ketika tidak ada kampanye aktif.

Yang **tidak** dilakukan:

- Tidak membuat versi musiman terpisah dari beranda.
- Tidak mengganti H1, logo, palet, atau font per musim.
- Tidak menampilkan popup, countdown, salju, confetti, atau carousel musiman.
- Tidak mengarang promo, harga, kuota, atau klaim "terbatas".

---

## 2. Keputusan inti

**Satu lapisan sorotan musiman, bukan redesign musiman.**

Sistem memisahkan dua hal yang sering tercampur:

| Konsep | Arti | Sifat | Punya URL sendiri? |
|---|---|---|---|
| **Audiens** | Siapa yang dilayani: sekolah, kampus, perusahaan, instansi, komunitas | Evergreen, selalu relevan | Ya, halaman audiens |
| **Musim** | Kapan sorotan itu aktif: window tanggal, copy, program unggulan, CTA | Terjadwal, sementara | Tidak |

Kampanye musiman **menumpang** di beranda dan halaman audiens. Kampanye tidak membuat halaman baru setiap tahun. Ini mencegah:

- halaman tipis dan duplikat;
- tautan musiman yang mati setelah musim berakhir;
- fragmentasi analytics;
- beban maintenance tahunan.

Halaman audiens tetap menjadi tujuan SEO jangka panjang. Kampanye musiman menjadi lapisan konversi jangka pendek.

---

## 3. Peta audiens

Mengikuti target klien di `CONTENT.md`. Halaman audiens adalah halaman evergreen, bukan halaman musiman.

| Key | Label publik | URL usulan | Status |
|---|---|---|---|
| `corporate` | Perusahaan | `/perusahaan` | Fase 2B |
| `school` | Sekolah | `/sekolah` | Fase 2B |
| `campus` | Universitas & Kampus | `/kampus` | Fase 2B |
| `government` | Instansi Pemerintah | `/instansi` | Fase 2B |
| `community` | Komunitas & Organisasi | `/komunitas` | Fase 2B |
| `ramadan` | Ramadan | belum ada | Menunggu konten klien |

Catatan:

- `AGENTS.md` sebelumnya menyebut `/segmen/ramadan` dan `/segmen/sekolah-universitas`. Rancangan ini mengusulkan URL yang lebih pendek dan terpisah per audiens. Perubahan ini perlu disetujui developer sebelum route dibuat.
- Ramadan bukan audiens permanen. Ramadan adalah musim. Halaman Ramadan hanya dibuat jika klien benar-benar punya penawaran Ramadan yang isinya bisa dikonfirmasi. Selama belum ada, jangan buat halaman Ramadan.
- Jangan menampilkan audiens tambahan (yayasan, asosiasi, brand, agensi, lembaga keuangan) sebelum dikonfirmasi klien.

---

## 4. Kalender musim

Tabel ini adalah **usulan perencanaan**, bukan fakta. Tanggal sekolah, wisuda, dan Ramadan berbeda tiap tahun dan tiap daerah. Klien harus mengonfirmasi window yang benar.

| Window usulan | Audiens | Fokus | Program unggulan usulan | Prioritas awal | Status |
|---|---|---|---|---|---|
| Jan–Feb | `corporate` | Kickoff dan gathering awal tahun | Capacity Building, Outbound, MICE | 50 | Perlu konfirmasi |
| Feb–Mar | `ramadan` | Penawaran Ramadan, jika ada | Belum ditentukan | 0 | Nonaktif sampai konten ada |
| Mar–Apr | `corporate` | Halal bihalal dan gathering setelah Lebaran | Outbound, Inflatable Games, MICE | 40 | Perlu konfirmasi |
| Mei–Jun | `school` | Akhir tahun ajaran, study tour, wisuda | Outbound, Amazing Race, Trekking | 70 | Perlu konfirmasi |
| Jun–Jul | `campus` | Wisuda dan kegiatan fakultas | Outbound, Capacity Building, Amazing Race | 65 | Perlu konfirmasi |
| Jul–Agt | `school` | Tahun ajaran baru dan MPLS | Outbound, Inflatable Games, Capacity Building | 75 | Perlu konfirmasi |
| Agt–Sep | `campus` | Orientasi mahasiswa baru | Outbound, Capacity Building, Amazing Race | 65 | Perlu konfirmasi |
| Sep–Okt | `school` | Study tour semester ganjil | Outbound, Amazing Race, Trekking | 60 | Perlu konfirmasi |
| Nov–Des | `corporate` | Year-end gathering dan family gathering | Outbound, Amazing Race, MICE | 80 | Perlu konfirmasi |
| Nov–Des | `government` | Kegiatan akhir tahun anggaran | MICE, Capacity Building | 55 | Perlu konfirmasi |

Aturan kalender:

- Window bertumpuk mungkin terjadi (misalnya sekolah dan kampus pada Juni–Agustus). Sistem hanya menampilkan **satu** kampanye. Prioritas menentukan pemenang.
- Jika dua audiens sama-sama penting, jangan menumpuk dua banner. Pilih salah satu:
  1. buat satu kampanye gabungan dengan label "Musim Sekolah & Kampus";
  2. bagi window menjadi dua periode yang tidak bertumpuk;
  3. naikkan prioritas salah satu dan tampilkan yang lain di halaman audiensnya masing-masing.
- Ramadan selalu berpindah tanggal. Jangan hardcode tanggal Ramadan di kode. Isi `starts_at` dan `ends_at` per tahun lewat admin.
- Jangan menyebut "musim" sebagai fakta jika klien belum mengonfirmasi bahwa memang ada permintaan tinggi pada periode itu.

---

## 5. Aturan aktivasi

Satu kampanye aktif pada satu waktu.

Urutan penentuan:

1. Jika fitur dimatikan (`config('site.features.seasonal_spotlight')` bernilai `false`), tidak ada kampanye.
2. Kandidat: `is_active = true`, `starts_at` kosong atau sudah lewat, `ends_at` kosong atau belum lewat.
3. Urutkan: `priority` terbesar, lalu `starts_at` terbaru, lalu `id` terbaru.
4. Ambil satu.
5. Jika tidak ada kandidat, kembalikan `null` dan tampilkan beranda default.

Aturan tanggal:

- Zona waktu: `Asia/Jakarta`.
- `starts_at` dan `ends_at` disimpan sebagai `date`.
- Kampanye aktif mulai awal hari `starts_at` dan berakhir akhir hari `ends_at`.
- `starts_at` kosong berarti sudah mulai. `ends_at` kosong berarti tidak berakhir.
- Validasi admin: `ends_at` tidak boleh lebih awal dari `starts_at`.
- Jangan mengandalkan cron untuk pergantian. Resolver memeriksa tanggal setiap request. Cache tidak boleh hidup melewati batas hari.

Mode preview:

- `?preview={slug}` hanya berfungsi untuk user yang sudah login sebagai admin, atau saat `APP_ENV=local`.
- Halaman preview memakai `noindex, nofollow`.
- Pengunjung biasa tidak boleh bisa mengaktifkan kampanye lewat query string.

---

## 6. Pengalaman pengunjung

### 6.1 Hero beranda

Perubahan hanya di dalam hero. Struktur, H1, dan tinggi hero tetap.

| Elemen | Tanpa kampanye | Dengan kampanye |
|---|---|---|
| Eyebrow di atas H1 | Tidak ada | Label kampanye, misalnya "Musim Study Tour Sekolah" |
| H1 | `Push Your Limits, Build Your Team.` | **Tetap sama** |
| Sub-headline | `config('site.subheadline')` | `hero_subheadline` kampanye, fallback ke default |
| Tombol utama | "Konsultasi Gratis Sekarang" | `cta_label` kampanye, misalnya "Minta Proposal Study Tour" |
| Pesan WhatsApp | Pesan default | `whatsapp_message` kampanye |
| Tombol kedua | "Lihat Program Kami" | "Lihat Program Sekolah" menuju halaman audiens, fallback ke `/layanan` |
| Blok area layanan | Tetap | Tetap |
| Foto | Foto default | Foto kampanye jika ada, fallback ke default |

Aturan:

- H1 tidak berubah. H1 adalah janji brand dan jangkar SEO. Variasi musiman masuk lewat eyebrow, sub-headline, CTA, dan gambar.
- Eyebrow memakai komponen `x-eyebrow` dengan `tone="dark"` di atas navy.
- Jika kampanye tidak punya `hero_subheadline`, jangan tampilkan sub-headline kosong. Pakai default.
- Jika kampanye tidak punya foto, jangan tampilkan placeholder musiman. Pakai foto default.
- Animasi hero yang ada (`hero-rise`, `media-in`) tetap dipakai. Tidak ada animasi baru.
- Jangan mengubah header, menu, atau tombol CTA di header. Header tetap netral di semua musim.

### 6.2 Strip audiens

Strip "Kami melayani" **tidak berubah** dan tidak diurutkan ulang.

Alasannya: strip ini adalah pernyataan brand bahwa semua segmen dilayani. Mengurutkan ulang atau menyembunyikan segmen bisa terbaca sebagai pengecualian. Sorotan musiman sudah punya tempatnya sendiri.

### 6.3 Band sorotan musim

Band baru yang hanya muncul jika ada kampanye aktif. Letaknya di bawah strip audiens dan di atas section "Siapa Kami?".

Struktur desktop (12 kolom):

- Kiri, 5 kolom: eyebrow "Sorotan musim", H2 (label atau `spotlight_title`), satu paragraf `spotlight_description`.
- Kanan, 7 kolom: 2–3 program unggulan sebagai baris teks bernomor, masing-masing menuju halaman detail layanan; lalu CTA utama dan tautan ke halaman audiens.
- Latar `mist`, border atas dan bawah `line`. Tanpa kartu, tanpa foto, tanpa ikon bulat.
- Tinggi kira-kira 280–420 px di desktop. Bukan cover satu layar.

Struktur mobile:

- Bertumpuk: eyebrow, H2, paragraf, daftar program, CTA.
- Program unggulan tetap berupa baris teks, bukan kartu.
- Target sentuh minimal 44 px.

Aturan:

- Jika hanya ada 2 program unggulan, tampilkan 2. Jangan memaksakan 3.
- Jika tidak ada program unggulan, tampilkan dua CTA: WhatsApp dan halaman audiens.
- Jika halaman audiens belum ada, CTA kedua menuju `/layanan`. Jangan membuat tautan mati.
- Jangan menampilkan harga, diskon, atau kuota di band ini kecuali klien mengonfirmasi.
- Jangan memakai foto di band. Foto musiman hanya di hero, agar halaman tetap ringan dan fokus.

### 6.4 Katalog layanan

Katalog permanen **tidak diurutkan ulang** dan tidak diberi badge musiman.

Alasannya:

- Urutan katalog adalah struktur navigasi yang stabil.
- Badge musiman di banyak item akan mengaburkan fokus band sorotan.
- Program unggulan sudah ditonjolkan di band dan hero.

Jika nanti klien ingin penanda di katalog, gunakan label teks kecil "Sorotan musim" di atas judul item, bukan warna atau badge baru. Perubahan ini harus disetujui developer.

### 6.5 Halaman audiens

Halaman audiens adalah tujuan kampanye dan tujuan SEO jangka panjang.

Struktur:

1. Cover halaman: H1 label audiens, paragraf pembuka, band navy berisi jumlah program dan tautan ke program.
2. "Program untuk {audiens}": 3–6 layanan relevan, memakai komponen katalog yang ada.
3. "Mengapa memilih kami": tiga pilar yang sudah ada, tanpa klaim baru.
4. FAQ: hanya jika klien memberi pertanyaan dan jawaban nyata.
5. Panel CTA: WhatsApp dengan pesan yang menyebut audiens.

Aturan:

- Halaman audiens tidak boleh hanya berisi daftar layanan yang sama dengan beranda. Minimal ada paragraf pembuka yang unik dan relevan.
- Jangan mengarang jumlah peserta, jumlah event, atau testimoni.
- Jika konten belum cukup, jangan rilis halaman audiens. Kampanye tetap bisa menuju WhatsApp atau `/layanan`.
- Halaman audiens masuk sitemap. Kampanye tidak.

### 6.6 Halaman lain

- Detail layanan: tidak berubah karena musim.
- Layanan pendukung: tidak berubah.
- Tentang: tidak berubah.
- Kontak: tidak berubah, kecuali pesan WhatsApp yang sudah ada.
- Footer: tidak berubah.

Prinsipnya: sorotan musiman hanya di beranda dan halaman audiens. Jangan menyebar label musiman ke seluruh situs.

---

## 7. Aturan visual

Rancangan sistem lengkap ada di dokumen ini; aturan visual tetap di `DESIGN.md`.

- **Palet tetap enam warna.** Tidak ada warna musiman baru (hijau Ramadan, merah Natal, dan sebagainya).
- Identitas musiman dibangun dari **copy, foto, dan program unggulan**, bukan dari warna.
- Oranye tetap untuk aksi: garis eyebrow, tombol utama. Jangan memakai oranye sebagai latar band musiman.
- Eyebrow di atas navy: teks `mist`, garis `signal`.
- Band sorotan: latar `mist`, teks `navy`/`charcoal`, CTA oranye.
- Tanpa gradient, glassmorphism, bayangan berlapis, atau ilustrasi dekoratif.
- Tanpa popup, countdown, carousel, atau auto-play.
- Foto kampanye mengikuti spesifikasi hero: `<picture>` dua potongan, WebP, `width`/`height`, `alt` spesifik, `fetchpriority="high"`, di bawah 180 KB per potongan.
- Jika foto kampanye tidak ada, pakai foto default. Jangan memakai foto stok baru tanpa mencatat lisensi di `IMAGE-CREDITS.md`.
- Gerak: hanya `hero-rise` dan `media-in` yang sudah ada. Band sorotan boleh memakai satu `data-reveal`, tidak lebih.

---

## 8. Model data

### 8.1 Tabel `seasonal_campaigns`

Rename dari `seasonal_segments` saat implementasi. Belum ada data produksi, jadi rename aman. Jika rename ditunda, model baru tetap boleh memakai tabel lama dengan `$table`, tetapi nama `seasonal_segments` tidak lagi mencerminkan isinya.

| Kolom | Tipe | Nullable | Catatan |
|---|---|---|---|
| `id` | bigint unsigned | tidak | Primary key |
| `slug` | string(80) | tidak | Unik, untuk preview dan analytics |
| `name` | string(120) | tidak | Nama internal, tidak tampil |
| `label` | string(160) | tidak | Eyebrow publik, misalnya "Musim Study Tour Sekolah" |
| `audience` | string(40) | tidak | `corporate`, `school`, `campus`, `government`, `community`, `ramadan` |
| `period_label` | string(120) | ya | Teks tampilan, misalnya "Mei–Juni 2027" |
| `starts_at` | date | ya | Awal window |
| `ends_at` | date | ya | Akhir window |
| `priority` | unsigned small int | tidak | Default 0, makin besar makin diprioritaskan |
| `hero_subheadline` | text | ya | Menggantikan sub-headline default |
| `spotlight_title` | string(160) | ya | Fallback ke `label` |
| `spotlight_description` | text | ya | Satu paragraf pendek |
| `cta_label` | string(80) | ya | Fallback "Konsultasi Gratis Sekarang" |
| `whatsapp_message` | text | ya | Pesan awal WhatsApp |
| `audience_url` | string(255) | ya | Path internal, misalnya `/sekolah` |
| `featured_service_ids` | json | ya | Maksimal 3 ID layanan, urut |
| `image_desktop` | string(255) | ya | Nama file di `public/images/hero/` |
| `image_mobile` | string(255) | ya | Nama file di `public/images/hero/` |
| `image_alt` | string(255) | ya | Wajib jika ada gambar |
| `is_active` | boolean | tidak | Default false |
| `created_at`, `updated_at` | timestamp | ya | |

Index: `(is_active, starts_at, ends_at)`, `priority`, `audience`, `slug` unik.

Catatan:

- `featured_service_ids` memakai JSON karena maksimal 3 item dan tidak perlu pivot. Saat render, filter ID yang layanannya tidak aktif atau sudah dihapus.
- `audience_url` divalidasi sebagai path internal, bukan URL eksternal. Jangan biarkan admin mengisi `javascript:` atau URL pihak ketiga.
- `image_*` disimpan sebagai nama file, bukan URL penuh, agar `APP_URL` tetap satu sumber.
- Jangan menyimpan HTML mentah dari admin. Semua teks di-escape Blade.

### 8.2 Tabel `audience_pages` (Fase 2B)

| Kolom | Tipe | Catatan |
|---|---|---|
| `id` | bigint unsigned | |
| `slug` | string(80) | Unik, misalnya `sekolah` |
| `label` | string(120) | H1 dan menu |
| `intro` | text | Paragraf pembuka |
| `description` | text | Konteks tambahan |
| `meta_title` | string(160) | SEO |
| `meta_description` | string(255) | SEO |
| `image` | string(255) | Opsional |
| `is_active` | boolean | Default false |
| `sort_order` | unsigned small int | |
| timestamps | | |

Halaman audiens memakai tabel ini agar klien bisa mengedit di Fase 3 tanpa migrasi besar. Jika Fase 2B ditunda, kampanye tetap bisa berjalan dengan `audience_url` kosong.

### 8.3 Relasi

- `SeasonalCampaign` tidak perlu relasi Eloquent ke `Service` jika memakai JSON. Resolver mengambil `Service::active()->whereIn('id', $ids)` dan mengurutkan sesuai urutan JSON.
- `AudiencePage` tidak perlu relasi ke `Service` pada MVP. Jika nanti butuh program per audiens, tambahkan pivot `audience_page_service`.

---

## 9. Alur teknis

### 9.1 Class dan file

| File | Fungsi |
|---|---|
| `app/Models/SeasonalCampaign.php` | Model, scope `active`, cast tanggal/JSON/boolean |
| `app/Actions/ResolveSeasonalCampaign.php` | Menentukan kampanye aktif |
| `app/Http/Controllers/HomeController.php` | Mengirim `$campaign` dan `$featuredServices` ke view |
| `resources/views/components/seasonal-spotlight.blade.php` | Band sorotan |
| `resources/views/home.blade.php` | Eyebrow, sub-headline, CTA, gambar kampanye |
| `database/seeders/SeasonalCampaignSeeder.php` | Dua kampanye nonaktif |
| `tests/Feature/SeasonalCampaignTest.php` | Test resolver dan tampilan |

### 9.2 Resolver

Pseudo-code:

```php
$now = now('Asia/Jakarta');

return SeasonalCampaign::query()
    ->where('is_active', true)
    ->where(function ($query) use ($now) {
        $query->whereNull('starts_at')
            ->orWhereDate('starts_at', '<=', $now->toDateString());
    })
    ->where(function ($query) use ($now) {
        $query->whereNull('ends_at')
            ->orWhereDate('ends_at', '>=', $now->toDateString());
    })
    ->orderByDesc('priority')
    ->orderByDesc('starts_at')
    ->orderByDesc('id')
    ->first();
```

### 9.3 Cache

- Cache key: `seasonal.active`.
- TTL: 5 menit, atau sampai akhir hari, mana yang lebih pendek.
- `Cache::forget('seasonal.active')` saat kampanye disimpan, diaktifkan, atau dihapus.
- Jangan cache `null` selamanya. Jika tidak ada kampanye, tetap pakai TTL.
- Jika memakai full-page cache di hosting, pastikan cache key menyertakan tanggal `Asia/Jakarta`, atau matikan full-page cache untuk beranda.
- Jangan menyimpan kampanye di `config:cache`; datanya berubah dan harus dibaca dari database.

### 9.4 Query efficiency

- Satu query untuk kampanye.
- Satu query untuk layanan unggulan.
- Eager loading tidak diperlukan jika memakai JSON, tetapi pastikan tidak ada query di dalam loop view.
- Jika tidak ada kampanye, jangan query layanan unggulan.

### 9.5 Fallback berurutan

1. `featured_service_ids` kosong atau semua tidak aktif → tampilkan CTA saja.
2. `audience_url` kosong atau halaman tidak aktif → tautan ke `/layanan`.
3. `hero_subheadline` kosong → sub-headline default.
4. `cta_label` kosong → "Konsultasi Gratis Sekarang".
5. `whatsapp_message` kosong → pesan default.
6. `image_desktop`/`image_mobile` kosong → foto default.
7. `spotlight_title` kosong → `label`.
8. `spotlight_description` kosong → band tetap tampil dengan judul dan CTA, tanpa paragraf.
9. Tidak ada kampanye → beranda default, tanpa band.

---

## 10. Admin Fase 3

Resource Filament "Sorotan Musim".

Daftar:

- Kolom: label, audiens, periode, status (Aktif / Terjadwal / Selesai / Nonaktif), prioritas.
- Filter: status, audiens, tahun.
- Aksi: lihat, edit, duplikat, aktifkan/nonaktifkan, arsipkan.
- Urutan default: tanggal mulai terbaru.

Form:

1. **Identitas**: nama internal, slug, label publik, audiens.
2. **Jadwal**: `starts_at`, `ends_at`, prioritas, `is_active`.
3. **Konten**: hero sub-headline, judul sorotan, deskripsi sorotan, CTA, pesan WhatsApp, URL audiens.
4. **Program unggulan**: pilih maksimal 3 layanan aktif, bisa diurutkan.
5. **Gambar**: unggah desktop dan mobile, alt wajib jika gambar diisi.
6. **Pratinjau**: tombol "Lihat pratinjau" membuka beranda dengan `?preview={slug}`.

Validasi:

- `ends_at >= starts_at`.
- `slug` unik dan hanya huruf kecil, angka, tanda hubung.
- `audience_url` diawali `/` dan tidak mengandung `//`, `http`, atau `javascript:`.
- Minimal 2 program unggulan jika `featured_service_ids` diisi; maksimal 3.
- `image_alt` wajib jika salah satu gambar diisi.
- `label` maksimal 60 karakter agar tidak merusak hero.
- `hero_subheadline` maksimal 180 karakter.
- `spotlight_description` maksimal 240 karakter.

Peringatan konflik:

- Saat menyimpan kampanye aktif, cek kampanye lain yang window-nya bertumpuk.
- Tampilkan nama dan prioritas kampanye lain.
- Jangan blokir; beri peringatan karena overlap bisa disengaja.
- Jika prioritas sama, kampanye dengan `starts_at` terbaru menang. Jelaskan di UI.

Aksi duplikat:

- Salin semua field, set `slug` baru, `starts_at`/`ends_at` kosong, `is_active` false.
- Berguna untuk kampanye tahunan.

Hak akses:

- Hanya admin.
- `updated_by` dan `updated_at` dicatat.
- Jangan mengizinkan editor mengubah `priority` tanpa izin, jika nanti ada peran editor.

Penyimpanan gambar:

- Gunakan disk `public`, folder `seasonal/`.
- Simpan nama file di database.
- Jalankan `php artisan storage:link` saat deploy.
- Jangan menyimpan gambar di `public/images/hero/` secara manual dari admin; gunakan storage agar aman.

---

## 11. SEO

Prinsip: **sorotan musiman adalah lapisan konversi, bukan strategi URL.**

- Judul dan meta description beranda **tidak berubah** per musim. Ini menjaga stabilitas SERP dan menghindari judul yang berubah-ubah.
- H1 beranda tetap.
- Kampanye tidak punya URL sendiri. Tidak ada `/musim/2027` atau `/promo-sekolah`.
- Halaman audiens adalah URL yang diindeks. Setiap halaman punya title, meta description, canonical, dan OG sendiri.
- Sitemap hanya memuat halaman audiens, bukan kampanye.
- Canonical beranda tetap `route('home')`.
- JSON-LD `Organization` tetap. Jangan menambahkan `Event` kecuali ada event nyata dengan tanggal dan lokasi.
- Untuk halaman audiens, `Service` schema boleh ditambahkan hanya jika isinya nyata: nama layanan, deskripsi, area layanan. Jangan mengarang `offers` atau harga.
- Kata kunci audiens dipakai natural: "outbound sekolah Bogor", "study tour Puncak", "team building perusahaan Jakarta", "gathering kantor", "orientasi mahasiswa". Jangan mengulang di setiap paragraf.
- Internal link: beranda → halaman audiens → detail layanan → kontak. Kampanye memperkuat jalur ini.
- Jika klien ingin halaman penawaran musiman dengan konten unik (misalnya paket Ramadan), buat halaman sendiri dengan canonical self, konten asli, dan `noindex` sampai kontennya cukup. Jangan membuat halaman tipis.

Yang perlu dihindari:

- Mengubah title beranda menjadi "Promo Outbound Sekolah 2027" tanpa konten pendukung.
- Membuat halaman berbeda untuk setiap tahun.
- Menyalin deskripsi layanan ke halaman audiens tanpa penyesuaian.
- Menampilkan harga atau diskon musiman yang belum dikonfirmasi.

---

## 12. Analytics

Tujuan: tahu kampanye mana yang menghasilkan percakapan, bukan sekadar kunjungan.

Atribut data yang dipasang:

- `data-seasonal-campaign="{slug}"` pada hero dan band.
- `data-seasonal-placement="hero|spotlight"`.
- `data-audience="{audience}"`.
- `data-cta="whatsapp|audience|services"`.

Event yang disarankan:

| Event | Kapan | Properti |
|---|---|---|
| `seasonal_view` | Hero atau band tampil | campaign, placement, audience |
| `seasonal_cta_click` | CTA kampanye diklik | campaign, placement, destination |
| `audience_page_view` | Halaman audiens dibuka | audience |
| `whatsapp_click` | Tombol WhatsApp diklik | source, campaign |
| `inquiry_submit` | Form kontak sukses | service, campaign |

Alat:

- **Rekomendasi:** Plausible atau Umami (cookieless, ringan, tanpa consent banner untuk analytics dasar).
- **Alternatif gratis:** Cloudflare Web Analytics untuk baseline, tetapi event kustom terbatas.
- **GA4:** hanya jika klien setuju dan siap memasang consent banner. Jangan pasang GA4 diam-diam.

Atribusi WhatsApp:

- WhatsApp tidak membawa UTM. Sertakan kode kampanye di pesan awal, misalnya:
  `Halo, saya ingin minta proposal study tour sekolah (ref: sekolah-2027).`
- Sales dapat melihat kode ini saat percakapan masuk.
- Jangan memakai data pribadi di analytics.

Laporan sederhana:

- Kampanye → jumlah klik CTA → jumlah inquiry → jumlah percakapan WhatsApp.
- Bandingkan kampanye sekolah vs korporat per musim.
- Jangan mengambil kesimpulan dari satu minggu data.

---

## 13. Aksesibilitas dan performa

Aksesibilitas:

- Label musiman adalah teks, bukan warna atau ikon saja.
- Eyebrow bukan heading. H2 band mengikuti hierarki setelah H1.
- Kontras: `mist` di navy, `navy` di `mist`, `navy` di oranye. Jangan memakai oranye sebagai teks di latar terang.
- Target sentuh minimal 44 px.
- Tidak ada konten yang berputar otomatis.
- `prefers-reduced-motion` tetap mematikan animasi hero.
- Jika kampanye menambahkan gambar, `alt` wajib dan deskriptif. Jangan menulis "foto musim".
- Tanggal kampanye tidak boleh menjadi satu-satunya penanda; teks label harus jelas.

Performa:

- Server-rendered, tanpa JavaScript tambahan.
- Tidak ada countdown atau carousel.
- Cache resolver 5 menit.
- Hanya satu gambar hero yang di-preload: gambar kampanye jika ada, atau gambar default. Jangan preload keduanya.
- Gambar kampanye mengikuti ukuran dan format yang sama.
- Band sorotan tidak memuat gambar, sehingga tidak menambah LCP.
- Uji Lighthouse mobile setelah kampanye pertama aktif.

---

## 14. Testing

Feature test:

1. Tidak ada kampanye aktif → beranda memakai sub-headline default dan tidak menampilkan band.
2. Kampanye aktif di dalam window → label, sub-headline, CTA, dan program unggulan tampil.
3. Kampanye `is_active = false` → tidak tampil.
4. Kampanye dengan `starts_at` di masa depan → tidak tampil.
5. Kampanye dengan `ends_at` di masa lalu → tidak tampil.
6. Dua kampanye bertumpuk → prioritas tertinggi menang.
7. Prioritas sama → `starts_at` terbaru menang.
8. `starts_at`/`ends_at` null → perilaku sesuai aturan.
9. Batas hari di `Asia/Jakarta` → kampanye berhenti tepat setelah `ends_at`.
10. Program unggulan yang sudah tidak aktif → tidak tampil.
11. `featured_service_ids` kosong → band tetap tampil dengan CTA.
12. `audience_url` tidak valid → fallback ke `/layanan`.
13. Preview tanpa login → tidak mengaktifkan kampanye.
14. Preview dengan admin → menampilkan kampanye dan `noindex`.
15. Cache di-forget saat kampanye disimpan.
16. Judul, canonical, dan JSON-LD beranda tidak berubah karena kampanye.

Unit test:

- Resolver dengan tanggal dan prioritas.
- Cast tanggal, JSON, boolean.
- Validasi path `audience_url`.

QA manual:

- 360, 375, 768, 1024, 1280, 1366 px.
- Tinggi 568, 657, 768, 812, 900 px.
- Keyboard: eyebrow → H1 → CTA → program unggulan → CTA audiens.
- Screen reader: label dan H2 terbaca logis.
- axe: 0 violation.
- Lighthouse mobile: Performance, SEO, Accessibility di atas 90.
- Tidak ada horizontal scroll.
- Band tidak menutupi konten atau membuat hero lebih dari satu layar.

---

## 15. Rollout

### Fase 2A — fondasi, tanpa konten klien

- Rename `seasonal_segments` menjadi `seasonal_campaigns` dan tambah kolom.
- Buat model, resolver, cache, dan feature flag.
- Buat komponen band sorotan dan perubahan hero.
- Seed dua kampanye nonaktif (Ramadan, Sekolah/Kampus).
- Test lengkap.
- Tidak ada perubahan visual karena semua kampanye nonaktif.

### Fase 2B — konten dan halaman audiens

- Konfirmasi kalender, label, sub-headline, CTA, program unggulan, dan gambar.
- Buat halaman audiens yang sudah punya konten cukup.
- Tambahkan ke sitemap dan internal link.
- Aktifkan kampanye pertama.
- QA dan Lighthouse.

### Fase 3 — admin

- Filament resource, preview, duplikat, validasi, peringatan konflik.
- Peran dan audit.
- Klien bisa mengganti kampanye sendiri.

---

## 16. Yang perlu dikonfirmasi klien

Pertanyaan lengkap ada di `CLIENT-QUESTIONS.md`. Ringkasnya:

1. Bulan mana yang benar-benar ramai untuk sekolah, kampus, korporat, dan instansi?
2. Label musim apa yang boleh dipakai? Contoh: "Musim Study Tour Sekolah" atau "Program Sekolah".
3. Satu kalimat sub-headline untuk tiap musim.
4. Dua atau tiga program unggulan untuk tiap musim.
5. CTA yang diinginkan. Apakah "Minta Proposal" atau "Konsultasi Gratis"?
6. Apakah ada penawaran, harga, atau kuota musiman? Jika tidak, jangan menyiratkan.
7. Apakah ada program Ramadan? Jika belum ada, jangan aktifkan.
8. Foto untuk tiap musim, termasuk hak pakai.
9. Siapa yang menyetujui copy kampanye dan berapa lama sebelumnya?
10. Halaman audiens mana yang boleh dibuat lebih dulu?

---

## 17. Larangan

- Jangan mengubah H1, logo, palet, atau font per musim.
- Jangan membuat warna musiman baru.
- Jangan memakai popup, countdown, carousel, atau animasi dekoratif.
- Jangan membuat halaman musiman tipis atau duplikat.
- Jangan menampilkan label musiman sebelum konten dikonfirmasi.
- Jangan mengarang promo, harga, kuota, atau klaim "terbatas".
- Jangan mengubah urutan katalog layanan permanen.
- Jangan menampilkan lebih dari satu kampanye sekaligus.
- Jangan menyimpan data pribadi di analytics atau log.
- Jangan mengandalkan JavaScript untuk menentukan kampanye aktif.
