<?php

namespace App\Filament\Resources\SeasonalSegments\Tables;

use App\Models\SeasonalSegment;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class SeasonalSegmentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Musim')
                    ->description(fn (SeasonalSegment $record): string => $record->label)
                    ->searchable(['name', 'label'])
                    ->sortable(),
                TextColumn::make('period')
                    ->label('Rentang tanggal')
                    ->state(fn (SeasonalSegment $record): string => $record->periodLabel())
                    ->icon(Heroicon::OutlinedCalendarDays)
                    ->color(fn (SeasonalSegment $record): string => $record->dateRangeLabel() ? 'gray' : 'warning')
                    ->sortable(),
                TextColumn::make('status_label')
                    ->label('Status')
                    ->state(fn (SeasonalSegment $record): string => $record->statusLabel())
                    ->badge()
                    ->color(fn (SeasonalSegment $record): string => $record->statusColor()),
                ToggleColumn::make('is_active')
                    ->label('Aktif'),
                TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('starts_at')
            ->reorderable('sort_order')
            ->stackedOnMobile()
            ->recordUrl(null)
            ->recordActions([
                Action::make('preview')
                    ->label('Pratinjau')
                    ->icon(Heroicon::OutlinedEye)
                    ->url(fn (SeasonalSegment $record): string => route('home', ['preview' => $record->id]))
                    ->openUrlInNewTab(),
                EditAction::make()
                    ->modal()
                    ->modalWidth(Width::FiveExtraLarge),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('Belum ada musim')
            ->emptyStateDescription('Tambahkan musim pertama, lalu atur rentang tanggalnya lewat kalender.')
            ->emptyStateIcon(Heroicon::OutlinedCalendarDays);
    }
}
