<?php

namespace App\Filament\Resources\Banners\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class BannerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Foto hero')
                    ->description('Foto ini tampil di beranda. Gunakan foto asli klien setelah tersedia.')
                    ->schema([
                        FileUpload::make('image_desktop')
                            ->label('Foto desktop')
                            ->image()
                            ->disk('hero')
                            ->visibility('public')
                            ->acceptedFileTypes(['image/webp', 'image/jpeg', 'image/png'])
                            ->maxSize(4096)
                            ->helperText('Rasio 3:2, minimal 1200x800 px. WebP/JPEG/PNG, maksimal 4 MB.'),
                        FileUpload::make('image_mobile')
                            ->label('Foto mobile')
                            ->image()
                            ->disk('hero')
                            ->visibility('public')
                            ->acceptedFileTypes(['image/webp', 'image/jpeg', 'image/png'])
                            ->maxSize(4096)
                            ->helperText('Rasio 3:4 atau 4:5, minimal 900x1200 px. WebP/JPEG/PNG, maksimal 4 MB.'),
                        TextInput::make('image_alt')
                            ->label('Teks alternatif foto')
                            ->maxLength(255)
                            ->required(fn (Get $get): bool => filled($get('image_desktop')) || filled($get('image_mobile')))
                            ->columnSpanFull()
                            ->helperText('Jelaskan isi foto untuk pembaca layar dan mesin pencari.'),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Section::make('Teks dan status')
                    ->description('Kosongkan teks jika ingin memakai teks bawaan situs.')
                    ->schema([
                        TextInput::make('seasonal_label')
                            ->label('Label musim')
                            ->maxLength(160)
                            ->helperText('Contoh: Musim Study Tour Sekolah. Kosongkan jika bukan kampanye musiman.'),
                        TextInput::make('sort_order')
                            ->label('Urutan')
                            ->numeric()
                            ->integer()
                            ->minValue(0)
                            ->default(0)
                            ->required(),
                        Textarea::make('subheadline')
                            ->label('Sub-headline')
                            ->rows(2)
                            ->maxLength(300)
                            ->columnSpanFull()
                            ->helperText('Menggantikan sub-headline bawaan di hero. Kosongkan untuk memakai teks bawaan.'),
                        Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true)
                            ->helperText('Hanya banner aktif dengan urutan terkecil yang tampil di beranda.'),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }
}
