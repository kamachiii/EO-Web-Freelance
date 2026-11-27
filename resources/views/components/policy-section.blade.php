@props([
    'id',
    'number',
    'title',
])

<section id="{{ $id }}" aria-labelledby="judul-{{ $id }}" class="relative sm:pl-16" data-reveal>
    <span class="policy-number absolute left-0 top-0 hidden h-10 w-10 items-center justify-center rounded-full border border-line bg-white text-label font-semibold tabular-nums text-navy sm:flex" aria-hidden="true">
        {{ $number }}
    </span>

    <div class="flex items-baseline gap-4 sm:block">
        <span class="text-label font-semibold tabular-nums text-charcoal/70 sm:hidden" aria-hidden="true">{{ $number }}</span>
        <h2 id="judul-{{ $id }}" class="font-display text-card-lg font-bold tracking-heading text-navy">{{ $title }}</h2>
    </div>

    <div {{ $attributes->merge(['class' => 'mt-4 max-w-prose text-body-lg text-charcoal']) }}>
        {{ $slot }}
    </div>
</section>
