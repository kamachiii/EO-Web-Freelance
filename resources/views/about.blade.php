@php
    $intro = config('site.about.intro');
@endphp

<x-layout :title="$seo['title']" :description="$seo['description']">
    <x-page-cover eyebrow="Tentang"
                  title="Siapa Kami?"
                  title-id="judul-tentang"
                  :intro="$intro[0]"
                  action-label="Lihat visi & misi"
                  action-href="#judul-visi">
        <x-slot:meta>
            <p class="text-label font-semibold uppercase tracking-label text-mist">Visi &amp; Misi</p>
        </x-slot:meta>
    </x-page-cover>

    <x-section tone="mist" aria-labelledby="judul-visi">
        <x-container class="grid gap-8 lg:grid-cols-12 lg:gap-10">
            <div class="lg:col-span-6" data-reveal>
                <x-eyebrow>Arah</x-eyebrow>
                <h2 id="judul-visi" class="mt-4 font-display text-chapter font-bold tracking-heading text-navy">
                    Visi
                </h2>
                <p class="mt-5 max-w-prose text-body-lg text-charcoal">{{ $intro[1] }}</p>
            </div>

            <blockquote class="border-t-2 border-navy pt-6 lg:col-span-6 lg:col-start-7" data-reveal style="--reveal-delay: 100ms">
                <p class="font-display text-quote font-medium text-navy">&ldquo;{{ config('site.vision') }}&rdquo;</p>
            </blockquote>
        </x-container>
    </x-section>

    <x-section aria-labelledby="judul-misi">
        <x-container>
            <div class="grid gap-8 lg:grid-cols-12 lg:gap-10">
                <div class="lg:col-span-6" data-reveal>
                    <x-eyebrow>Komitmen</x-eyebrow>
                    <h2 id="judul-misi" class="mt-4 font-display text-chapter font-bold tracking-heading text-navy">
                        Misi
                    </h2>
                </div>

                <div class="lg:col-span-6 lg:col-start-7 lg:self-end" data-reveal style="--reveal-delay: 100ms">
                    <p class="max-w-prose text-lead text-charcoal">
                        Tiga komitmen yang kami bawa ke setiap perencanaan dan pelaksanaan acara.
                    </p>
                </div>
            </div>

            <ol class="mt-12 border-t-2 border-navy lg:mt-16" data-reveal style="--reveal-delay: 100ms">
                @foreach (config('site.mission') as $mission)
                    <li class="grid gap-4 border-b border-line py-8 lg:grid-cols-12 lg:gap-6 lg:py-10">
                        <span class="font-display text-figure font-bold leading-none text-navy/[0.55] lg:col-span-2" aria-hidden="true">
                            {{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}
                        </span>
                        <h3 class="font-display text-quote font-bold tracking-heading text-navy lg:col-span-4">{{ $mission['title'] }}</h3>
                        <p class="max-w-prose text-body-lg text-charcoal lg:col-span-6">{{ $mission['text'] }}</p>
                    </li>
                @endforeach
            </ol>
        </x-container>
    </x-section>

    <x-section tone="mist">
        <x-container class="pb-10" data-reveal>
            <x-cta-card
                title="Konsultasikan acara Anda"
                text="Tim kami siap membantu merencanakan konsep acara Anda tanpa biaya tambahan." />
        </x-container>
    </x-section>
</x-layout>
