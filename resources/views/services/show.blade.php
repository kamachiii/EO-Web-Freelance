@use('App\Support\WhatsApp')

@php
    $serviceDescription = $service->description ?: $service->excerpt;
    $whatsappMessage = 'Halo, saya ingin minta penawaran untuk '.$service->name.'.';
    $image = config('site.service_images.'.$service->slug);
    $contactLink = route('contact', ['service' => $service->slug]);
@endphp

<x-layout :title="$seo['title']" :description="$seo['description']">
    <section class="bg-white pb-12 pt-8 lg:pb-20 lg:pt-12" aria-labelledby="judul-layanan">
        <x-container>
            <nav aria-label="Breadcrumb" class="mb-8">
                <ol class="flex flex-wrap items-center gap-2 text-small text-charcoal">
                    <li><a href="{{ route('home') }}" class="inline-flex min-h-11 items-center underline decoration-line underline-offset-4 hover:text-navy hover:decoration-navy">Beranda</a></li>
                    <li aria-hidden="true" class="text-charcoal/40">/</li>
                    <li><a href="{{ route('services.index') }}" class="inline-flex min-h-11 items-center underline decoration-line underline-offset-4 hover:text-navy hover:decoration-navy">Layanan</a></li>
                    <li aria-hidden="true" class="text-charcoal/40">/</li>
                    <li aria-current="page" class="text-navy"><x-service-name :name="$service->name" /></li>
                </ol>
            </nav>

            <div class="grid gap-12 lg:grid-cols-12 lg:gap-10">
                <div class="lg:col-span-6">
                    <x-eyebrow>Program</x-eyebrow>

                    <h1 id="judul-layanan" class="mt-5 max-w-[15ch] font-display text-display font-bold tracking-display text-navy">
                        <x-service-name :name="$service->name" />
                    </h1>

                    <p class="mt-6 max-w-prose text-lead text-charcoal">{{ $serviceDescription }}</p>

                    <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:gap-4">
                        <x-button :href="WhatsApp::link($whatsappMessage)">Minta Penawaran</x-button>
                        <x-button :href="$contactLink" variant="outline">Isi Formulir Kontak</x-button>
                    </div>

                    <p class="mt-6 max-w-prose text-small text-charcoal">
                        Ceritakan jumlah peserta, lokasi, dan tanggal acara. Kami bantu susun konsepnya tanpa biaya konsultasi.
                    </p>
                </div>

                <div class="lg:col-span-6">
                    @if ($image)
                        {{-- Foto stok sementara: Pexels. Kredit lengkap di docs/IMAGE-CREDITS.md. --}}
                        <figure>
                            <div class="overflow-hidden bg-mist">
                                <img src="{{ asset($image['file']) }}"
                                     alt="{{ $image['alt'] }}"
                                     width="800" height="500"
                                     fetchpriority="high" loading="eager" decoding="async"
                                     class="aspect-[16/10] w-full object-cover">
                            </div>
                        </figure>
                    @else
                        <div class="flex aspect-[16/10] items-center justify-center bg-mist">
                            <img src="{{ asset('images/brand/logo-icon.svg') }}" width="320" height="320" alt="" class="w-32">
                        </div>
                    @endif

                    <div class="mt-8 bg-mist p-6 lg:p-8">
                        <h2 class="font-display text-card-lg font-bold text-navy">Konsultasi gratis</h2>

                        <p class="mt-3 max-w-prose text-body text-charcoal">
                            Tim kami siap membantu merencanakan konsep acara Anda tanpa biaya tambahan.
                        </p>

                        <ul class="mt-4 space-y-1 text-body">
                            <li>
                                <a href="{{ WhatsApp::link($whatsappMessage) }}"
                                   target="_blank"
                                   rel="noopener"
                                   class="inline-flex min-h-11 items-center font-semibold text-navy underline decoration-navy/30 underline-offset-4 transition-colors duration-150 hover:decoration-navy">
                                    WhatsApp: {{ WhatsApp::display() }}
                                </a>
                            </li>
                            <li>
                                <a href="mailto:{{ config('site.email') }}"
                                   class="inline-flex min-h-11 items-center break-all font-semibold text-navy underline decoration-navy/30 underline-offset-4 transition-colors duration-150 hover:decoration-navy">
                                    {{ config('site.email') }}
                                </a>
                            </li>
                        </ul>

                        <p class="mt-5 text-label font-semibold uppercase tracking-label text-charcoal">Area layanan</p>
                        <p class="mt-2 text-small text-charcoal">{{ config('site.service_area_summary') }}</p>
                    </div>
                </div>
            </div>
        </x-container>
    </section>

    @if ($otherServices->isNotEmpty())
        <x-section tone="mist" aria-labelledby="judul-layanan-lain">
            <x-container>
                <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between" data-reveal>
                    <div>
                        <x-eyebrow>Jelajahi</x-eyebrow>
                        <h2 id="judul-layanan-lain" class="mt-4 font-display text-chapter font-bold tracking-heading text-navy">
                            Layanan lainnya
                        </h2>
                    </div>
                    <x-text-link href="{{ route('services.index') }}" arrow>Lihat semua layanan</x-text-link>
                </div>

                <div class="mt-10 grid gap-x-8 gap-y-10 sm:grid-cols-2 lg:grid-cols-3" data-reveal style="--reveal-delay: 100ms">
                    @foreach ($otherServices as $otherService)
                        <x-service-card :service="$otherService" :position="$loop->iteration" />
                    @endforeach
                </div>
            </x-container>
        </x-section>
    @endif

    <x-section>
        <x-container class="pb-10" data-reveal>
            <x-cta-card
                title="Konsultasikan acara Anda"
                text="Tim kami siap membantu merencanakan konsep acara Anda tanpa biaya tambahan." />
        </x-container>
    </x-section>
</x-layout>
