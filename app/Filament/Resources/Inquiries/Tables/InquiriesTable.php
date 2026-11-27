<?php

namespace App\Filament\Resources\Inquiries\Tables;

use App\Models\Inquiry;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class InquiriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama')
                    ->description(fn (Inquiry $record): string => Str::limit(
                        collect([$record->whatsapp, $record->email])->filter()->implode(' · '),
                        34,
                    ))
                    ->searchable(['name', 'whatsapp', 'email'])
                    ->sortable()
                    ->grow(false)
                    ->width('210px'),
                TextColumn::make('service.name')
                    ->label('Layanan')
                    ->placeholder('—')
                    ->limit(20)
                    ->grow(false)
                    ->width('140px'),
                SelectColumn::make('status')
                    ->label('Status')
                    ->options(Inquiry::STATUSES)
                    ->selectablePlaceholder(false)
                    ->grow(false)
                    ->width('120px'),
                TextColumn::make('created_at')
                    ->label('Masuk')
                    ->since()
                    ->tooltip(fn (Inquiry $record): ?string => $record->created_at?->format('d M Y H:i'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->poll('60s')
            ->stackedOnMobile()
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options(Inquiry::STATUSES),
                SelectFilter::make('service_id')
                    ->label('Layanan')
                    ->relationship('service', 'name'),
            ])
            ->recordActions([
                ViewAction::make()
                    ->iconButton()
                    ->tooltip('Lihat'),
                DeleteAction::make()
                    ->iconButton()
                    ->tooltip('Hapus'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('Belum ada inquiry')
            ->emptyStateDescription('Pesan dari form kontak akan muncul di sini.');
    }
}
