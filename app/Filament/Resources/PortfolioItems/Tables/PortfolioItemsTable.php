<?php

namespace App\Filament\Resources\PortfolioItems\Tables;

use App\Models\PortfolioItem;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class PortfolioItemsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Foto')
                    ->disk('media')
                    ->square()
                    ->size(44)
                    ->visible(fn (): bool => PortfolioItem::query()->whereNotNull('image')->exists()),
                TextColumn::make('title')
                    ->label('Portofolio')
                    ->description(fn (PortfolioItem $record): ?string => $record->client_name)
                    ->searchable(['title', 'client_name'])
                    ->sortable(),
                TextColumn::make('event_date')
                    ->label('Tanggal event')
                    ->date('d M Y')
                    ->placeholder('Belum diisi')
                    ->visibleFrom('md')
                    ->sortable(),
                TextColumn::make('location')
                    ->label('Lokasi')
                    ->placeholder('Belum diisi')
                    ->searchable()
                    ->visibleFrom('lg')
                    ->toggleable(),
                ToggleColumn::make('is_featured')
                    ->label('Sorot')
                    ->visibleFrom('md'),
                ToggleColumn::make('is_active')
                    ->label('Tampil'),
                TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->stackedOnMobile()
            ->filters([
                TernaryFilter::make('is_active')
                    ->label('Tampil di situs')
                    ->placeholder('Semua portofolio')
                    ->trueLabel('Tampil')
                    ->falseLabel('Disembunyikan'),
            ])
            ->recordUrl(null)
            ->recordActions([
                EditAction::make()
                    ->modal()
                    ->modalWidth(Width::FiveExtraLarge),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('Belum ada portofolio')
            ->emptyStateDescription('Tambahkan event pertama setelah foto dan izin klien tersedia.')
            ->emptyStateIcon(Heroicon::OutlinedSquares2x2);
    }
}
