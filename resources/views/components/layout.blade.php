@props([
    'title' => null,
    'description' => null,
])

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#14305B">

    {{-- Konten reveal hanya disembunyikan kalau JavaScript aktif (docs/DESIGN.md bagian 9). --}}
    <script>document.documentElement.classList.add('js');</script>

    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="icon" href="{{ asset('favicon-32.png') }}" type="image/png" sizes="32x32">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">

    <title>{{ $title ?? config('site.name') }}</title>

    @if ($description)
        <meta name="description" content="{{ $description }}">
    @endif

    <link rel="canonical" href="{{ url()->current() }}">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ config('site.name') }}">
    <meta property="og:locale" content="id_ID">
    <meta property="og:title" content="{{ $title ?? config('site.name') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    @if ($description)
        <meta property="og:description" content="{{ $description }}">
    @endif
    <meta property="og:image" content="{{ asset(config('site.og_image.file')) }}">
    <meta property="og:image:width" content="{{ config('site.og_image.width') }}">
    <meta property="og:image:height" content="{{ config('site.og_image.height') }}">
    <meta property="og:image:alt" content="{{ config('site.name') }}: outbound, team building, dan MICE">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title ?? config('site.name') }}">
    @if ($description)
        <meta name="twitter:description" content="{{ $description }}">
    @endif
    <meta name="twitter:image" content="{{ asset(config('site.og_image.file')) }}">

    @isset($head)
        {{ $head }}
    @endisset

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body id="top" class="flex min-h-screen flex-col bg-white font-sans text-body text-charcoal lg:text-body-lg">
    <a href="#konten"
       class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-50 focus:rounded-button focus:bg-white focus:px-4 focus:py-3 focus:font-semibold focus:text-navy">
        Lewati ke konten
    </a>

    <x-header />

    <main id="konten" tabindex="-1" class="flex-1 focus:outline-none">
        {{ $slot }}
    </main>

    <x-footer />
    <x-whatsapp-button />
    <x-back-to-top />
</body>
</html>
