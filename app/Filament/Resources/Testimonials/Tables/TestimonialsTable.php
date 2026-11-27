<?php

namespace App\Filament\Resources\Testimonials\Tables;

use App\Models\Testimonial;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class TestimonialsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama')
                    ->description(fn (Testimonial $record): ?string => $record->role)
                    ->searchable(['name', 'role'])
                    ->sortable(),
                TextColumn::make('quote')
                    ->label('Kutipan')
                    ->limit(70)
                    ->wrap()
                    ->visibleFrom('lg'),
                TextColumn::make('rating')
                    ->label('Nilai')
                    ->placeholder('—')
                    ->formatStateUsing(fn (?int $state): string => $state ? $state.'/5' : '—')
                    ->badge()
                    ->color(fn (?int $state): string => match (true) {
                        $state === null => 'gray',
                        $state >= 4 => 'success',
                        $state === 3 => 'warning',
                        default => 'danger',
                    }),
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
                    ->placeholder('Semua testimoni')
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
            ->emptyStateHeading('Belum ada testimoni')
            ->emptyStateDescription('Tambahkan kutipan asli dari klien setelah mereka menyetujui namanya tampil.')
            ->emptyStateIcon(Heroicon::OutlinedChatBubbleLeftRight);
    }
}
