@use('App\Support\WhatsApp')

@php
    $menu = [
        ['label' => 'Beranda', 'route' => 'home', 'active' => request()->routeIs('home')],
        ['label' => 'Tentang', 'route' => 'about', 'active' => request()->routeIs('about')],
        ['label' => 'Layanan', 'route' => 'services.index', 'active' => request()->routeIs('services.*')],
        ['label' => 'Layanan Pendukung', 'route' => 'supporting-services.index', 'active' => request()->routeIs('supporting-services.*')],
        ['label' => 'Kontak', 'route' => 'contact', 'active' => request()->routeIs('contact*')],
    ];
@endphp

{{--
    Header sticky: putih, border bawah. Padding menyusut dan bayangan muncul
    saat halaman digulir (docs/DESIGN.md bagian 6).
--}}
<header class="site-header sticky top-0 z-40 border-b border-line bg-white transition-shadow duration-300 ease-editorial"
        x-data="{ open: false }">
    <x-container class="site-header-inner flex items-center justify-between gap-4 py-4 transition-[padding] duration-300 ease-editorial">
        <a href="{{ route('home') }}" class="inline-flex min-h-11 shrink-0 items-center gap-3 rounded-button">
            <img src="{{ asset('images/brand/logo-icon.svg') }}" width="40" height="40" alt="" class="h-10 w-10">
            <span class="font-display leading-tight">
                <span class="block text-lg font-bold text-navy">MR Global</span>
                <span class="block text-[0.6875rem] font-medium uppercase tracking-label text-charcoal">Events &amp; Solutions</span>
            </span>
        </a>

        <nav class="hidden lg:block" aria-label="Menu utama">
            <ul class="flex items-center gap-6 xl:gap-8">
                @foreach ($menu as $item)
                    <li>
                        <a href="{{ route($item['route']) }}"
                           @if ($item['active']) aria-current="page" @endif
                           class="inline-flex min-h-11 items-center border-b-2 text-body font-medium underline-offset-4 transition-colors duration-150 {{ $item['active'] ? 'border-navy text-navy' : 'border-transparent text-charcoal hover:border-line hover:text-navy' }}">
                            {{ $item['label'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>

        <div class="flex items-center gap-2">
            <div class="hidden sm:block">
                <x-button href="{{ WhatsApp::link() }}">
                    Konsultasi Gratis
                </x-button>
            </div>

            <button type="button"
                    data-menu-toggle
                    class="inline-flex h-11 w-11 items-center justify-center rounded-button text-navy transition-colors duration-150 hover:bg-mist lg:hidden"
                    @click="open = ! open"
                    :aria-expanded="open"
                    aria-controls="menu-mobile"
                    :aria-label="open ? 'Tutup menu' : 'Buka menu'">
                <x-icon name="bars-3" class="h-6 w-6" x-show="! open" />
                <x-icon name="x-mark" class="h-6 w-6" x-show="open" x-cloak />
            </button>
        </div>
    </x-container>

    <nav id="menu-mobile"
         class="border-t border-line bg-white lg:hidden"
         x-show="open"
         x-cloak
         x-transition:enter="transition ease-editorial duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         @click.outside="open = false"
         @keydown.escape.window="open = false"
         aria-label="Menu utama">
        <x-container class="flex flex-col gap-1 py-4">
            @foreach ($menu as $item)
                <a href="{{ route($item['route']) }}"
                   @click="open = false"
                   @if ($item['active']) aria-current="page" @endif
                   class="flex min-h-11 items-center rounded-button px-3 text-body font-medium {{ $item['active'] ? 'bg-mist text-navy' : 'text-charcoal hover:bg-mist hover:text-navy' }}">
                    {{ $item['label'] }}
                </a>
            @endforeach

            <div class="mt-3 sm:hidden">
                <x-button href="{{ WhatsApp::link() }}">Konsultasi Gratis</x-button>
            </div>
        </x-container>
    </nav>
</header>
