<x-layout :title="$seo['title']" :description="$seo['description']">
    <x-page-cover eyebrow="Program"
                  title="Layanan"
                  title-id="judul-layanan"
                  intro="Kami menyelenggarakan program outbound dan kegiatan tim untuk perusahaan swasta, instansi pemerintah, komunitas & organisasi, universitas, dan sekolah."
                  action-label="Lihat program"
                  action-href="#judul-program">
        <x-slot:meta>
            <p class="text-label font-semibold uppercase tracking-label text-mist">
                <span class="text-white">{{ str_pad((string) $services->count(), 2, '0', STR_PAD_LEFT) }}</span> Program
            </p>
        </x-slot:meta>
    </x-page-cover>

    <x-section aria-labelledby="judul-program">
        <x-container>
            <div class="grid gap-6 lg:grid-cols-12 lg:items-end" data-reveal>
                <div class="lg:col-span-7">
                    <x-eyebrow>Index</x-eyebrow>
                    <h2 id="judul-program" class="mt-4 font-display text-chapter font-bold tracking-heading text-navy">
                        Layanan utama
                    </h2>
                </div>
                <div class="lg:col-span-5">
                    <p class="max-w-prose text-lead text-charcoal">
                        Pilih program, lalu minta penawaran sesuai jumlah peserta dan lokasi acara Anda.
                    </p>
                </div>
            </div>

            <div class="mt-10">
                <x-service-index :services="$services" detailed />
            </div>
        </x-container>
    </x-section>

    <x-section tone="mist" aria-labelledby="judul-pendukung">
        <x-container class="grid gap-8 lg:grid-cols-12 lg:gap-10">
            <div class="lg:col-span-6" data-reveal>
                <x-eyebrow>Add-on</x-eyebrow>
                <h2 id="judul-pendukung" class="mt-4 font-display text-chapter font-bold tracking-heading text-navy">
                    Lengkapi acara Anda
                </h2>
            </div>

            <div class="lg:col-span-6" data-reveal style="--reveal-delay: 100ms">
                <p class="max-w-prose text-lead text-charcoal">{{ config('site.supporting_summary') }}</p>
                <p class="mt-4 max-w-prose text-body text-charcoal">
                    Tersedia sebagai add-on, mengikuti kebutuhan dan lokasi acara.
                </p>
                <div class="mt-4">
                    <x-text-link href="{{ route('supporting-services.index') }}" arrow>Lihat layanan pendukung</x-text-link>
                </div>
            </div>
        </x-container>
    </x-section>

    <x-section>
        <x-container class="pb-10" data-reveal>
            <x-cta-card
                title="Konsultasikan acara Anda"
                text="Tim kami siap membantu merencanakan konsep acara Anda tanpa biaya tambahan."
                button-label="Minta Penawaran" />
        </x-container>
    </x-section>
</x-layout>
