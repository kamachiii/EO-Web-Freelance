<?php

namespace App\Filament\Resources\Packages\Schemas;

use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PackageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Identitas paket')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama paket')
                            ->required()
                            ->maxLength(120)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, ?string $state, Set $set): void {
                                if ($operation === 'create') {
                                    $set('slug', Str::slug((string) $state));
                                }
                            }),
                        TextInput::make('slug')
                            ->label('Slug URL')
                            ->required()
                            ->maxLength(160)
                            ->alphaDash()
                            ->unique(ignoreRecord: true)
                            ->helperText('Dipakai di /paket/{slug}.'),
                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->rows(3)
                            ->columnSpanFull()
                            ->helperText('Jelaskan isi paket tanpa menjanjikan yang belum disepakati klien.'),
                        TextInput::make('price_label')
                            ->label('Label harga')
                            ->maxLength(80)
                            ->helperText('Isi teks seperti “Hubungi kami” selama harga resmi belum ada. Jangan mengarang angka.'),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Section::make('Isi paket')
                    ->schema([
                        TagsInput::make('features')
                            ->label('Poin layanan')
                            ->placeholder('Tambah poin, lalu tekan Enter')
                            ->helperText('Satu poin per baris. Contoh: Dokumentasi foto dan video.')
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),

                Section::make('Status')
                    ->schema([
                        Toggle::make('is_featured')
                            ->label('Sorot di beranda')
                            ->default(false),
                        Toggle::make('is_active')
                            ->label('Tampilkan di situs')
                            ->default(false)
                            ->helperText('Paket nonaktif tetap tersimpan tapi tidak tampil di situs.'),
                        TextInput::make('sort_order')
                            ->label('Urutan')
                            ->numeric()
                            ->integer()
                            ->minValue(0)
                            ->default(0)
                            ->required(),
                    ])
                    ->columns(3)
                    ->columnSpanFull(),
            ]);
    }
}
