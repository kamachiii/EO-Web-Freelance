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
                    <x-eyebrow>Privasi</x-eyebrow>

                    <h1 id="judul-privasi" class="mt-5 font-display text-chapter font-bold tracking-heading text-navy">
                        Kebijakan Privasi
                    </h1>

                    <p class="mt-5 max-w-prose text-lead text-charcoal">
                        Halaman ini menjelaskan data apa yang kami terima saat Anda menghubungi MR Global Events &amp; Solutions
                        dan bagaimana data itu digunakan.
                    </p>
                </div>

                <div class="lg:col-span-3 lg:col-start-10">
                    <p class="text-label font-semibold uppercase tracking-label text-charcoal">Terakhir diperbarui</p>
                    <p class="mt-2 text-body font-semibold text-navy">27 November 2026</p>
                </div>
            </div>
        </x-container>
    </section>

    <section class="bg-white py-12 lg:py-20">
        <x-container>
            <div class="grid gap-12 lg:grid-cols-12 lg:gap-10">
                <div class="lg:col-span-7">
                    <div class="space-y-8">
                        <section id="data-yang-kami-terima" aria-labelledby="judul-data-yang-kami-terima"
                                 class="border-t border-line pt-6 first:border-t-0 first:pt-0">
                            <div class="flex items-baseline gap-4">
                                <span class="text-label font-semibold tabular-nums text-charcoal/70" aria-hidden="true">01</span>
                                <h2 id="judul-data-yang-kami-terima" class="font-display text-card-lg font-bold tracking-heading text-navy">
                                    Data yang kami terima
                                </h2>
                            </div>

                            <div class="mt-4 space-y-4 text-body-lg text-charcoal">
                                <p class="max-w-prose">
                                    Saat Anda mengisi formulir kontak, kami menerima data yang Anda isi sendiri:
                                </p>
                                <ul class="max-w-prose list-disc space-y-2 pl-5">
                                    <li>nama;</li>
                                    <li>nomor WhatsApp;</li>
                                    <li>alamat email, jika Anda mengisinya;</li>
                                    <li>layanan yang diminati, jika Anda memilihnya;</li>
                                    <li>isi pesan.</li>
                                </ul>
                                <p class="max-w-prose">
                                    Jika Anda menghubungi kami langsung melalui WhatsApp atau email, kami juga menerima data yang
                                    Anda kirim melalui kanal tersebut.
                                </p>
                            </div>
                        </section>

                        <section id="penggunaan-data" aria-labelledby="judul-penggunaan-data"
                                 class="border-t border-line pt-6">
                            <div class="flex items-baseline gap-4">
                                <span class="text-label font-semibold tabular-nums text-charcoal/70" aria-hidden="true">02</span>
                                <h2 id="judul-penggunaan-data" class="font-display text-card-lg font-bold tracking-heading text-navy">
                                    Penggunaan data
                                </h2>
                            </div>

                            <p class="mt-4 max-w-prose text-body-lg text-charcoal">
                                Kami menggunakan data tersebut untuk membalas pertanyaan, menyiapkan penawaran, dan
                                menindaklanjuti komunikasi terkait acara Anda. Kami tidak mengirim promosi tanpa persetujuan
                                Anda.
                            </p>
                        </section>

                        <section id="penyimpanan-dan-akses" aria-labelledby="judul-penyimpanan-dan-akses"
                                 class="border-t border-line pt-6">
                            <div class="flex items-baseline gap-4">
                                <span class="text-label font-semibold tabular-nums text-charcoal/70" aria-hidden="true">03</span>
                                <h2 id="judul-penyimpanan-dan-akses" class="font-display text-card-lg font-bold tracking-heading text-navy">
                                    Penyimpanan dan akses
                                </h2>
                            </div>

                            <p class="mt-4 max-w-prose text-body-lg text-charcoal">
                                Data disimpan di database situs dan hanya dapat diakses oleh tim yang berwenang. Data tidak
                                ditampilkan ke publik. Kami menyimpan data selama diperlukan untuk menindaklanjuti permintaan
                                dan memenuhi kewajiban administratif.
                            </p>
                        </section>

                        <section id="pihak-ketiga" aria-labelledby="judul-pihak-ketiga"
                                 class="border-t border-line pt-6">
                            <div class="flex items-baseline gap-4">
                                <span class="text-label font-semibold tabular-nums text-charcoal/70" aria-hidden="true">04</span>
                                <h2 id="judul-pihak-ketiga" class="font-display text-card-lg font-bold tracking-heading text-navy">
                                    Pihak ketiga
                                </h2>
                            </div>

                            <p class="mt-4 max-w-prose text-body-lg text-charcoal">
                                Kami menggunakan penyedia hosting untuk menjalankan situs. Jika Anda menghubungi kami melalui
                                WhatsApp atau email, data juga tunduk pada kebijakan privasi layanan tersebut. Kami tidak
                                menjual atau menyewakan data Anda.
                            </p>
                        </section>

                        <section id="cookie-dan-analytics" aria-labelledby="judul-cookie-dan-analytics"
                                 class="border-t border-line pt-6">
                            <div class="flex items-baseline gap-4">
                                <span class="text-label font-semibold tabular-nums text-charcoal/70" aria-hidden="true">05</span>
                                <h2 id="judul-cookie-dan-analytics" class="font-display text-card-lg font-bold tracking-heading text-navy">
                                    Cookie dan analytics
                                </h2>
                            </div>

                            <p class="mt-4 max-w-prose text-body-lg text-charcoal">
                                Situs memakai cookie sesi yang diperlukan agar formulir dan keamanan situs berfungsi. Kami
                                tidak memasang cookie iklan. Jika kami menambahkan alat analytics, kami akan memperbarui
                                halaman ini dan meminta persetujuan bila diwajibkan.
                            </p>
                        </section>

                        <section id="hak-anda" aria-labelledby="judul-hak-anda"
                                 class="border-t border-line pt-6">
                            <div class="flex items-baseline gap-4">
                                <span class="text-label font-semibold tabular-nums text-charcoal/70" aria-hidden="true">06</span>
                                <h2 id="judul-hak-anda" class="font-display text-card-lg font-bold tracking-heading text-navy">
                                    Hak Anda
                                </h2>
                            </div>

                            <p class="mt-4 max-w-prose text-body-lg text-charcoal">
                                Anda dapat meminta akses, koreksi, atau penghapusan data dengan menghubungi kami melalui
                                WhatsApp atau email. Kami dapat meminta konfirmasi identitas sebelum memproses permintaan.
                            </p>
                        </section>

                        <section id="perubahan-kebijakan" aria-labelledby="judul-perubahan-kebijakan"
                                 class="border-t border-line pt-6">
                            <div class="flex items-baseline gap-4">
                                <span class="text-label font-semibold tabular-nums text-charcoal/70" aria-hidden="true">07</span>
                                <h2 id="judul-perubahan-kebijakan" class="font-display text-card-lg font-bold tracking-heading text-navy">
                                    Perubahan kebijakan
                                </h2>
                            </div>

                            <p class="mt-4 max-w-prose text-body-lg text-charcoal">
                                Kebijakan ini dapat diperbarui sewaktu-waktu. Tanggal pembaruan terakhir tercantum di bagian
                                atas halaman.
                            </p>
                        </section>
                    </div>
                </div>

                <aside class="lg:col-span-4 lg:col-start-9">
                    <div class="lg:sticky lg:top-28">
                        <nav aria-label="Isi halaman" class="hidden lg:block">
                            <p class="text-label font-semibold uppercase tracking-label text-charcoal">Isi halaman</p>

                            <ol class="mt-3 border-t border-line">
                                @foreach ($sections as $section)
                                    <li>
                                        <a href="#{{ $section['id'] }}"
                                           class="flex min-h-11 items-center gap-3 border-b border-line text-small text-charcoal transition-colors duration-150 hover:text-navy">
                                            <span class="text-label font-semibold tabular-nums text-charcoal/70" aria-hidden="true">{{ $section['number'] }}</span>
                                            {{ $section['label'] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ol>
                        </nav>

                        <div class="mt-10 border-t-2 border-navy pt-6">
                            <h2 class="font-display text-card-lg font-bold tracking-heading text-navy">Pertanyaan privasi</h2>
                            <p class="mt-3 max-w-prose text-body text-charcoal">
                                Hubungi kami jika ada pertanyaan tentang data Anda.
                            </p>

                            <dl class="mt-6 border-t border-line">
                                <div class="border-b border-line py-4">
                                    <dt class="text-label font-semibold uppercase tracking-label text-charcoal">WhatsApp</dt>
                                    <dd class="mt-2">
                                        <a href="{{ WhatsApp::link() }}" target="_blank" rel="noopener"
                                           class="inline-flex min-h-11 items-center break-all text-body font-semibold text-navy underline decoration-navy/30 underline-offset-4 transition-colors duration-150 hover:decoration-navy">
                                            {{ WhatsApp::display() }}
                                        </a>
                                    </dd>
                                </div>

                                <div class="border-b border-line py-4">
                                    <dt class="text-label font-semibold uppercase tracking-label text-charcoal">Email</dt>
                                    <dd class="mt-2">
                                        <a href="mailto:{{ config('site.email') }}"
                                           class="inline-flex min-h-11 items-center break-all text-body font-semibold text-navy underline decoration-navy/30 underline-offset-4 transition-colors duration-150 hover:decoration-navy">
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
