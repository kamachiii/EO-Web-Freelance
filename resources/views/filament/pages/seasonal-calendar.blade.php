<x-filament-panels::page>
    <div class="admin-page admin-calendar-page">
        <header class="admin-calendar-hero">
            <div>
                <p class="admin-eyebrow">Perencanaan musim</p>
                <h2 class="admin-display">{{ $monthLabel }}</h2>
                <p class="admin-muted">
                    Atur kapan setiap musim berjalan. Klik salah satu musim untuk membuka detailnya,
                    atau tambah musim baru dengan rentang tanggal dari kalender.
                </p>
            </div>

            <div class="admin-calendar-actions">
                <x-filament::icon-button
                    icon="heroicon-o-chevron-left"
                    color="gray"
                    tooltip="Bulan sebelumnya"
                    aria-label="Bulan sebelumnya"
                    wire:click="previousMonth"
                />
                <x-filament::button color="gray" size="sm" wire:click="goToToday">
                    Hari ini
                </x-filament::button>
                <x-filament::icon-button
                    icon="heroicon-o-chevron-right"
                    color="gray"
                    tooltip="Bulan berikutnya"
                    aria-label="Bulan berikutnya"
                    wire:click="nextMonth"
                />
                <x-filament::button
                    tag="a"
                    href="{{ \App\Filament\Resources\SeasonalSegments\SeasonalSegmentResource::getUrl('create') }}"
                    icon="heroicon-o-plus"
                    size="sm"
                >
                    Tambah musim
                </x-filament::button>
            </div>
        </header>

        <div class="admin-stat-grid admin-stat-grid-3">
            <div class="admin-stat-card">
                <span class="admin-stat-label">Musim aktif</span>
                <strong class="admin-stat-value">{{ $stats['active'] }}</strong>
                <span class="admin-stat-note">Siap dipakai di situs publik</span>
            </div>
            <div class="admin-stat-card">
                <span class="admin-stat-label">Terjadwal</span>
                <strong class="admin-stat-value">{{ $stats['scheduled'] }}</strong>
                <span class="admin-stat-note">Aktif dan belum dimulai</span>
            </div>
            <div class="admin-stat-card">
                <span class="admin-stat-label">Tanpa tanggal</span>
                <strong class="admin-stat-value">{{ $stats['unscheduled'] }}</strong>
                <span class="admin-stat-note">Perlu dilengkapi</span>
            </div>
        </div>

        <div class="admin-calendar-layout">
            <section class="admin-calendar-board" aria-label="Kalender musiman {{ $monthLabel }}">
                <div class="admin-calendar-weekdays" aria-hidden="true">
                    @foreach ($weekdays as $weekday)
                        <span>{{ $weekday }}</span>
                    @endforeach
                </div>

                <div class="admin-calendar-grid">
                    @foreach ($days as $day)
                        <div @class([
                            'admin-calendar-day',
                            'is-outside' => ! $day['in_month'],
                            'is-today' => $day['is_today'],
                        ])>
                            <span class="admin-calendar-date">{{ $day['date']->day }}</span>

                            <div class="admin-calendar-chips">
                                @foreach ($day['segments']->take(2) as $segment)
                                    @php
                                        $chipClass = match ($segment->status()) {
                                            'active' => 'is-active',
                                            'scheduled' => 'is-scheduled',
                                            'finished' => 'is-finished',
                                            default => 'is-inactive',
                                        };
                                    @endphp
                                    <a
                                        href="{{ \App\Filament\Resources\SeasonalSegments\SeasonalSegmentResource::getUrl('edit', ['record' => $segment]) }}"
                                        class="admin-calendar-chip {{ $chipClass }}"
                                        title="{{ $segment->label }} · {{ $segment->periodLabel() }}"
                                    >
                                        {{ \Illuminate\Support\Str::limit($segment->label, 18) }}
                                    </a>
                                @endforeach

                                @if ($day['segments']->count() > 2)
                                    <span class="admin-calendar-more">+{{ $day['segments']->count() - 2 }} lagi</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            <aside class="admin-calendar-side">
                <section class="admin-panel">
                    <div class="admin-panel-heading">
                        <div>
                            <p class="admin-eyebrow">Bulan ini</p>
                            <h3>Musim berjalan</h3>
                        </div>
                        <span class="admin-count">{{ $monthSegments->count() }}</span>
                    </div>

                    @forelse ($monthSegments as $segment)
                        <a
                            href="{{ \App\Filament\Resources\SeasonalSegments\SeasonalSegmentResource::getUrl('edit', ['record' => $segment]) }}"
                            class="admin-season-row"
                        >
                            <span class="admin-season-dot is-{{ $segment->status() }}"></span>
                            <span class="min-w-0 flex-1">
                                <span class="admin-season-name">{{ $segment->label }}</span>
                                <span class="admin-season-date">{{ $segment->periodLabel() }}</span>
                            </span>
                            <x-filament::badge :color="$segment->statusColor()" size="sm">
                                {{ $segment->statusLabel() }}
                            </x-filament::badge>
                        </a>
                    @empty
                        <p class="admin-empty">Belum ada musim di bulan ini.</p>
                    @endforelse
                </section>

                <section class="admin-panel">
                    <div class="admin-panel-heading">
                        <div>
                            <p class="admin-eyebrow">Berikutnya</p>
                            <h3>Musim mendatang</h3>
                        </div>
                    </div>

                    @forelse ($nextSegments as $segment)
                        <a
                            href="{{ \App\Filament\Resources\SeasonalSegments\SeasonalSegmentResource::getUrl('edit', ['record' => $segment]) }}"
                            class="admin-season-row"
                        >
                            <span class="admin-season-date-badge">{{ $segment->starts_at?->translatedFormat('d M') }}</span>
                            <span class="min-w-0 flex-1">
                                <span class="admin-season-name">{{ $segment->label }}</span>
                                <span class="admin-season-date">{{ $segment->periodLabel() }}</span>
                            </span>
                        </a>
                    @empty
                        <p class="admin-empty">Belum ada musim berikutnya.</p>
                    @endforelse
                </section>

                @if ($unscheduled->isNotEmpty())
                    <section class="admin-panel">
                        <div class="admin-panel-heading">
                            <div>
                                <p class="admin-eyebrow">Perlu tindakan</p>
                                <h3>Belum dijadwalkan</h3>
                            </div>
                        </div>

                        @foreach ($unscheduled as $segment)
                            <a
                                href="{{ \App\Filament\Resources\SeasonalSegments\SeasonalSegmentResource::getUrl('edit', ['record' => $segment]) }}"
                                class="admin-season-row"
                            >
                                <span class="admin-season-dot is-inactive"></span>
                                <span class="min-w-0 flex-1">
                                    <span class="admin-season-name">{{ $segment->label }}</span>
                                    <span class="admin-season-date">Tambahkan rentang tanggal</span>
                                </span>
                                <x-filament::icon icon="heroicon-o-arrow-right" class="admin-season-arrow" />
                            </a>
                        @endforeach
                    </section>
                @endif
            </aside>
        </div>
    </div>
</x-filament-panels::page>
