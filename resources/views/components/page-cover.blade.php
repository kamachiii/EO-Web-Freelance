@props([
    'eyebrow',
    'title',
    'titleId',
    'intro',
    'actionLabel' => null,
    'actionHref' => null,
])

@php
    // Konten cover diletakkan vertikal tengah (docs/DESIGN.md bagian 6).
    $sectionClass = 'page-cover flex min-h-[calc(100svh_-_4.8125rem)] flex-col bg-white sm:min-h-[calc(100svh_-_5.3125rem)]';
@endphp

{{--
    Header halaman penuh satu layar di bawah header sticky (77 px mobile, 85 px dari sm).
    Baris bawah berisi penanda halaman dan tautan lompat ke section pertama.
--}}
<section {{ $attributes->merge(['class' => $sectionClass]) }}
         aria-labelledby="{{ $titleId }}">
    <x-container class="page-cover-content flex flex-1 items-center py-12 lg:py-20">
        <div class="grid w-full gap-8 lg:grid-cols-12 lg:gap-10">
            <div class="lg:col-span-6 lg:self-center">
                <x-eyebrow>{{ $eyebrow }}</x-eyebrow>
                <h1 id="{{ $titleId }}" class="mt-5 font-display text-display font-bold tracking-display text-navy">
                    {{ $title }}
                </h1>
            </div>

            <div class="lg:col-span-6 lg:col-start-7 lg:self-center">
                <p class="max-w-prose text-lead text-charcoal">{{ $intro }}</p>
                {{ $aside ?? '' }}
            </div>
        </div>
    </x-container>

    <div class="bg-navy text-white focus-light">
        <x-container class="py-3 lg:py-4">
            <div class="flex flex-wrap items-center justify-between gap-x-4 gap-y-1 sm:gap-x-6">
                <div>{{ $meta ?? '' }}</div>

                @if ($actionLabel && $actionHref)
                    <a href="{{ $actionHref }}"
                       class="group inline-flex min-h-11 items-center gap-2 text-small font-semibold text-white underline-offset-4 hover:underline">
                        {{ $actionLabel }}
                        <x-icon name="chevron-down" class="h-4 w-4 transition-transform duration-150 group-hover:translate-y-0.5" />
                    </a>
                @endif
            </div>
        </x-container>
    </div>
</section>
