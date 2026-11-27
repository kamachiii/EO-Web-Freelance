@use('App\Support\WhatsApp')

@php
    $sections = [
        ['id' => 'data-yang-kami-terima', 'number' => '01', 'label' => 'Data yang kami terima'],
        ['id' => 'penggunaan-data', 'number' => '02', 'label' => 'Penggunaan data'],
        ['id' => 'penyimpanan-dan-akses', 'number' => '03', 'label' => 'Penyimpanan dan akses'],
        ['id' => 'pihak-ketiga', 'number' => '04', 'label' => 'Pihak ketiga'],
        ['id' => 'cookie-dan-analytics', 'number' => '05', 'label' => 'Cookie dan analytics'],
        ['id' => 'hak-anda', 'number' => '06', 'label' => 'Hak Anda'],
        ['id' => 'perubahan-kebijakan', 'number' => '07', 'label' => 'Perubahan kebijakan'],
    ];
@endphp

<x-layout :title="$seo['title']" :description="$seo['description']">
    <section class="border-b border-line bg-mist" aria-labelledby="judul-privasi">
        <x-container class="py-12 lg:py-16">
            <div class="grid gap-8 lg:grid-cols-12 lg:items-end lg:gap-10">
                <div class="lg:col-span-8">
                    <x-eyebrow class="animate-hero-rise">Privasi</x-eyebrow>

                    <h1 id="judul-privasi" class="mt-5 animate-hero-rise font-display text-chapter font-bold tracking-heading text-navy" style="animation-delay: 80ms">
                        Kebijakan Privasi
                    </h1>

                    <p class="mt-5 max-w-prose animate-hero-rise text-lead text-charcoal" style="animation-delay: 160ms">
                        Halaman ini menjelaskan data apa yang kami terima saat Anda menghubungi MR Global Events &amp; Solutions
                        dan bagaimana data itu digunakan.
                    </p>
                </div>

                <div class="animate-hero-rise lg:col-span-3 lg:col-start-10" style="animation-delay: 240ms">
                    <p class="text-label font-semibold uppercase tracking-label text-charcoal">Terakhir diperbarui</p>
                    <p class="mt-2 font-display text-card-lg font-bold tracking-heading text-navy">27 November 2026</p>
                </div>
            </div>
        </x-container>
    </section>

    <section class="bg-white py-12 lg:py-20">
        <x-container>
            <div class="grid gap-12 lg:grid-cols-12 lg:gap-10">
                <div class="lg:col-span-7">
                    <div class="relative">
                        <div class="absolute bottom-5 left-5 top-5 hidden w-px bg-line sm:block" aria-hidden="true"></div>

                        <div class="space-y-10">
                            <x-policy-section id="data-yang-kami-terima" number="01" title="Data yang kami terima">
                                <p>Saat Anda mengisi formulir kontak, kami menerima data yang Anda isi sendiri.</p>

                                <ul class="mt-5 grid gap-px overflow-hidden rounded-[6px] border border-line bg-line sm:grid-cols-2">
                                    <li class="flex items-center gap-3 bg-mist px-5 py-4 text-body">
                                        <span class="h-1.5 w-1.5 shrink-0 rounded-full bg-navy" aria-hidden="true"></span>
                                        Nama
                                    </li>
                                    <li class="flex items-center gap-3 bg-mist px-5 py-4 text-body">
                                        <span class="h-1.5 w-1.5 shrink-0 rounded-full bg-navy" aria-hidden="true"></span>
                                        Nomor WhatsApp
                                    </li>
                                    <li class="flex items-center gap-3 bg-mist px-5 py-4 text-body">
                                        <span class="h-1.5 w-1.5 shrink-0 rounded-full bg-navy" aria-hidden="true"></span>
                                        Email (opsional)
                                    </li>
                                    <li class="flex items-center gap-3 bg-mist px-5 py-4 text-body">
                                        <span class="h-1.5 w-1.5 shrink-0 rounded-full bg-navy" aria-hidden="true"></span>
                                        Layanan (opsional)
                                    </li>
                                    <li class="flex items-center gap-3 bg-mist px-5 py-4 text-body sm:col-span-2">
                                        <span class="h-1.5 w-1.5 shrink-0 rounded-full bg-navy" aria-hidden="true"></span>
                                        Pesan
                                    </li>
                                </ul>

                                <p class="mt-4">
                                    Jika Anda menghubungi kami langsung melalui WhatsApp atau email, kami juga menerima data yang
                                    Anda kirim melalui kanal tersebut.
                                </p>
                            </x-policy-section>

                            <x-policy-section id="penggunaan-data" number="02" title="Penggunaan data">
                                <p>
                                    Kami menggunakan data tersebut untuk membalas pertanyaan, menyiapkan penawaran, dan
                                    menindaklanjuti komunikasi terkait acara Anda. Kami tidak mengirim promosi tanpa persetujuan
                                    Anda.
                                </p>
                            </x-policy-section>

                            <x-policy-section id="penyimpanan-dan-akses" number="03" title="Penyimpanan dan akses">
                                <p>
                                    Data disimpan di database situs dan hanya dapat diakses oleh tim yang berwenang. Data tidak
                                    ditampilkan ke publik. Kami menyimpan data selama diperlukan untuk menindaklanjuti permintaan
                                    dan memenuhi kewajiban administratif.
                                </p>
                            </x-policy-section>

                            <x-policy-section id="pihak-ketiga" number="04" title="Pihak ketiga">
                                <p>
                                    Kami menggunakan penyedia hosting untuk menjalankan situs. Jika Anda menghubungi kami melalui
                                    WhatsApp atau email, data juga tunduk pada kebijakan privasi layanan tersebut.
                                </p>
                            </x-policy-section>

                            <aside class="max-w-prose border-l-2 border-navy bg-mist px-6 py-6 sm:ml-16" aria-label="Komitmen kami" data-reveal>
                                <p class="text-label font-semibold uppercase tracking-label text-charcoal/70">Komitmen kami</p>
                                <p class="mt-2 font-display text-card-lg font-bold tracking-heading text-navy">
                                    Kami tidak menjual atau menyewakan data Anda.
                                </p>
                            </aside>

                            <x-policy-section id="cookie-dan-analytics" number="05" title="Cookie dan analytics">
                                <p>
                                    Situs memakai cookie sesi yang diperlukan agar formulir dan keamanan situs berfungsi. Kami
                                    tidak memasang cookie iklan. Jika kami menambahkan alat analytics, kami akan memperbarui
                                    halaman ini dan meminta persetujuan bila diwajibkan.
                                </p>
                            </x-policy-section>

                            <x-policy-section id="hak-anda" number="06" title="Hak Anda">
                                <p>
                                    Anda dapat meminta akses, koreksi, atau penghapusan data dengan menghubungi kami melalui
                                    WhatsApp atau email. Kami dapat meminta konfirmasi identitas sebelum memproses permintaan.
                                </p>
                            </x-policy-section>

                            <x-policy-section id="perubahan-kebijakan" number="07" title="Perubahan kebijakan">
                                <p>
                                    Kebijakan ini dapat diperbarui sewaktu-waktu. Tanggal pembaruan terakhir tercantum di bagian
                                    atas halaman.
                                </p>
                            </x-policy-section>
                        </div>
                    </div>
                </div>

                <aside class="lg:col-span-4 lg:col-start-9" data-reveal style="--reveal-delay: 100ms">
                    <div class="lg:sticky lg:top-28">
                        <nav aria-label="Isi halaman" class="hidden lg:block">
                            <p class="text-label font-semibold uppercase tracking-label text-charcoal">Isi halaman</p>

                            <ol class="mt-3 border-t border-line">
                                @foreach ($sections as $section)
                                    <li>
                                        <a href="#{{ $section['id'] }}"
                                           class="group flex min-h-11 items-center gap-3 border-b border-line text-small text-charcoal transition-colors duration-150 hover:text-navy">
                                            <span class="w-6 text-label font-semibold tabular-nums text-charcoal/70 transition-colors duration-150 group-hover:text-navy" aria-hidden="true">{{ $section['number'] }}</span>
                                            <span class="flex-1">{{ $section['label'] }}</span>
                                            <span class="h-px w-4 bg-line transition-all duration-150 group-hover:w-6 group-hover:bg-navy" aria-hidden="true"></span>
                                        </a>
                                    </li>
                                @endforeach
                            </ol>
                        </nav>

                        <div class="bg-navy p-6 text-white focus-light lg:mt-10">
                            <p class="text-label font-semibold uppercase tracking-label text-mist">Pertanyaan privasi</p>
                            <h2 class="mt-2 font-display text-card-lg font-bold tracking-heading text-white">Hubungi kami</h2>
                            <p class="mt-3 text-small text-mist">
                                Kalau ada pertanyaan tentang data Anda, kami siap membantu.
                            </p>

                            <dl class="mt-6 border-t border-white/20">
                                <div class="border-b border-white/20 py-4">
                                    <dt class="text-label font-semibold uppercase tracking-label text-mist">WhatsApp</dt>
                                    <dd class="mt-1">
                                        <a href="{{ WhatsApp::link() }}" target="_blank" rel="noopener"
                                           class="inline-flex min-h-11 items-center break-all text-body font-semibold text-white underline decoration-white/30 underline-offset-4 transition-colors duration-150 hover:decoration-white">
                                            {{ WhatsApp::display() }}
                                        </a>
                                    </dd>
                                </div>

                                <div class="border-b border-white/20 py-4">
                                    <dt class="text-label font-semibold uppercase tracking-label text-mist">Email</dt>
                                    <dd class="mt-1">
                                        <a href="mailto:{{ config('site.email') }}"
                                           class="inline-flex min-h-11 items-center break-all text-body font-semibold text-white underline decoration-white/30 underline-offset-4 transition-colors duration-150 hover:decoration-white">
                                            {{ config('site.email') }}
                                        </a>
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </aside>
            </div>
        </x-container>
    </section>
</x-layout>
