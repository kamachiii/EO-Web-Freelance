# DESIGN.md

Panduan visual website **MR Global Events & Solutions**. File ini adalah sumber kebenaran untuk tampilan. Baca sebelum membuat atau mengubah UI apa pun, bersama `AGENTS.md`.

Jika ada konflik: aturan kejujuran konten di `AGENTS.md` (bagian 8) menang atas desain. Jangan mengarang konten demi mengisi desain.

## 1. Arah desain

**Editorial corporate dengan energi lapangan.**

Dial: **ENERGY 2 / RHYTHM 3 / MOTION 2.** Energi cukup kuat untuk terasa percaya diri, ritme bagian asimetris dan tidak seragam, gerak secukupnya untuk memandu bacaan.

Website harus terasa seperti laporan perusahaan yang dibuat oleh orang yang benar-benar bekerja di lapangan: tipografi besar, nomor bagian, foto aksi, dan banyak ruang kosong. Bukan kumpulan kartu dan ikon bulat.

Referensi struktur: `threeenterprise.co.id` dan `fastmanagement.id`. Referensi dipakai untuk pola layout dan kerapian, bukan disalin.

Prinsip:

1. **Satu ide per layar.** Setiap bagian punya satu pesan yang jelas sebelum pengunjung menggulir.
2. **Foto adalah bukti.** Foto kegiatan menjadi elemen utama, bukan hiasan di dalam kartu.
3. **Nomor dan garis, bukan kotak.** Urutan informasi ditandai nomor besar dan garis pemisah. Kartu hanya dipakai kalau benar-benar membantu.
4. **Jujur.** Tidak ada angka, testimoni, klien, sertifikasi, atau harga karangan.
5. **Tenang tapi hidup.** Gerak dipakai untuk memandu bacaan, bukan menghibur diri sendiri.
6. **Mobile-first.** Sebagian besar pengunjung membuka dari HP.

## 2. Logo dan aset brand

Konsep: monogram MR yang menyatu, dibungkus globe, dengan lintasan oranye dan percikan kecil (momen acara).

| File | Pemakaian |
|---|---|
| `logo-icon.svg` | Mode terang: header putih, kartu terang, dokumen |
| `logo-icon-dark.svg` | Di atas navy atau latar gelap: footer, bagian navy |
| `favicon.svg` | Favicon utama (berlatar kotak biru embun, aman di tab terang dan gelap) |
| `favicon-32.png` | Cadangan favicon |
| `favicon.ico` | Fallback 32×32 untuk permintaan otomatis `/favicon.ico` dan browser lama |
| `apple-touch-icon.png` | Ikon layar utama iOS (180×180) |

Letakkan di `public/` (favicon, apple-touch-icon) dan `public/images/brand/` (dua ikon logo).

```html
<link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
<link rel="icon" href="{{ asset('favicon-32.png') }}" type="image/png" sizes="32x32">
<link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
```

Aturan:

- Wordmark: "MR Global" (Montserrat 700) di atas "Events & Solutions" (Montserrat 500, lebih kecil). Navy dan arang di atas terang; putih dan biru embun di atas navy.
- Jangan mewarnai ulang, meregangkan, memutar, atau menambah bayangan pada logo.
- Ruang bebas di sekeliling ikon minimal setengah lebar ikon. Ukuran minimum ikon di layar: 24 px.
- Ikon di header 40–44 px, di footer 40 px.
- Lockup horizontal dengan tulisan yang sudah di-outline belum ada. Sampai ada, tulis wordmark sebagai teks HTML.

## 3. Warna

Token (sumber tunggal di `tailwind.config.js`):

```js
colors: {
  navy: '#14305B',
  white: '#FFFFFF',
  mist: '#E9F0F9',
  forest: '#1E7A5C',
  signal: '#F5821F',
  charcoal: '#1F2937',
  line: '#D3DEEC',
}
```

| Token | Hex | Makna | Pemakaian |
|---|---|---|---|
| `navy` | `#14305B` | Dapat dipercaya, profesional | Hero, footer, heading, band CTA |
| `white` | `#FFFFFF` | Kejujuran, transparansi | Latar utama |
| `mist` | `#E9F0F9` | Tenang, rapi, terbuka | Latar section selang-seling, panel info |
| `forest` | `#1E7A5C` | Keselamatan, alam | Penanda keselamatan |
| `signal` | `#F5821F` | Selalu siap membantu, energi | Tombol aksi, WhatsApp, garis pendek eyebrow, titik akhir headline |
| `charcoal` | `#1F2937` | Tegas, mudah dibaca | Teks isi |
| `line` | `#D3DEEC` | Garis pemisah | Border dan rule dekoratif, bukan teks |

Aturan:

- Proporsi kira-kira: putih 45%, biru embun 20%, navy 25%, oranye 5%, hijau 5%.
- **Oranye terutama untuk aksi.** Tombol, tautan WhatsApp, garis pendek eyebrow, dan titik akhir headline. Tidak ada blok oranye dekoratif besar. Pengecualian: logo.
- **Teks di atas oranye wajib navy.** Dilarang teks putih di atas oranye (kontras sekitar 2,6:1).
- Kombinasi teks aman (target WCAG AA 4,5:1): putih di navy (sekitar 13:1), putih di hijau (sekitar 5:1), navy di oranye (sekitar 5:1), arang atau navy di putih dan biru embun. Oranye tidak dipakai sebagai teks di latar terang (kontras sekitar 2,3:1).
- Hijau tidak dipakai sebagai latar band besar. Hijau hanya muncul sebagai label atau garis tipis penanda keselamatan.
- Border input memakai `charcoal` dengan opasitas 60% agar batas kolom terbaca (minimal 3:1). `line` hanya untuk garis dekoratif.
- Tanpa gradient dekoratif. Tanpa warna di luar token.
- State memakai token yang ada: hover tombol utama `#FF9A3D`, hover baris `mist`, border input fokus navy. Tidak ada warna state baru.

## 4. Tipografi

- **Judul dan angka:** Montserrat 700 (500 untuk label kecil). **Isi dan UI:** Inter 400, 500, 600.
- Font dimuat dari paket lokal (`@fontsource/montserrat`, `@fontsource/inter`) lewat Vite. Fallback `'Segoe UI', Arial, sans-serif`.
- Huruf judul memakai sentence case. Label kecil memakai huruf kapital semua dengan tracking lebar.

| Token | Ukuran | Line-height | Pemakaian |
|---|---|---|---|
| `text-display` | `clamp(2.5rem, 5.6vw, 4.5rem)` | 0.98 | H1 hero dan headline utama |
| `text-chapter` | `clamp(1.75rem, 3vw, 2.75rem)` | 1.05 | H2 section besar, headline CTA |
| `text-quote` | `clamp(1.5rem, 2.6vw, 2.25rem)` | 1.3 | Kutipan visi, judul pilar, dan dua kategori pendukung pertama |
| `text-figure` | `clamp(3rem, 6vw, 5rem)` | 0.9 | Nomor pilar |
| `text-lead` | `clamp(1.0625rem, 1.2vw, 1.25rem)` | 1.6 | Paragraf pembuka |
| `text-label` | 0.6875rem (11 px) | 1.4 | Eyebrow, label kolom, nomor kecil |
| `text-card-lg` | 1.25rem (20 px) | 1.3 | Judul kartu, item katalog, dan kategori pendukung 03–05 |
| `text-card` | 1rem (16 px) | 1.3 | Judul kecil |
| `text-body-lg` | 1rem (16 px) | 1.6 | Isi utama |
| `text-body` | 0.9375rem (15 px) | 1.6 | Isi sekunder |
| `text-small` | 0.875rem (14 px) | 1.5 | Keterangan |
| `text-tiny` | 0.8125rem (13 px) | 1.5 | Bantuan form, caption |

Aturan:

- Panjang baris isi maksimal sekitar 68 karakter (`max-w-prose` atau lebih sempit).
- Tracking: `tracking-display` (-0.03em) untuk H1, `tracking-heading` (-0.02em) untuk H2, `tracking-label` (0.16em) untuk label kapital.
- Jangan memakai huruf kapital untuk kalimat panjang.
- Angka bagian ditulis dua digit: `01`, `02`, `03`.

## 5. Layout dan spasi

- Wadah: maksimum **1184 px**, tengah. Padding samping 20 px (mobile), 48 px (desktop).
- Grid: 12 kolom, gap 24 px (mobile), 32 px (desktop). Untuk pasangan judul–teks pendukung, pakai 6/6 dengan teks mulai di kolom 7 agar sejajar dengan isi di bawahnya. Komposisi lain yang dipakai: 2/4/6 (pilar), 6/6 (program pembuka), 7/5 (item katalog), 7/5 + 4/4/4 (kategori pendukung), 7/4 (band CTA). Hindari tiga kartu sama besar sebagai pola default.
- Jarak section: padding 48 px atas-bawah di mobile dan 80 px di desktop. Antar section yang berurutan, jarak isi menjadi 96–160 px.
- Band penuh: section dengan latar navy atau mist yang menyentuh tepi viewport, tanpa kartu di dalamnya.
- Jarak dasar kelipatan 4 px.
- Radius: tombol 10 px, panel 14 px, panel besar 20 px. Foto utama 0–4 px (editorial), bukan 18 px.
- Di lebar 1024–1279 px, grid 12 kolom harus tetap utuh. Jangan membuat komponen yang hanya muat di 1280 px.

## 6. Pola komponen

### Header halaman (cover)

- Halaman bagian (Tentang, Layanan, Layanan Pendukung, Kontak) memakai cover penuh satu layar di bawah header sticky: tinggi `100svh` dikurangi 77 px (mobile) atau 85 px (dari 640 px).
- Isi 6/6: eyebrow dan H1 di kiri, paragraf pembuka di kanan, kedua kolom disejajarkan tengah satu sama lain secara vertikal. H1 memakai `text-display`.
- Baris bawah berupa band navy selebar viewport: label halaman di kiri (angka dua digit bila ada, misalnya `07 Program`) dan tautan lompat ke section pertama di kanan. Label memakai `mist`, angka dan tautan memakai `white`; fokus putih lewat `.focus-light`.
- Cover tidak memakai foto. Foto tetap dipakai di dalam section, bukan sebagai latar cover.
- Section berikutnya selalu mulai tepat di bawah fold. Jangan mengosongkan layar tanpa penanda halaman dan tautan lompat.
- Jangkar memakai `scroll-padding-top: 7.5rem` global. Nilai ini memberi jarak aman di bawah header yang menyusut 12 px saat digulir, termasuk saat target masih memakai transform reveal. Jangan menambah `scroll-mt` pada target karena jaraknya akan menumpuk.
- Halaman detail layanan tetap memakai hero dua kolom yang ringkas; cover penuh hanya untuk halaman bagian.

### Header

- Sticky di atas, latar putih, border bawah `line`.
- Kiri: ikon 40 px + wordmark. Tengah: menu. Kanan: tombol oranye "Konsultasi Gratis".
- Saat halaman digulir: padding menyusut dan muncul bayangan tipis. Transisi 200–300 ms.
- Menu aktif memakai `aria-current="page"`, warna navy, dan garis bawah. Halaman detail layanan tetap menandai menu "Layanan" aktif.
- Mobile: tombol hamburger 44×44 px, menu turun dengan transisi opacity + translate. Tutup saat tautan diklik, Escape, atau klik di luar.

### Eyebrow

Label kecil huruf kapital dengan garis pendek di kiri.

```html
<div class="flex items-center gap-3">
  <span class="h-px w-8 bg-signal" aria-hidden="true"></span>
  <p class="text-label font-semibold uppercase tracking-label text-charcoal">Tentang</p>
</div>
```

Di atas navy, teks memakai `mist`. Garis boleh `signal` karena menandai bagian, bukan hiasan bebas.

### Tombol

- **Primer:** latar `signal`, teks `navy`, Inter 600, padding 14×22 px, radius 10 px, hover `#FF9A3D`.
- **Sekunder di navy:** garis putih 2 px, teks putih.
- **Garis di terang:** garis navy 2 px, teks navy.
- Ikon panah hanya kalau arahnya jelas. Jangan menaruh panah di semua tautan.
- Target sentuh minimal 44 px.

### Katalog layanan

Layanan tidak ditampilkan sebagai kartu seragam. Gunakan katalog bernomor:

- Program pertama menjadi pembuka selebar 12 kolom. Mulai 768 px, teks 6 kolom dan foto 16:10 6 kolom; di bawah 768 px keduanya bertumpuk. Isi: label nomor + "Program", judul `text-chapter`, deskripsi `text-lead`, dan aksi "Lihat detail".
- Program berikutnya satu kolom penuh pada 768–1023 px dengan teks 9 kolom dan thumbnail 4:3 3 kolom. Mulai 1024 px disusun grid dua kolom dengan teks 7 kolom dan thumbnail 5 kolom. Tiap item: nomor kecil + judul `text-card-lg`, ringkasan `text-small`, dan aksi "Lihat detail".
- Judul dengan garis miring dipecah di `/`: bagian sebelum garis miring memakai spasi tak-terpisah, bagian sesudahnya `whitespace-nowrap`, agar baris baru tidak dimulai dengan `/` dan tidak menyisakan satu kata.
- Garis atas navy 2 px dan garis bawah `line`. Hover/focus: latar `mist`, judul bergeser 2 px, foto membesar 3%, aksi "Lihat detail" bergaris bawah. Jangan mengubah teks aksi menjadi oranye di latar terang karena kontrasnya tidak lolos AA.
- Seluruh item dapat diklik lewat satu tautan dengan `aria-label="Lihat detail {nama layanan}"`.
- Di bawah 768 px: satu kolom. Thumbnail item lanjutan disembunyikan; foto pembuka tetap tampil agar halaman tetap ringan.
- Halaman Layanan memakai deskripsi lengkap; beranda memakai ringkasan.

### Pilar bernomor

"Mengapa Memilih Kami" memakai tiga pilar bernomor `01`–`03`:

- Nomor besar `text-figure` warna `navy/55` (kontras teks besar minimal 3:1), dekoratif (`aria-hidden`).
- Judul Montserrat 700 ukuran `text-quote`, teks isi 16 px.
- Header section memakai 6/6: judul di kolom 1–6, kalimat pengantar di kolom 7–12 dan sejajar dengan kolom teks pilar.
- Satu pilar satu baris 12 kolom: nomor (2), judul (4), teks (6).
- Dipisahkan garis atas navy 2 px. Tanpa kartu, tanpa ikon bulat, tanpa grid kecil yang mengulang isi pilar.

### Strip layanan pendukung

- Terletak di bawah index layanan, dipisahkan garis atas `line`.
- Grid 6/6: label dan tautan "Lihat layanan pendukung" di kiri; ringkasan di kanan mulai kolom 7.
- Jangan menaruh label kecil sendirian di kiri dengan paragraf jauh di kanan; kedua sisi harus punya bobot visual yang seimbang.

### Strip audiens

- Band putih dengan border atas-bawah, teks label kapital "Kami melayani".
- Daftar segmen berjalan dalam satu baris, berhenti saat kursor di atasnya. Tanpa tombol jeda. Tepi kiri-kanan memudar agar potongan teks tidak terlihat patah.
- Setiap segmen dipisahkan titik navy kecil; tanpa pil atau kartu.
- Saat `prefers-reduced-motion: reduce`, animasi berhenti dan daftar membungkus sebagai teks statis.

### Band CTA

- Latar navy penuh, bukan kartu di tengah halaman.
- Kiri: eyebrow, headline `text-chapter`, satu paragraf, tombol oranye "Konsultasi Gratis Sekarang" dan tombol formulir bergaris putih.
- Kanan: WhatsApp, email, dan basecamp sebagai teks besar, dipisah garis putih transparan.
- Di halaman dalam, band CTA boleh berupa panel navy selebar wadah. Tombol sejajar tengah secara vertikal dengan blok teks, bukan menempel di bawah.

### Form inquiry

- Label di atas kolom, teks kecil semibold navy.
- Kolom putih, border 1 px `charcoal/60`, radius 0–10 px. Fokus memakai ring global.
- Error: border navy 2 px + teks error di bawah kolom. Jangan hanya warna.
- Ringkasan error di atas form, dapat difokuskan.
- Setelah sukses: form diganti panel konfirmasi. Jangan biarkan form kosong terbuka.
- Urutan mobile: form lebih dulu, info kontak setelahnya.
- Layanan yang dipilih dari halaman detail otomatis terpilih lewat query string.

### Footer

- Navy, dipisahkan garis atas terang dari band CTA di atasnya.
- Baris identitas: logo terang, wordmark, dan ringkasan brand. Di 1024 px ke atas, logo/wordmark menempati enam kolom kiri dan ringkasan mulai di kolom 7; keduanya sejajar secara vertikal. Di bawah itu keduanya bertumpuk.
- Tiga blok di grid: halaman, kontak, dan area layanan. Di 1024 px ke atas ketiganya sama lebar; pada 640–1023 px halaman dan kontak menjadi dua kolom dan area layanan selebar penuh; di mobile bertumpuk dengan urutan yang sama.
- Ketiga blok memakai garis rambut selebar kolom dan ritme baris yang konsisten. Blok halaman berupa baris tautan; kontak memakai label-nilai sejajar pada 640 px ke atas; area layanan memakai label di atas nilai pada 1024 px ke atas agar nilai panjang tidak terpotong.
- Area layanan ditampilkan bertingkat: basis operasional, jangkauan rutin, skala nasional. Jangan menulis daftar datar yang saling tumpang tindih.
- Baris bawah: copyright dan satu kalimat target audiens. Baris bawah baru menjadi satu baris di 1024 px ke atas; di bawah itu keduanya bertumpuk.
- Kredit foto stok tidak ditampilkan ke pengunjung; catat di `docs/IMAGE-CREDITS.md` dan komentar HTML.

### Tombol WhatsApp mengambang

Lingkaran oranye 56 px, ikon navy, kanan bawah, `aria-label="Chat WhatsApp"`. Tampil di semua halaman, tetapi baru muncul setelah halaman digulir 400 px supaya tidak menutupi tombol aksi di mobile. Di layar `lg` ke atas tombol disembunyikan karena header sticky sudah punya CTA "Konsultasi Gratis". Tombol juga disembunyikan saat band CTA atau footer terlihat karena keduanya sudah punya tombol/kontak sendiri.

### Tombol kembali ke atas

- Lingkaran putih 48 px, ikon panah navy, bayangan halus, tetap di kanan bawah.
- Muncul setelah halaman digulir 400 px. Tanpa JavaScript, tombol tetap terlihat.
- Di bawah 1024 px tombol berada 20 px di atas tombol WhatsApp; di 1024 px ke atas tombol WhatsApp disembunyikan sehingga tombol turun ke sudut kanan bawah.
- Tombol memakai tautan jangkar ke `#top`; gulir halus mengikuti `prefers-reduced-motion`.

## 7. Foto dan media

- **Semua foto saat ini adalah stok sementara untuk menggantikan foto klien.** Sumber dan lisensi dicatat di `docs/IMAGE-CREDITS.md`.
- Alt text wajib dimulai dengan "Ilustrasi ..." dan menjelaskan isi foto. Jangan menulis seolah foto itu milik MR Global.
- Kredit foto stok **tidak ditampilkan** di halaman. Catat di `docs/IMAGE-CREDITS.md` dan komentar HTML di dekat foto.
- Foto klien menggantikan stok tanpa mengubah tata letak. Setelah diganti, hapus komentar stok dan baris terkait di dokumen kredit.
- Semua `<img>` punya `alt`, `width`, `height`. Selain hero, `loading="lazy"` dan `decoding="async"`.
- Format WebP. Target di bawah 200 KB per gambar; hero di bawah 180 KB per potongan.
- Rasio: hero 6:5 desktop dan 7:4 mobile; foto layanan 16:10; teaser 4:3.
- Hero memakai `<picture>` dua potongan, `fetchpriority="high"`, `loading="eager"`.
- Tanpa overlay teks di atas foto. Tanpa caption stok yang terlihat pengunjung.
- Jangan memakai foto dari situs referensi atau situs lokasi tanpa izin.
- OG image: `public/images/og/og-default.jpg`, 1200×630, dibuat dari brand sendiri (bukan foto stok).

## 8. Gerak

Empat peran, tidak lebih:

1. **Urutan hero** (`hero-rise`): eyebrow, judul, paragraf, tombol masuk berurutan 60–90 ms. Foto masuk dengan `media-in` (opacity saja, tanpa scale).
2. **Reveal section** (`data-reveal`): elemen muncul 14 px dari bawah saat 10% masuk viewport, sekali saja. Hanya aktif jika JavaScript tersedia dan pengguna tidak meminta reduced motion.
3. **Micro-interaction:** hover baris layanan (judul bergeser, foto membesar, aksi bergaris bawah), transisi header, dan transisi menu mobile.
4. **Strip audiens berjalan:** dua salinan daftar yang sama digeser perlahan dalam loop. Berhenti saat hover. Saat reduced motion, menjadi daftar statis yang membungkus.

Aturan:

- Durasi 200–600 ms. Easing `cubic-bezier(0.22, 1, 0.36, 1)` (`ease-editorial`).
- Jangan memberi animasi pada setiap elemen. Satu section cukup satu reveal.
- `prefers-reduced-motion: reduce` mematikan animasi, transisi, dan smooth scroll.
- Tanpa parallax, tanpa animasi loop dekoratif lain, tanpa cursor custom. Hanya strip audiens yang boleh berjalan terus-menerus.
- State scroll header, tombol WhatsApp, dan tombol kembali ke atas memakai satu listener pasif + `requestAnimationFrame`, bukan listener Alpine per event.

## 9. Aksesibilitas

- Kontras teks minimal 4,5:1 (3:1 untuk teks 24 px ke atas).
- Fokus keyboard: ring 3 px navy dengan offset 2 px; putih di atas navy lewat `.focus-light`.
- Gunakan elemen asli: `<button>`, `<a href>`, `<input>` dengan `<label>`.
- Tombol berikon saja diberi `aria-label`. Ikon dekoratif `aria-hidden="true"`.
- Heading berurutan, satu `h1` per halaman.
- Target sentuh minimal 44×44 px.
- Warna bukan satu-satunya penanda (error tetap teks).
- `main` memiliki `id="konten"` dan `tabindex="-1"` agar skip link bekerja.
- Strip audiens berhenti saat hover dan menjadi daftar statis saat reduced motion; tanpa tombol jeda. Menu mobile bisa ditutup dengan Escape.
- Teks tetap terbaca tanpa JavaScript: konten reveal hanya disembunyikan jika `<html class="js">`.

## 10. Halaman

### Beranda

1. Hero navy: H1, sub-headline, dua CTA, foto, area layanan.
2. Strip audiens berjalan.
3. Tentang singkat: heading dan paragraf pembuka di kiri, konteks dan fakta (audiens + area layanan) di kanan.
4. Mengapa Memilih Kami: tiga pilar bernomor `01`–`03`, tanpa pilar tambahan.
5. Layanan kami: katalog bernomor + tautan layanan pendukung.
6. Band CTA navy penuh: tombol WhatsApp dan formulir, plus WhatsApp, email, basecamp. Footer langsung menyusul tanpa section kontak terpisah.

### Layanan

- Cover halaman: H1 "Layanan", paragraf pembuka, band navy berisi jumlah program dan tautan "Lihat program" ke index. Section "Layanan utama" tidak ikut terlihat saat halaman dibuka.
- "Layanan utama": katalog dengan program pertama sebagai pembuka dan grid dua kolom untuk program berikutnya, memakai deskripsi lengkap.
- "Lengkapi acara Anda": ringkasan layanan pendukung + tautan.
- Panel CTA.

### Detail layanan

- Breadcrumb: Beranda / Layanan / nama layanan.
- Hero dua kolom: judul, deskripsi, CTA "Minta Penawaran" + "Isi Formulir Kontak" (dengan preselection), foto layanan.
- Panel "Konsultasi gratis" berisi WhatsApp, email, area layanan.
- "Layanan lainnya": teaser berfoto, bukan kartu teks.
- Panel CTA.

### Layanan pendukung

- Cover halaman: H1 "Layanan Pendukung", paragraf pembuka, dan band navy "05 Kategori" + "Lihat kategori". Tanpa foto di cover.
- Section "Kategori layanan pendukung": di 1024 px ke atas judul `text-chapter` 7 kolom dan paragraf pembuka 5 kolom; di bawahnya bertumpuk. Katalog dipisahkan garis atas navy 2 px.
- Katalog asimetris, bukan kartu seragam. Di 1024 px ke atas: kategori pertama 7 kolom dengan judul `text-quote` dan item dalam 3 kolom; kategori kedua 5 kolom dengan judul `text-quote` dan item bertumpuk; kategori ketiga sampai kelima masing-masing 4 kolom dengan judul `text-card-lg` dan item bertumpuk. Di 768–1023 px kategori pertama selebar 12 kolom, sisanya 6/6. Di bawah 768 px semua bertumpuk.
- Tiap kategori dibuka baris metadata: nomor dua digit, garis oranye 24 px, label "Kategori", dan jumlah item di kanan. Tanpa ikon bulat. Kategori pertama memberi garis tipis di atas tiap item; kategori lain memakai jarak antaritem.
- Panel CTA.

### Tentang

- Cover halaman: H1 "Siapa Kami?", paragraf pembuka pertama, dan band navy "Visi & Misi" + "Lihat visi & misi". Paragraf pembuka kedua menjadi isi section Visi.
- Visi sebagai kutipan besar dengan garis navy.
- Misi bernomor `01`–`03`, dua kolom di desktop.
- Panel CTA.

### Kontak

- Cover halaman: H1 "Kontak", paragraf pembuka, baris WhatsApp dan email dengan gaya yang sama (label, nilai, panah, garis bawah), serta band navy "Kontak langsung" + "Kirim pesan" ke formulir. Di bawah baris email ada catatan singkat untuk penawaran (disembunyikan di bawah 360 px). Pada lebar ≤1023 px dan tinggi ≤656 px, baris email disembunyikan agar cover tetap satu layar; email tetap ada di daftar info. Pada tinggi ≤480 px, seluruh aside disembunyikan. Di desktop dengan tinggi ≤608 px, padding vertikal cover dirapatkan.
- Mobile: form dulu, info kontak setelahnya. Desktop: info kiri, form kanan.
- Info kontak berupa daftar berlabel, tanpa lingkaran ikon.
- Form dengan ringkasan error, preselection layanan, dan panel sukses.
- Tanpa peta sampai alamat lengkap dikonfirmasi.

### 404 dan 429

- Eyebrow kode kesalahan, H1 jelas, satu paragraf, lalu tautan pemulihan: Beranda, Layanan, Kontak/WhatsApp.

## 11. Larangan

- Jangan menambah warna atau font di luar token.
- Jangan memakai gradient dekoratif, glassmorphism, atau bayangan berlapis.
- Jangan memakai grid kartu seragam sebagai pola utama.
- Jangan memakai ikon bulat sebagai hiasan judul.
- Jangan menaruh teks di atas foto tanpa panel solid.
- Jangan mengarang klien, angka, testimoni, sertifikasi, atau harga.
- Jangan menampilkan nama badan hukum sebelum dikonfirmasi klien.
- Jangan memakai foto stok tanpa mencatat sumber dan lisensi.

## 12. Menunggu dari klien

Logo final (lockup), foto hero dan foto kegiatan asli, portofolio dan testimoni, alamat lengkap, Instagram dan sosmed lain, nama domain, paket dan harga, detail durasi/kapasitas tiap layanan, serta konfirmasi warna dan badan hukum.
