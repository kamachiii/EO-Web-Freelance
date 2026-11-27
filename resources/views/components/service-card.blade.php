@props([
    'service',
    'position' => null,
])

@php
    $image = config('site.service_images.'.$service->slug);
    $number = $position ? str_pad((string) $position, 2, '0', STR_PAD_LEFT) : null;
@endphp

{{-- Teaser layanan berfoto untuk "Layanan lainnya" (docs/DESIGN.md bagian 6). --}}
<article class="group relative">
    <a href="{{ route('services.show', $service) }}" class="block">
        @if ($image)
            <div class="overflow-hidden bg-mist">
                <img src="{{ asset($image['file']) }}"
                     alt="{{ $image['alt'] }}"
                     width="800" height="500"
                     loading="lazy" decoding="async"
                     class="aspect-[4/3] w-full object-cover transition-transform duration-500 ease-editorial group-hover:scale-[1.03]">
            </div>
        @endif

        <div class="mt-4 flex items-start justify-between gap-4 border-t border-line pt-4">
            <div>
                @if ($number)
                    <p class="text-label font-semibold tabular-nums text-charcoal" aria-hidden="true">{{ $number }}</p>
                @endif

                <h3 class="mt-2 font-display text-card-lg font-bold tracking-heading text-navy">{{ $service->name }}</h3>

                <p class="mt-2 text-small text-charcoal">{{ $service->excerpt }}</p>
            </div>

            <x-site-icon name="arrow-up-right" class="mt-1 h-5 w-5 shrink-0 text-navy transition-all duration-300 ease-editorial group-hover:-translate-y-0.5 group-hover:translate-x-0.5" />
        </div>
    </a>
</article>
