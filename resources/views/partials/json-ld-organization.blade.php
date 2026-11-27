@php
    // Structured data hanya berisi data yang sudah dikonfirmasi (docs/AGENTS.md bagian 10).
    // Email dan alamat lengkap belum dikonfirmasi, jadi belum dimasukkan.
    $organization = [
        '@context' => 'https://schema.org',
        '@type' => 'Organization',
        'name' => config('site.name'),
        'url' => config('app.url'),
        'telephone' => '+'.\App\Support\WhatsApp::number(),
        'areaServed' => config('site.service_areas'),
        'address' => [
            '@type' => 'PostalAddress',
            'addressLocality' => 'Bogor',
            'addressCountry' => 'ID',
        ],
    ];
@endphp

<script type="application/ld+json">{!! json_encode($organization, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) !!}</script>
