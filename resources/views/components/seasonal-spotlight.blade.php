@use('App\Support\WhatsApp')

@props([
    'campaign',
    'services',
])

{{-- Band sorotan musim (docs/SEASONAL.md bagian 6.3): hanya muncul saat ada kampanye aktif. --}}
<section id="sorotan-musim" aria-labelledby="judul-sorotan-musim" class="border-y border-line bg-mist">
    <x-container class="grid gap-8 py-10 lg:grid-cols-12 lg:gap-10 lg:py-14">
        <div class="lg:col-span-5" data-reveal>
            <x-eyebrow>Sorotan musim</x-eyebrow>

            <h2 id="judul-sorotan-musim" class="mt-4 font-display text-chapter font-bold tracking-heading text-navy">
                {{ $campaign->spotlightTitle() }}
            </h2>

            <p class="mt-3 text-label font-semibold uppercase tracking-label text-charcoal">
                {{ $campaign->periodLabel() }}
            </p>

            @if ($campaign->spotlightDescription())
                <p class="mt-5 max-w-prose text-body-lg text-charcoal">
                    {{ $campaign->spotlightDescription() }}
                </p>
            @endif
        </div>

        <div class="lg:col-span-7" data-reveal style="--reveal-delay: 100ms">
            @if ($services->isNotEmpty())
                <ol class="border-t border-line">
                    @foreach ($services as $index => $service)
                        <li class="border-b border-line">
                            <a href="{{ route('services.show', $service) }}"
                               class="group flex min-h-11 items-center justify-between gap-4 py-4">
                                <span class="flex min-w-0 items-baseline gap-4">
                                    <span class="font-display text-small font-bold tabular-nums text-signal">
                                        {{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}
                                    </span>
                                    <span class="text-card font-semibold text-navy transition-colors duration-150 group-hover:text-signal">
                                        {{ $service->name }}
                                    </span>
                                </span>

                                <x-site-icon name="arrow-right" class="h-5 w-5 shrink-0 text-navy transition-transform duration-150 group-hover:translate-x-1" />
                            </a>
                        </li>
                    @endforeach
                </ol>
            @endif

            <div class="mt-7 flex flex-col gap-3 sm:flex-row sm:items-center">
                <x-button href="{{ WhatsApp::link($campaign->whatsapp_message) }}">
                    {{ $campaign->ctaLabel() }}
                </x-button>
                <x-button href="{{ route('services.index') }}" variant="outline">
                    Lihat Program Kami
                </x-button>
            </div>
        </div>
    </x-container>
</section>
