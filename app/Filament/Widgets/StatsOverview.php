<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Banners\BannerResource;
use App\Filament\Resources\Inquiries\InquiryResource;
use App\Filament\Resources\Services\ServiceResource;
use App\Models\Banner;
use App\Models\Inquiry;
use App\Models\Service;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $newInquiries = Inquiry::where('status', Inquiry::STATUS_NEW)->count();
        $totalInquiries = Inquiry::count();
        $activeServices = Service::where('is_active', true)->count();
        $totalServices = Service::count();
        $activeBanners = Banner::where('is_active', true)->count();

        return [
            Stat::make('Inquiry baru', $newInquiries)
                ->description($totalInquiries.' inquiry total')
                ->descriptionIcon(Heroicon::OutlinedInbox)
                ->color($newInquiries > 0 ? 'warning' : 'success')
                ->url(InquiryResource::getUrl('index')),
            Stat::make('Layanan aktif', $activeServices)
                ->description('Dari '.$totalServices.' layanan')
                ->descriptionIcon(Heroicon::OutlinedBriefcase)
                ->url(ServiceResource::getUrl('index')),
            Stat::make('Banner aktif', $activeBanners)
                ->description('Banner pertama yang tampil di beranda')
                ->descriptionIcon(Heroicon::OutlinedPhoto)
                ->url(BannerResource::getUrl('index')),
        ];
    }
}
