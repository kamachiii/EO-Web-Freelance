@use('App\Support\WhatsApp')

@php
    $footerMenu = [
        ['label' => 'Beranda', 'route' => 'home', 'active' => request()->routeIs('home')],
        ['label' => 'Tentang', 'route' => 'about', 'active' => request()->routeIs('about')],
        ['label' => 'Layanan', 'route' => 'services.index', 'active' => request()->routeIs('services.*')],
        ['label' => 'Layanan Pendukung', 'route' => 'supporting-services.index', 'active' => request()->routeIs('supporting-services.*')],
        ['label' => 'Kontak', 'route' => 'contact', 'active' => request()->routeIs('contact*')],
    ];
@endphp

{{--
    Footer navy: identitas, halaman, kontak, dan area layanan bertingkat
    (docs/DESIGN.md bagian 6).
--}}
<footer class="border-t border-white/25 bg-navy text-mist focus-light" data-wa-hide>
    <x-container class="py-14 lg:py-20">
        <div class="grid gap-6 border-b border-white/15 pb-10 lg:grid-cols-12 lg:items-center lg:gap-10">
            <div class="lg:col-span-6">
                <a href="{{ route('home') }}" class="inline-flex min-h-11 items-center gap-3 rounded-button">
                    <img src="{{ asset('images/brand/logo-icon-dark.svg') }}" width="40" height="40" alt="" class="h-10 w-10">
                    <span class="font-display leading-tight">
                        <span class="block text-xl font-bold text-white">MR Global</span>
                        <span class="block text-label font-medium uppercase tracking-label text-mist">Events &amp; Solutions</span>
                    </span>
                </a>
            </div>

            <div class="lg:col-span-6 lg:col-start-7">
                <p class="max-w-prose text-body text-mist">{{ config('site.subheadline') }}</p>
            </div>
        </div>

        <div class="grid gap-10 pt-10 sm:grid-cols-2 lg:grid-cols-3 lg:gap-8">
            <nav aria-label="Navigasi footer">
                <h2 class="text-label font-semibold uppercase tracking-label text-white">Halaman</h2>
                <ul class="mt-3 divide-y divide-white/10 border-y border-white/10">
                    @foreach ($footerMenu as $item)
                        <li>
                            <a href="{{ route($item['route']) }}"
                               @if ($item['active']) aria-current="page" @endif
                               class="flex min-h-11 items-center text-body transition-colors duration-150 {{ $item['active'] ? 'text-white underline decoration-white underline-offset-4' : 'text-mist hover:text-white' }}">
                                {{ $item['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </nav>

            <div>
                <h2 class="text-label font-semibold uppercase tracking-label text-white">Kontak</h2>
                <dl class="mt-3 divide-y divide-white/10 border-y border-white/10">
                    <div class="grid gap-1 py-3 sm:grid-cols-[5rem_1fr] sm:items-center sm:gap-3 lg:py-4">
                        <dt class="text-small text-mist">WhatsApp</dt>
                        <dd>
                            <a href="{{ WhatsApp::link() }}" target="_blank" rel="noopener"
                               class="inline-flex min-h-11 items-center break-all text-body font-semibold text-white underline decoration-white/40 underline-offset-4 transition-colors duration-150 hover:decoration-white">
                                {{ WhatsApp::display() }}
                            </a>
                        </dd>
                    </div>

                    <div class="grid gap-1 py-3 sm:grid-cols-[5rem_1fr] sm:items-center sm:gap-3 lg:py-4">
                        <dt class="text-small text-mist">Email</dt>
                        <dd>
                            <a href="mailto:{{ config('site.email') }}"
                               class="inline-flex min-h-11 items-center break-all text-body font-semibold text-white underline decoration-white/40 underline-offset-4 transition-colors duration-150 hover:decoration-white">
                                {{ config('site.email') }}
                            </a>
                        </dd>
                    </div>

                    <div class="grid gap-1 py-3 sm:grid-cols-[5rem_1fr] sm:items-center sm:gap-3 lg:py-4">
                        <dt class="text-small text-mist">Basecamp</dt>
                        <dd class="flex min-h-11 items-center text-body text-white">{{ config('site.basecamp') }}</dd>
                    </div>
                </dl>
            </div>

            <div class="sm:col-span-2 lg:col-span-1">
                <h2 class="text-label font-semibold uppercase tracking-label text-white">Area layanan</h2>
                <dl class="mt-3 divide-y divide-white/10 border-y border-white/10">
                    @foreach (config('site.service_area_groups') as $group)
                        <div class="grid gap-1 py-3 sm:grid-cols-[8rem_1fr] sm:items-center sm:gap-3 lg:block">
                            <dt class="text-small text-mist">{{ $group['label'] }}</dt>
                            <dd class="text-body text-white lg:mt-1">{{ implode(', ', $group['areas']) }}</dd>
                        </div>
                    @endforeach
                </dl>
            </div>
        </div>
    </x-container>

    <div class="border-t border-white/15">
        <x-container class="grid gap-2 py-6 text-small lg:grid-cols-12 lg:items-center lg:gap-6">
            <p class="lg:col-span-4">&copy; {{ date('Y') }} {{ config('site.name') }}</p>

            <div class="lg:col-span-2">
                <a href="{{ route('privacy') }}"
                   @if (request()->routeIs('privacy')) aria-current="page" @endif
                   class="inline-flex min-h-11 items-center text-mist underline decoration-white/30 underline-offset-4 transition-colors duration-150 hover:text-white hover:decoration-white">
                    Kebijakan Privasi
                </a>
            </div>

            <p class="text-mist lg:col-span-6 lg:text-right">Event organizer untuk perusahaan, instansi, komunitas, universitas, dan sekolah.</p>
        </x-container>
    </div>
</footer>
