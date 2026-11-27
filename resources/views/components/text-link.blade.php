@props([
    'href',
    'arrow' => false,
])

{{-- Tautan teks: navy, digarisbawahi (docs/DESIGN.md bagian 7). --}}
<a {{ $attributes->merge(['class' => 'inline-flex min-h-11 items-center gap-2 text-body font-semibold text-navy underline underline-offset-4 transition-colors duration-150 hover:decoration-2']) }}
   href="{{ $href }}">
    {{ $slot }}

    @if ($arrow)
        <x-icon name="arrow-right" class="h-5 w-5" />
    @endif
</a>
