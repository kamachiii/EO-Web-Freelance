<?php

namespace App\Filament\Resources\SeasonalSegments\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SeasonalSegmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama segmen')
                    ->required()
                    ->maxLength(120)
                    ->helperText('Contoh: Sekolah, Kampus, Perusahaan.'),
                TextInput::make('label')
                    ->label('Label musim')
                    ->required()
                    ->maxLength(160)
                    ->helperText('Hanya tampil setelah label disetujui klien.'),
                TextInput::make('period')
                    ->label('Periode')
                    ->required()
                    ->maxLength(120)
                    ->helperText('Contoh: Mei–Juli dan September–Oktober.'),
                Textarea::make('description')
                    ->label('Deskripsi')
                    ->rows(4)
                    ->columnSpanFull(),
                TextInput::make('sort_order')
                    ->label('Urutan')
                    ->numeric()
                    ->integer()
                    ->minValue(0)
                    ->default(0)
                    ->required(),
                Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true)
                    ->helperText('Segmen nonaktif tidak dipakai kampanye musiman.'),
            ])
            ->columns(2);
    }
}
