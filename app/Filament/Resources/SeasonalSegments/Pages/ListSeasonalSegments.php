<?php

namespace App\Filament\Resources\SeasonalSegments\Pages;

use App\Filament\Pages\SeasonalCalendar;
use App\Filament\Resources\SeasonalSegments\SeasonalSegmentResource;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\Width;

class ListSeasonalSegments extends ListRecords
{
    protected static string $resource = SeasonalSegmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('calendar')
                ->label('Kalender')
                ->icon('heroicon-o-calendar-days')
                ->color('gray')
                ->url(SeasonalCalendar::getUrl()),
            CreateAction::make()
                ->label('Tambah musim')
                ->modal()
                ->modalWidth(Width::FiveExtraLarge)
                ->createAnother(false),
        ];
    }
}
