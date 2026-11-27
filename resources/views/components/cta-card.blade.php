@use('App\Support\WhatsApp')

@props([
    'title',
    'text' => null,
    'buttonLabel' => 'Konsultasi Gratis Sekarang',
    'href' => null,
])

{{-- Panel CTA navy: judul kiri, tombol kanan (docs/DESIGN.md bagian 6). --}}
<div class="rounded-cta bg-navy px-6 py-8 text-white focus-light lg:px-10 lg:py-10" data-wa-hide>
    <div class="grid gap-8 lg:grid-cols-12 lg:items-center">
        <div class="lg:col-span-8">
            <x-eyebrow tone="dark">Konsultasi</x-eyebrow>
            <h2 class="mt-4 font-display text-chapter font-bold tracking-heading">{{ $title }}</h2>

            @if ($text)
                <p class="mt-4 max-w-prose text-body-lg text-mist">{{ $text }}</p>
            @endif
        </div>

        <div class="lg:col-span-4 lg:justify-self-end">
            <x-button :href="$href ?? WhatsApp::link()">{{ $buttonLabel }}</x-button>
        </div>
    </div>
</div>
