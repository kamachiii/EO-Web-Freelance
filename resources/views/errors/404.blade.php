@use('App\Support\WhatsApp')

<x-layout :title="'Halaman tidak ditemukan | '.config('site.name')"
          description="Halaman yang Anda cari tidak tersedia. Kembali ke beranda atau lihat layanan MR Global Events & Solutions.">
    <section class="bg-white" aria-labelledby="judul-404">
        <x-container class="py-16 lg:py-28">
            <div class="max-w-3xl" data-reveal>
                <x-eyebrow>404</x-eyebrow>
                <h1 id="judul-404" class="mt-5 font-display text-display font-bold tracking-display text-navy">
                    Halaman tidak ditemukan
                </h1>
                <p class="mt-5 max-w-prose text-lead text-charcoal">
                    Alamat yang Anda buka tidak tersedia atau sudah dipindahkan. Mulai lagi dari halaman utama, atau langsung pilih program yang Anda butuhkan.
                </p>

                <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:gap-4">
                    <x-button href="{{ route('home') }}">Kembali ke Beranda</x-button>
                    <x-button href="{{ route('services.index') }}" variant="outline">Lihat Layanan</x-button>
                </div>

                <div class="mt-10 border-t border-line pt-6">
                    <p class="text-label font-semibold uppercase tracking-label text-charcoal">Atau langsung</p>
                    <ul class="mt-3 flex flex-wrap gap-x-6 gap-y-2 text-body">
                        <li>
                            <a href="{{ route('contact') }}" class="inline-flex min-h-11 items-center font-semibold text-navy underline decoration-navy/30 underline-offset-4 hover:decoration-navy">
                                Halaman kontak
                            </a>
                        </li>
                        <li>
                            <a href="{{ WhatsApp::link() }}" target="_blank" rel="noopener" class="inline-flex min-h-11 items-center font-semibold text-navy underline decoration-navy/30 underline-offset-4 hover:decoration-navy">
                                Chat WhatsApp
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </x-container>
    </section>
</x-layout>
