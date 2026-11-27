@props([
    'href' => null,
    'type' => 'submit', // hanya dipakai saat merender <button> (tanpa href)
    'variant' => 'primary', // primary | secondary | outline
])

@php
    $variants = [
        // Tombol utama: latar signal, teks navy, hover signal-hover (docs/DESIGN.md bagian 7).
        'primary' => 'bg-signal text-navy hover:bg-signal-hover',
        // Tombol sekunder untuk latar navy: garis putih 2 px, teks putih.
        'secondary' => 'border-2 border-white text-white hover:bg-white/10',
        // Tombol sekunder untuk latar terang: garis dan teks navy.
        'outline' => 'border-2 border-navy text-navy hover:bg-mist',
    ];

    $classes = 'inline-flex min-h-11 items-center justify-center gap-2 whitespace-nowrap rounded-button px-[22px] py-3.5 text-center text-body font-semibold tracking-ui no-underline transition-colors duration-150 '.($variants[$variant] ?? $variants['primary']);
@endphp

@if ($href)
    <a {{ $attributes->merge(['class' => $classes]) }} href="{{ $href }}">
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => $classes]) }} type="{{ $type }}">
        {{ $slot }}
    </button>
@endif
