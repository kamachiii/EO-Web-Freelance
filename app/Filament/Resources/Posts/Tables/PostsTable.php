<?php

namespace App\Filament\Resources\Posts\Tables;

use App\Models\Post;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('cover_image')
                    ->label('Sampul')
                    ->disk('media')
                    ->square()
                    ->size(44)
                    ->visible(fn (): bool => Post::query()->whereNotNull('cover_image')->exists()),
                TextColumn::make('title')
                    ->label('Artikel')
                    ->description(fn (Post $record): ?string => $record->excerpt ? str($record->excerpt)->limit(60) : null)
                    ->searchable()
                    ->sortable(),
                TextColumn::make('published_at')
                    ->label('Terbit')
                    ->dateTime('d M Y H:i')
                    ->placeholder('Belum dijadwalkan')
                    ->visibleFrom('md')
                    ->sortable(),
                ToggleColumn::make('is_published')
                    ->label('Terbit'),
                TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('published_at', 'desc')
            ->stackedOnMobile()
            ->filters([
                TernaryFilter::make('is_published')
                    ->label('Status terbit')
                    ->placeholder('Semua artikel')
                    ->trueLabel('Sudah terbit')
                    ->falseLabel('Masih draf'),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('Belum ada artikel')
            ->emptyStateDescription('Tulis artikel pertama untuk membantu calon klien menemukan layanan lewat pencarian.')
            ->emptyStateIcon(Heroicon::OutlinedNewspaper);
    }
}
