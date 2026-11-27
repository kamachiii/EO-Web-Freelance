<?php

namespace App\Filament\Pages;

use App\Filament\Resources\Banners\BannerResource;
use App\Filament\Resources\Inquiries\InquiryResource;
use App\Filament\Resources\PortfolioItems\PortfolioItemResource;
use App\Filament\Resources\Posts\PostResource;
use App\Filament\Resources\SeasonalSegments\SeasonalSegmentResource;
use App\Filament\Resources\Services\ServiceResource;
use App\Models\Banner;
use App\Models\Inquiry;
use App\Models\SeasonalSegment;
use App\Models\Service;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationLabel = 'Dasbor';

    protected static ?string $title = 'Dasbor';

    protected string $view = 'filament.pages.dashboard';

    protected function getViewData(): array
    {
        $hour = (int) now()->format('G');

        return [
            'greeting' => match (true) {
                $hour < 11 => 'Selamat pagi',
                $hour < 15 => 'Selamat siang',
                $hour < 19 => 'Selamat sore',
                default => 'Selamat malam',
            },
            'todayLabel' => now()->locale('id')->translatedFormat('l, d F Y'),
            'stats' => [
                'new_inquiries' => Inquiry::query()->where('status', Inquiry::STATUS_NEW)->count(),
                'total_inquiries' => Inquiry::query()->count(),
                'active_services' => Service::query()->where('is_active', true)->count(),
                'total_services' => Service::query()->count(),
                'active_banners' => Banner::query()->where('is_active', true)->count(),
                'active_seasons' => SeasonalSegment::query()->where('is_active', true)->count(),
            ],
            'recentInquiries' => Inquiry::query()
                ->latest()
                ->limit(5)
                ->get(),
            'upcomingSeasons' => SeasonalSegment::query()
                ->whereNotNull('starts_at')
                ->orderBy('starts_at')
                ->limit(3)
                ->get(),
            'urls' => [
                'inquiries' => InquiryResource::getUrl('index'),
                'services' => ServiceResource::getUrl('index'),
                'banners' => BannerResource::getUrl('index'),
                'seasons' => SeasonalSegmentResource::getUrl('index'),
                'calendar' => SeasonalCalendar::getUrl(),
                'create_banner' => BannerResource::getUrl('create'),
                'create_service' => ServiceResource::getUrl('create'),
                'create_season' => SeasonalSegmentResource::getUrl('create'),
                'create_portfolio' => PortfolioItemResource::getUrl('create'),
                'create_post' => PostResource::getUrl('create'),
                'site' => url('/'),
            ],
        ];
    }
}
