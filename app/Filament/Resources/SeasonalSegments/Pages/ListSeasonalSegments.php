<?php

namespace App\Filament\Resources\SeasonalSegments\Pages;

use App\Filament\Resources\SeasonalSegments\SeasonalSegmentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSeasonalSegments extends ListRecords
{
    protected static string $resource = SeasonalSegmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
