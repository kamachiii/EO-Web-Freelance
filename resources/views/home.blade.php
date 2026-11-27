@use('App\Support\WhatsApp')

@php
    $hero = config('site.hero_image');

    $heroImage = [
        'desktop' => $banner?->image_desktop
            ? asset('images/hero/'.$banner->image_desktop)
            : asset($hero['desktop']),
        'mobile' => $banner?->image_mobile
            ? asset('images/hero/'.$banner->image_mobile)
            : ($banner?->image_desktop
                ? asset('images/hero/'.$banner->image_desktop)
                : asset($hero['mobile'])),
        'alt' => $banner?->image_alt ?: $hero['alt'],
        'width' => $banner?->image_desktop ? 1200 : $hero['width'],
        'height' => $banner?->image_desktop ? 1000 : $hero['height'],
        'mobile_width' => $banner?->image_mobile ? 1050 : ($banner?->image_desktop ? 1200 : $hero['mobile_width']),
        'mobile_height' => $banner?->image_mobile ? 600 : ($banner?->image_desktop ? 1000 : $hero['mobile_height']),
    ];
@endphp

<x-layout :title="$seo['title']" :description="$seo['description']">
    <x-slot name="head">
        <link rel="preload" as="image" href="{{ $heroImage['desktop'] }}" media="(min-width: 1024px)" fetchpriority="high">
        <link rel="preload" as="image" href="{{ $heroImage['mobile'] }}" media="(max-width: 1023px)" fetchpriority="high">
        @include('partials.json-ld-organization')
    </x-slot>

    {{-- Hero editorial: judul besar, foto sebagai bukti, area layanan sebagai penutup. --}}
    <section class="flex flex-col justify-center overflow-hidden bg-navy text-white focus-light sm:min-h-[calc(100svh_-_5.3125rem)]" aria-labelledby="judul-hero">
        <x-container class="grid items-center gap-12 pb-14 pt-10 lg:grid-cols-12 lg:gap-10 lg:pb-20 lg:pt-16">
            <div class="lg:col-span-6">
                <h1 id="judul-hero"
                    class="max-w-[15ch] animate-hero-rise font-display text-display font-bold tracking-display"
                    style="animation-delay: 80ms">
                    {{ config('site.headline') }}<span class="text-signal">.</span>
                </h1>

                <p class="mt-6 max-w-prose animate-hero-rise text-lead text-mist" style="animation-delay: 160ms">
                    {{ $banner?->subheadline ?: config('site.subheadline') }}
                </p>

                <div class="mt-8 flex animate-hero-rise flex-col gap-3 sm:flex-row sm:gap-4" style="animation-delay: 240ms">
                    <x-button href="{{ WhatsApp::link() }}">Konsultasi Gratis Sekarang</x-button>
                    <x-button href="{{ route('services.index') }}" variant="secondary">Lihat Program Kami</x-button>
                </div>

                <div class="mt-10 animate-hero-rise border-t border-white/20 pt-5" style="animation-delay: 320ms">
                    <p class="text-label font-semibold uppercase tracking-label text-mist">Area layanan</p>
                    <p class="mt-2 max-w-md text-small text-white">{{ config('site.service_area_summary') }}</p>
                </div>
            </div>

            {{-- Foto stok sementara: Pexels. Kredit lengkap di docs/IMAGE-CREDITS.md. --}}
            <figure class="lg:col-span-6">
                <div class="animate-media-in overflow-hidden bg-mist" style="animation-delay: 120ms">
                    <picture>
                        <source media="(min-width: 1024px)" srcset="{{ $heroImage['desktop'] }}">
                        <img src="{{ $heroImage['mobile'] }}"
                             width="{{ $heroImage['mobile_width'] }}"
                             height="{{ $heroImage['mobile_height'] }}"
                             alt="{{ $heroImage['alt'] }}"
                             fetchpriority="high" loading="eager" decoding="async"
                             class="aspect-[7/4] w-full object-cover lg:aspect-[6/5]">
                    </picture>
                </div>
            </figure>
        </x-container>
    </section>

    {{-- Strip audiens: satu baris berjalan, berhenti saat kursor di atasnya. --}}
    <div class="border-y border-line bg-white">
        <x-container class="flex flex-col gap-3 py-4 sm:flex-row sm:items-center sm:gap-8">
            <p class="shrink-0 text-label font-semibold uppercase tracking-label text-charcoal">Kami melayani</p>

            <div class="audience-marquee min-w-0 flex-1">
                <div class="audience-track items-center">
                    @foreach ([0, 1] as $copy)
                        <ul class="flex shrink-0 items-center gap-8 pr-8" @if ($copy === 1) aria-hidden="true" @endif>
                            @foreach (config('site.target_clients') as $client)
                                <li class="flex items-center gap-3 whitespace-nowrap text-small font-medium text-navy">
                                    <span class="h-1 w-1 shrink-0 bg-navy" aria-hidden="true"></span>
                                    {{ $client }}
                                </li>
                            @endforeach
                        </ul>
                    @endforeach
                </div>
            </div>
        </x-container>
    </div>

    {{-- Tentang singkat: heading dan paragraf pembuka di kiri, konteks dan fakta di kanan. --}}
    <x-section aria-labelledby="judul-siapa-kami">
        <x-container>
            <div class="grid gap-12 lg:grid-cols-12 lg:gap-10">
                <div class="lg:col-span-6" data-reveal>
                    <x-eyebrow>Tentang</x-eyebrow>
                    <h2 id="judul-siapa-kami" class="mt-5 font-display text-chapter font-bold tracking-heading text-navy">
                        Siapa Kami?
                    </h2>
                    <p class="mt-6 max-w-md text-lead text-navy">{{ config('site.about.intro.0') }}</p>
                    <div class="mt-8">
                        <x-text-link href="{{ route('about') }}" arrow>Selengkapnya tentang kami</x-text-link>
                    </div>
                </div>

                <div class="lg:col-span-6 lg:border-l lg:border-line lg:pl-10" data-reveal style="--reveal-delay: 100ms">
                    <p class="max-w-prose text-body-lg text-charcoal">{{ config('site.about.intro.1') }}</p>

                    <dl class="mt-10 border-t border-line pt-8">
                        <div>
                            <dt class="text-label font-semibold uppercase tracking-label text-charcoal">Cocok untuk</dt>
                            <dd class="mt-4">
                                <ul class="grid gap-x-6 gap-y-2 text-body text-charcoal sm:grid-cols-2">
                                    @foreach (config('site.target_clients') as $client)
                                        <li>{{ $client }}</li>
                                    @endforeach
                                </ul>
                            </dd>
                        </div>

                        <div class="mt-8">
                            <dt class="text-label font-semibold uppercase tracking-label text-charcoal">Area layanan</dt>
                            <dd class="mt-4 text-body text-charcoal">{{ config('site.service_area_summary') }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </x-container>
    </x-section>

    {{-- Mengapa memilih kami: tiga pilar sebagai baris bernomor. --}}
    <x-section tone="mist" aria-labelledby="judul-pilar">
        <x-container>
            <div class="grid gap-8 lg:grid-cols-12 lg:gap-6">
                <div class="lg:col-span-6" data-reveal>
                    <x-eyebrow>Pilar</x-eyebrow>
                    <h2 id="judul-pilar" class="mt-4 font-display text-chapter font-bold tracking-heading text-navy">
                        Mengapa Memilih Kami
                    </h2>
                </div>

                <div class="lg:col-span-6 lg:self-end" data-reveal style="--reveal-delay: 100ms">
                    <p class="max-w-prose text-lead text-charcoal">
                        Tiga pilar yang kami jaga di setiap program.
                    </p>
                </div>
            </div>

            <div class="mt-12 border-t-2 border-navy lg:mt-16">
                @foreach (config('site.pillars') as $pillar)
                    <article class="grid gap-4 border-b border-line py-8 lg:grid-cols-12 lg:gap-6 lg:py-10">
                        <p class="font-display text-figure font-bold leading-none text-navy/[0.55] lg:col-span-2" aria-hidden="true">
                            {{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}
                        </p>
                        <h3 class="font-display text-quote font-bold tracking-heading text-navy lg:col-span-4">
                            {{ $pillar['title'] }}
                        </h3>
                        <p class="max-w-prose text-body-lg text-charcoal lg:col-span-6">
                            {{ $pillar['text'] }}
                        </p>
                    </article>
                @endforeach
            </div>
        </x-container>
    </x-section>

    {{-- Index layanan: nomor, judul, ringkasan, foto. --}}
    <x-section aria-labelledby="judul-layanan">
        <x-container>
            <div class="flex flex-col gap-6 sm:flex-row sm:items-end sm:justify-between" data-reveal>
                <div>
                    <x-eyebrow>Program</x-eyebrow>
                    <h2 id="judul-layanan" class="mt-4 font-display text-chapter font-bold tracking-heading text-navy">
                        Layanan kami
                    </h2>
                </div>

                <x-text-link href="{{ route('services.index') }}" arrow>Lihat semua layanan</x-text-link>
            </div>

            <div class="mt-10">
                <x-service-index :services="$services" />
            </div>

            <div class="mt-12 grid gap-6 border-t border-line pt-8 lg:grid-cols-12" data-reveal>
                <div class="lg:col-span-6">
                    <p class="text-label font-semibold uppercase tracking-label text-charcoal">Layanan pendukung</p>
                    <div class="mt-2">
                        <x-text-link href="{{ route('supporting-services.index') }}" arrow>Lihat layanan pendukung</x-text-link>
                    </div>
                </div>
                <div class="lg:col-span-6">
                    <p class="max-w-prose text-body-lg text-charcoal">{{ config('site.supporting_summary') }}</p>
                </div>
            </div>
        </x-container>
    </x-section>

    {{-- Band CTA penuh, bukan kartu di tengah halaman. --}}
    <section class="bg-navy text-white focus-light" aria-labelledby="judul-cta" data-wa-hide>
        <x-container class="grid gap-10 py-16 lg:grid-cols-12 lg:py-24">
            <div class="lg:col-span-7" data-reveal>
                <x-eyebrow tone="dark">Mulai dari sini</x-eyebrow>
                <h2 id="judul-cta" class="mt-5 max-w-[18ch] font-display text-chapter font-bold tracking-heading">
                    Konsultasikan acara Anda.
                </h2>
                <p class="mt-5 max-w-prose text-lead text-mist">
                    Tim kami siap membantu merencanakan konsep acara Anda tanpa biaya tambahan.
                </p>
                <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:gap-4">
                    <x-button href="{{ WhatsApp::link() }}">Konsultasi Gratis Sekarang</x-button>
                    <x-button href="{{ route('contact') }}" variant="secondary">Isi Formulir Kontak</x-button>
                </div>
            </div>

            <div class="flex flex-col justify-end gap-6 border-t border-white/20 pt-6 lg:col-span-4 lg:col-start-9" data-reveal style="--reveal-delay: 100ms">
                <div>
                    <p class="text-label font-semibold uppercase tracking-label text-mist">WhatsApp</p>
                    <a href="{{ WhatsApp::link() }}"
                       class="mt-1 inline-flex min-h-11 items-center text-lead font-semibold text-white underline decoration-white/40 underline-offset-4 transition-colors duration-150 hover:decoration-white">
                        {{ WhatsApp::display() }}
                    </a>
                </div>
                <div>
                    <p class="text-label font-semibold uppercase tracking-label text-mist">Email</p>
                    <a href="mailto:{{ config('site.email') }}"
                       class="mt-1 inline-flex min-h-11 items-center break-all text-body font-semibold text-white underline decoration-white/40 underline-offset-4 transition-colors duration-150 hover:decoration-white">
                        {{ config('site.email') }}
                    </a>
                </div>
                <div>
                    <p class="text-label font-semibold uppercase tracking-label text-mist">Basecamp</p>
                    <p class="mt-1 text-body text-white">{{ config('site.basecamp') }}</p>
                </div>
            </div>
        </x-container>
    </section>
</x-layout>
