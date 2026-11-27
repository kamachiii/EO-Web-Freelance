@props([
    'tone' => 'white', // white | mist | navy
    'tight' => false,
])

@php
    $backgrounds = [
        'white' => 'bg-white text-charcoal',
        'mist' => 'bg-mist text-charcoal',
        'navy' => 'bg-navy text-white focus-light',
    ];
@endphp

{{--
    Section dengan jarak 48 px (mobile) dan 80 px (desktop). Band rapat 40/56 px
    (docs/DESIGN.md bagian 5). Hijau tidak dipakai sebagai latar band penuh.
--}}
<section {{ $attributes->merge(['class' => ($tight ? 'py-10 lg:py-14' : 'py-12 lg:py-20').' '.($backgrounds[$tone] ?? $backgrounds['white'])]) }}>
    {{ $slot }}
</section>
