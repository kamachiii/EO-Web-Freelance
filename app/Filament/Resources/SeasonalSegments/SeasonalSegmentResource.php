<?php

namespace App\Filament\Resources\SeasonalSegments;

use App\Filament\Resources\SeasonalSegments\Pages\CreateSeasonalSegment;
use App\Filament\Resources\SeasonalSegments\Pages\EditSeasonalSegment;
use App\Filament\Resources\SeasonalSegments\Pages\ListSeasonalSegments;
use App\Filament\Resources\SeasonalSegments\Schemas\SeasonalSegmentForm;
use App\Filament\Resources\SeasonalSegments\Tables\SeasonalSegmentsTable;
use App\Models\SeasonalSegment;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class SeasonalSegmentResource extends Resource
{
    protected static ?string $model = SeasonalSegment::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalendarDays;

    protected static ?string $navigationLabel = 'Segmen Musiman';

    protected static string|UnitEnum|null $navigationGroup = 'Konten';

    protected static ?int $navigationSort = 3;

    protected static ?string $modelLabel = 'Segmen musiman';

    protected static ?string $pluralModelLabel = 'Segmen musiman';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return SeasonalSegmentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SeasonalSegmentsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSeasonalSegments::route('/'),
            'create' => CreateSeasonalSegment::route('/create'),
            'edit' => EditSeasonalSegment::route('/{record}/edit'),
        ];
    }
}
