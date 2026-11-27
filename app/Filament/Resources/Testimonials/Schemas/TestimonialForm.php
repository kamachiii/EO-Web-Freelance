<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Sumber testimoni')
                    ->description('Hanya testimoni asli dari klien yang boleh diaktifkan.')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama')
                            ->required()
                            ->maxLength(120),
                        TextInput::make('role')
                            ->label('Jabatan dan instansi')
                            ->maxLength(160)
                            ->helperText('Contoh: Ketua Panitia, PT Contoh Nusantara.'),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Section::make('Isi testimoni')
                    ->schema([
                        Textarea::make('quote')
                            ->label('Kutipan')
                            ->required()
                            ->rows(4)
                            ->maxLength(1000)
                            ->columnSpanFull()
                            ->helperText('Salin apa adanya dari klien. Jangan mengarang atau memperhalus tanpa izin.'),
                        Select::make('rating')
                            ->label('Penilaian')
                            ->options([
                                5 => '5 — Sangat puas',
                                4 => '4 — Puas',
                                3 => '3 — Cukup',
                                2 => '2 — Kurang',
                                1 => '1 — Tidak puas',
                            ])
                            ->placeholder('Belum dinilai')
                            ->helperText('Kosongkan jika klien tidak memberi penilaian.'),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Section::make('Status')
                    ->schema([
                        Toggle::make('is_featured')
                            ->label('Sorot di beranda')
                            ->default(false),
                        Toggle::make('is_active')
                            ->label('Tampilkan di situs')
                            ->default(false)
                            ->helperText('Aktifkan hanya setelah klien menyetujui teks dan namanya.'),
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
