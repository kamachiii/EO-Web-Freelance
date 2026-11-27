<?php

namespace App\Filament\Pages;

use App\Models\SeasonalSegment;
use BackedEnum;
use Carbon\CarbonImmutable;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Livewire\Attributes\Url;
use UnitEnum;

class SeasonalCalendar extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalendarDays;

    protected static ?string $navigationLabel = 'Kalender Musiman';

    protected static string|UnitEnum|null $navigationGroup = 'Konten';

    protected static ?int $navigationSort = 4;

    protected static ?string $title = 'Kalender Musiman';

    protected string $view = 'filament.pages.seasonal-calendar';

    #[Url(as: 'bulan', except: '')]
    public string $month = '';

    public function mount(): void
    {
        $this->month = $this->normalizeMonth($this->month) ?? now()->format('Y-m');
    }

    public function previousMonth(): void
    {
        $this->month = $this->currentMonth()->subMonthNoOverflow()->format('Y-m');
    }

    public function nextMonth(): void
    {
        $this->month = $this->currentMonth()->addMonthNoOverflow()->format('Y-m');
    }

    public function goToToday(): void
    {
        $this->month = now()->format('Y-m');
    }

    protected function getViewData(): array
    {
        $month = $this->currentMonth();
        $monthStart = $month->startOfMonth();
        $monthEnd = $month->endOfMonth();
        $gridStart = $monthStart->startOfWeek(CarbonImmutable::MONDAY);
        $gridEnd = $monthEnd->endOfWeek(CarbonImmutable::SUNDAY);

        $segments = SeasonalSegment::query()
            ->overlapping($gridStart, $gridEnd)
            ->orderBy('starts_at')
            ->get();

        $monthSegments = $segments
            ->filter(fn (SeasonalSegment $segment): bool => $segment->starts_at?->lte($monthEnd) ?? true)
            ->filter(fn (SeasonalSegment $segment): bool => $segment->ends_at?->gte($monthStart) ?? true)
            ->values();

        $unscheduled = SeasonalSegment::query()
            ->whereNull('starts_at')
            ->whereNull('ends_at')
            ->orderBy('sort_order')
            ->get();

        $days = [];

        for ($date = $gridStart; $date->lte($gridEnd); $date = $date->addDay()) {
            $days[] = [
                'date' => $date,
                'in_month' => $date->month === $monthStart->month,
                'is_today' => $date->isToday(),
                'segments' => $segments
                    ->filter(fn (SeasonalSegment $segment): bool => $this->coversDay($segment, $date))
                    ->values(),
            ];
        }

        return [
            'monthLabel' => $monthStart->locale('id')->translatedFormat('F Y'),
            'days' => $days,
            'weekdays' => ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
            'monthSegments' => $monthSegments,
            'unscheduled' => $unscheduled,
            'nextSegments' => SeasonalSegment::query()
                ->whereNotNull('starts_at')
                ->whereDate('starts_at', '>', $monthEnd)
                ->orderBy('starts_at')
                ->limit(4)
                ->get(),
            'stats' => [
                'active' => SeasonalSegment::query()->where('is_active', true)->count(),
                'scheduled' => SeasonalSegment::query()
                    ->where('is_active', true)
                    ->whereDate('starts_at', '>', now())
                    ->count(),
                'unscheduled' => SeasonalSegment::query()
                    ->whereNull('starts_at')
                    ->whereNull('ends_at')
                    ->count(),
            ],
        ];
    }

    private function currentMonth(): CarbonImmutable
    {
        return CarbonImmutable::createFromFormat('!Y-m', $this->normalizeMonth($this->month) ?? now()->format('Y-m'));
    }

    private function normalizeMonth(?string $month): ?string
    {
        if (! is_string($month) || ! preg_match('/^(\d{4})-(0[1-9]|1[0-2])$/', $month, $matches)) {
            return null;
        }

        return $matches[1].'-'.$matches[2];
    }

    private function coversDay(SeasonalSegment $segment, CarbonImmutable $date): bool
    {
        $day = $date->toDateString();

        if ($segment->starts_at && $segment->starts_at->toDateString() > $day) {
            return false;
        }

        if ($segment->ends_at && $segment->ends_at->toDateString() < $day) {
            return false;
        }

        return true;
    }
}
