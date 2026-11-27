{{--
    Wadah halaman: lebar maksimum 1184 px, padding samping 20 px (mobile) dan 48 px (desktop)
    sesuai docs/DESIGN.md bagian 6.
--}}
<div {{ $attributes->merge(['class' => 'mx-auto w-full max-w-shell px-5 lg:px-12']) }}>
    {{ $slot }}
</div>
