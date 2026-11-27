<x-filament-panels::page>
    <div class="admin-page admin-dashboard">
        <section class="admin-hero">
            <div class="admin-hero-main">
                <p class="admin-eyebrow is-light">Dasbor</p>
                <h2 class="admin-hero-title">{{ $greeting }}, {{ auth()->user()?->name }}</h2>
                <p class="admin-hero-text">
                    Semua yang perlu Anda kelola ada di sini. Mulai dari pesan masuk, layanan,
                    banner beranda, sampai jadwal musim berikutnya.
                </p>

                <div class="admin-hero-actions">
                    <a href="{{ $urls['site'] }}" target="_blank" rel="noopener" class="admin-hero-btn is-ghost">
                        <x-filament::icon icon="heroicon-o-arrow-top-right-on-square" class="h-4 w-4" />
                        Lihat situs
                    </a>
                    <a href="{{ $urls['create_banner'] }}" class="admin-hero-btn is-signal">
                        <x-filament::icon icon="heroicon-o-plus" class="h-4 w-4" />
                        Banner baru
                    </a>
                </div>
            </div>

            <div class="admin-hero-meta">
                <span class="admin-hero-date">{{ $todayLabel }}</span>
                <span class="admin-hero-pill">
                    <span class="admin-live-dot"></span>
                    Panel aktif
                </span>
            </div>
        </section>

        <div class="admin-stat-grid">
            <a href="{{ $urls['inquiries'] }}" class="admin-kpi">
                <span class="admin-kpi-icon is-signal">
                    <x-filament::icon icon="heroicon-o-inbox" class="h-5 w-5" />
                </span>
                <span class="admin-kpi-body">
                    <span class="admin-kpi-label">Inquiry baru</span>
                    <strong class="admin-kpi-value">{{ $stats['new_inquiries'] }}</strong>
                    <span class="admin-kpi-note">dari {{ $stats['total_inquiries'] }} total masuk</span>
                </span>
                <x-filament::icon icon="heroicon-o-arrow-up-right" class="admin-kpi-arrow" />
            </a>

            <a href="{{ $urls['services'] }}" class="admin-kpi">
                <span class="admin-kpi-icon is-navy">
                    <x-filament::icon icon="heroicon-o-briefcase" class="h-5 w-5" />
                </span>
                <span class="admin-kpi-body">
                    <span class="admin-kpi-label">Layanan aktif</span>
                    <strong class="admin-kpi-value">{{ $stats['active_services'] }}</strong>
                    <span class="admin-kpi-note">dari {{ $stats['total_services'] }} layanan</span>
                </span>
                <x-filament::icon icon="heroicon-o-arrow-up-right" class="admin-kpi-arrow" />
            </a>

            <a href="{{ $urls['banners'] }}" class="admin-kpi">
                <span class="admin-kpi-icon is-forest">
                    <x-filament::icon icon="heroicon-o-photo" class="h-5 w-5" />
                </span>
                <span class="admin-kpi-body">
                    <span class="admin-kpi-label">Banner aktif</span>
                    <strong class="admin-kpi-value">{{ $stats['active_banners'] }}</strong>
                    <span class="admin-kpi-note">tampil di beranda</span>
                </span>
                <x-filament::icon icon="heroicon-o-arrow-up-right" class="admin-kpi-arrow" />
            </a>

            <a href="{{ $urls['seasons'] }}" class="admin-kpi">
                <span class="admin-kpi-icon is-mist">
                    <x-filament::icon icon="heroicon-o-calendar-days" class="h-5 w-5" />
                </span>
                <span class="admin-kpi-body">
                    <span class="admin-kpi-label">Musim aktif</span>
                    <strong class="admin-kpi-value">{{ $stats['active_seasons'] }}</strong>
                    <span class="admin-kpi-note">siap dipakai di situs</span>
                </span>
                <x-filament::icon icon="heroicon-o-arrow-up-right" class="admin-kpi-arrow" />
            </a>
        </div>

        <div class="admin-dashboard-grid">
            <section class="admin-panel admin-panel-wide">
                <div class="admin-panel-heading">
                    <div>
                        <p class="admin-eyebrow">Terbaru</p>
                        <h3>Inquiry masuk</h3>
                    </div>
                    <a href="{{ $urls['inquiries'] }}" class="admin-link">Lihat semua</a>
                </div>

                @forelse ($recentInquiries as $inquiry)
                    <a
                        href="{{ \App\Filament\Resources\Inquiries\InquiryResource::getUrl('view', ['record' => $inquiry]) }}"
                        class="admin-inquiry-row"
                    >
                        <span class="admin-avatar">
                            {{ \Illuminate\Support\Str::of($inquiry->name)->substr(0, 1)->upper() }}
                        </span>
                        <span class="min-w-0 flex-1">
                            <span class="admin-inquiry-name">{{ $inquiry->name }}</span>
                            <span class="admin-inquiry-meta">
                                {{ $inquiry->service?->name ?? 'Tanpa layanan' }}
                                <span aria-hidden="true">·</span>
                                {{ $inquiry->created_at->diffForHumans() }}
                            </span>
                        </span>
                        <x-filament::badge :color="\App\Models\Inquiry::statusColor($inquiry->status)" size="sm">
                            {{ \App\Models\Inquiry::STATUSES[$inquiry->status] ?? $inquiry->status }}
                        </x-filament::badge>
                    </a>
                @empty
                    <p class="admin-empty">Belum ada inquiry masuk.</p>
                @endforelse
            </section>

            <div class="admin-dashboard-side">
                <section class="admin-panel">
                    <div class="admin-panel-heading">
                        <div>
                            <p class="admin-eyebrow">Jadwal</p>
                            <h3>Musim terdekat</h3>
                        </div>
                        <a href="{{ $urls['calendar'] }}" class="admin-link">Kalender</a>
                    </div>

                    @forelse ($upcomingSeasons as $season)
                        <a
                            href="{{ \App\Filament\Resources\SeasonalSegments\SeasonalSegmentResource::getUrl('edit', ['record' => $season]) }}"
                            class="admin-season-card"
                        >
                            <span class="admin-season-card-date">
                                <strong>{{ $season->starts_at?->translatedFormat('d') }}</strong>
                                <span>{{ $season->starts_at?->translatedFormat('M') }}</span>
                            </span>
                            <span class="min-w-0 flex-1">
                                <span class="admin-season-name">{{ $season->label }}</span>
                                <span class="admin-season-date">{{ $season->periodLabel() }}</span>
                            </span>
                            <x-filament::badge :color="$season->statusColor()" size="sm">
                                {{ $season->statusLabel() }}
                            </x-filament::badge>
                        </a>
                    @empty
                        <p class="admin-empty">Belum ada musim yang dijadwalkan.</p>
                    @endforelse
                </section>

                <section class="admin-panel">
                    <div class="admin-panel-heading">
                        <div>
                            <p class="admin-eyebrow">Pintasan</p>
                            <h3>Aksi cepat</h3>
                        </div>
                    </div>

                    <div class="admin-quick-actions">
                        <a href="{{ $urls['create_service'] }}" class="admin-quick-action">
                            <x-filament::icon icon="heroicon-o-briefcase" class="h-4 w-4" />
                            Tambah layanan
                        </a>
                        <a href="{{ $urls['create_season'] }}" class="admin-quick-action">
                            <x-filament::icon icon="heroicon-o-calendar-days" class="h-4 w-4" />
                            Atur musim
                        </a>
                        <a href="{{ $urls['create_portfolio'] }}" class="admin-quick-action">
                            <x-filament::icon icon="heroicon-o-squares-2x2" class="h-4 w-4" />
                            Tambah portofolio
                        </a>
                        <a href="{{ $urls['create_post'] }}" class="admin-quick-action">
                            <x-filament::icon icon="heroicon-o-newspaper" class="h-4 w-4" />
                            Tulis artikel
                        </a>
                        <a href="{{ $urls['inquiries'] }}" class="admin-quick-action">
                            <x-filament::icon icon="heroicon-o-inbox" class="h-4 w-4" />
                            Buka inquiry
                        </a>
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-filament-panels::page>
