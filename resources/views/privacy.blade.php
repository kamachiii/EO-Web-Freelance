@use('App\Support\WhatsApp')

<x-layout :title="$seo['title']" :description="$seo['description']">
    <section class="bg-white pb-16 pt-10 lg:pb-24 lg:pt-14" aria-labelledby="judul-privasi">
        <x-container>
            <div class="max-w-3xl">
                <x-eyebrow>Privasi</x-eyebrow>

                <h1 id="judul-privasi" class="mt-5 font-display text-display font-bold tracking-display text-navy">
                    Kebijakan Privasi
                </h1>

                <p class="mt-6 max-w-prose text-lead text-charcoal">
                    Halaman ini menjelaskan data apa yang kami terima saat Anda menghubungi MR Global Events &amp; Solutions
                    dan bagaimana data itu digunakan.
                </p>

                <p class="mt-4 text-small text-charcoal">Terakhir diperbarui: 27 November 2026</p>
            </div>

            <div class="mt-12 grid gap-12 lg:grid-cols-12 lg:gap-10">
                <div class="space-y-10 lg:col-span-7">
                    <section aria-labelledby="data-yang-kami-terima">
                        <h2 id="data-yang-kami-terima" class="font-display text-quote font-bold tracking-heading text-navy">
                            Data yang kami terima
                        </h2>
                        <p class="mt-4 max-w-prose text-body-lg text-charcoal">
                            Saat Anda mengisi formulir kontak, kami menerima data yang Anda isi sendiri:
                        </p>
                        <ul class="mt-4 max-w-prose list-disc space-y-2 pl-5 text-body-lg text-charcoal">
                            <li>nama;</li>
                            <li>nomor WhatsApp;</li>
                            <li>alamat email, jika Anda mengisinya;</li>
                            <li>layanan yang diminati, jika Anda memilihnya;</li>
                            <li>isi pesan.</li>
                        </ul>
                        <p class="mt-4 max-w-prose text-body-lg text-charcoal">
                            Jika Anda menghubungi kami langsung melalui WhatsApp atau email, kami juga menerima data yang
                            Anda kirim melalui kanal tersebut.
                        </p>
                    </section>

                    <section aria-labelledby="penggunaan-data">
                        <h2 id="penggunaan-data" class="font-display text-quote font-bold tracking-heading text-navy">
                            Penggunaan data
                        </h2>
                        <p class="mt-4 max-w-prose text-body-lg text-charcoal">
                            Kami menggunakan data tersebut untuk membalas pertanyaan, menyiapkan penawaran, dan
                            menindaklanjuti komunikasi terkait acara Anda. Kami tidak mengirim promosi tanpa persetujuan
                            Anda.
                        </p>
                    </section>

                    <section aria-labelledby="penyimpanan-dan-akses">
                        <h2 id="penyimpanan-dan-akses" class="font-display text-quote font-bold tracking-heading text-navy">
                            Penyimpanan dan akses
                        </h2>
                        <p class="mt-4 max-w-prose text-body-lg text-charcoal">
                            Data disimpan di database situs dan hanya dapat diakses oleh tim yang berwenang. Data tidak
                            ditampilkan ke publik. Kami menyimpan data selama diperlukan untuk menindaklanjuti permintaan
                            dan memenuhi kewajiban administratif.
                        </p>
                    </section>

                    <section aria-labelledby="pihak-ketiga">
                        <h2 id="pihak-ketiga" class="font-display text-quote font-bold tracking-heading text-navy">
                            Pihak ketiga
                        </h2>
                        <p class="mt-4 max-w-prose text-body-lg text-charcoal">
                            Kami menggunakan penyedia hosting untuk menjalankan situs. Jika Anda menghubungi kami melalui
                            WhatsApp atau email, data juga tunduk pada kebijakan privasi layanan tersebut. Kami tidak
                            menjual atau menyewakan data Anda.
                        </p>
                    </section>

                    <section aria-labelledby="cookie-dan-analytics">
                        <h2 id="cookie-dan-analytics" class="font-display text-quote font-bold tracking-heading text-navy">
                            Cookie dan analytics
                        </h2>
                        <p class="mt-4 max-w-prose text-body-lg text-charcoal">
                            Situs memakai cookie sesi yang diperlukan agar formulir dan keamanan situs berfungsi. Kami
                            tidak memasang cookie iklan. Jika kami menambahkan alat analytics, kami akan memperbarui
                            halaman ini dan meminta persetujuan bila diwajibkan.
                        </p>
                    </section>

                    <section aria-labelledby="hak-anda">
                        <h2 id="hak-anda" class="font-display text-quote font-bold tracking-heading text-navy">
                            Hak Anda
                        </h2>
                        <p class="mt-4 max-w-prose text-body-lg text-charcoal">
                            Anda dapat meminta akses, koreksi, atau penghapusan data dengan menghubungi kami melalui
                            WhatsApp atau email. Kami dapat meminta konfirmasi identitas sebelum memproses permintaan.
                        </p>
                    </section>

                    <section aria-labelledby="perubahan-kebijakan">
                        <h2 id="perubahan-kebijakan" class="font-display text-quote font-bold tracking-heading text-navy">
                            Perubahan kebijakan
                        </h2>
                        <p class="mt-4 max-w-prose text-body-lg text-charcoal">
                            Kebijakan ini dapat diperbarui sewaktu-waktu. Tanggal pembaruan terakhir tercantum di bagian
                            atas halaman.
                        </p>
                    </section>
                </div>

                <aside class="lg:col-span-4 lg:col-start-9">
                    <div class="border-t-2 border-navy pt-6">
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
                </aside>
            </div>
        </x-container>
    </section>
</x-layout>
