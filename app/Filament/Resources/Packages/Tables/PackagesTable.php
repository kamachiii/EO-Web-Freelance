<?php

namespace App\Filament\Resources\Packages\Tables;

use App\Models\Package;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class PackagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Paket')
                    ->description(fn (Package $record): string => $record->price_label ?: 'Harga belum diisi')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('features')
                    ->label('Poin layanan')
                    ->state(fn (Package $record): string => count($record->features ?? []).' poin')
                    ->badge()
                    ->color('gray')
                    ->visibleFrom('sm'),
                ToggleColumn::make('is_featured')
                    ->label('Sorot'),
                ToggleColumn::make('is_active')
                    ->label('Tampil'),
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
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->stackedOnMobile()
            ->filters([
                TernaryFilter::make('is_active')
                    ->label('Tampil di situs')
                    ->placeholder('Semua paket')
                    ->trueLabel('Tampil')
                    ->falseLabel('Disembunyikan'),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('Belum ada paket')
            ->emptyStateDescription('Susun paket setelah ruang lingkup dan harga disepakati bersama klien.')
            ->emptyStateIcon(Heroicon::OutlinedCube);
    }
}
