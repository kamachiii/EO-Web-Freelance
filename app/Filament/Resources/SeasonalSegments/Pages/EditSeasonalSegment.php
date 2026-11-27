<?php

namespace App\Filament\Resources\SeasonalSegments\Pages;

use App\Filament\Resources\SeasonalSegments\SeasonalSegmentResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSeasonalSegment extends EditRecord
{
    protected static string $resource = SeasonalSegmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
