@props([
    'tone' => 'light', // light: di atas latar terang; dark: di atas navy
])

@php
    $text = $tone === 'dark' ? 'text-mist' : 'text-charcoal';
@endphp

{{-- Eyebrow: garis pendek + label kapital (docs/DESIGN.md bagian 6). --}}
<div {{ $attributes->merge(['class' => 'flex items-center gap-3']) }}>
    <span class="h-px w-8 shrink-0 bg-signal" aria-hidden="true"></span>
    <p class="text-label font-semibold uppercase tracking-label {{ $text }}">{{ $slot }}</p>
</div>
