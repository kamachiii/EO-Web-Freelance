<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama layanan')
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
                    ->helperText('Dipakai di /layanan/{slug}. Ubah hanya jika perlu karena URL lama bisa rusak.'),
                Textarea::make('excerpt')
                    ->label('Ringkasan')
                    ->required()
                    ->rows(3)
                    ->maxLength(300)
                    ->columnSpanFull()
                    ->helperText('Tampil di daftar layanan dan ringkasan beranda.'),
                Textarea::make('description')
                    ->label('Deskripsi lengkap')
                    ->rows(8)
                    ->columnSpanFull()
                    ->helperText('Tampil di halaman detail layanan.'),
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
                    ->helperText('Layanan nonaktif tidak muncul di situs publik.'),
            ])
            ->columns(2);
    }
}
