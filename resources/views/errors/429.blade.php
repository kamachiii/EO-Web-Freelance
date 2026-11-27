<x-layout :title="'Terlalu banyak percobaan | '.config('site.name')"
          description="Batas pengiriman pesan tercapai. Tunggu beberapa menit lalu coba lagi melalui halaman kontak MR Global Events & Solutions.">
    <section class="bg-white" aria-labelledby="judul-429">
        <x-container class="py-16 lg:py-28">
            <div class="max-w-3xl" data-reveal>
                <x-eyebrow>429</x-eyebrow>
                <h1 id="judul-429" class="mt-5 font-display text-display font-bold tracking-display text-navy">
                    Terlalu banyak percobaan
                </h1>
                <p class="mt-5 max-w-prose text-lead text-charcoal">
                    Mohon tunggu beberapa menit sebelum mengirim pesan lagi. Batas ini membantu kami menjaga formulir dari spam.
                </p>

                <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:gap-4">
                    <x-button href="{{ route('contact') }}">Kembali ke Halaman Kontak</x-button>
                    <x-button href="{{ route('home') }}" variant="outline">Kembali ke Beranda</x-button>
                </div>
            </div>
        </x-container>
    </section>
</x-layout>
