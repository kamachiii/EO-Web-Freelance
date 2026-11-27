<?php

namespace App\Filament\Resources\PortfolioItems\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PortfolioItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi event')
                    ->description('Data ini dipakai di galeri portofolio. Kosongkan bagian yang belum diketahui.')
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul')
                            ->required()
                            ->maxLength(160)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, ?string $state, Set $set): void {
                                if ($operation === 'create') {
                                    $set('slug', Str::slug((string) $state));
                                }
                            })
                            ->helperText('Contoh: Gathering Tahunan Perusahaan.'),
                        TextInput::make('slug')
                            ->label('Slug URL')
                            ->required()
                            ->maxLength(180)
                            ->alphaDash()
                            ->unique(ignoreRecord: true)
                            ->helperText('Dipakai di /portofolio/{slug}. Ubah hanya jika perlu.'),
                        TextInput::make('client_name')
                            ->label('Nama klien')
                            ->maxLength(160)
                            ->helperText('Isi hanya jika klien mengizinkan namanya tampil.'),
                        DatePicker::make('event_date')
                            ->label('Tanggal event')
                            ->native(false)
                            ->displayFormat('d M Y')
                            ->placeholder('Pilih tanggal')
                            ->weekStartsOnMonday()
                            ->closeOnDateSelection(),
                        TextInput::make('location')
                            ->label('Lokasi')
                            ->maxLength(160)
                            ->helperText('Contoh: Bandung, Jawa Barat.'),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Section::make('Media dan cerita')
                    ->schema([
                        FileUpload::make('image')
                            ->label('Foto utama')
                            ->image()
                            ->disk('media')
                            ->directory('portfolio')
                            ->visibility('public')
                            ->acceptedFileTypes(['image/webp', 'image/jpeg', 'image/png'])
                            ->maxSize(4096)
                            ->helperText('Rasio lanskap 16:9, maksimal 4 MB. Jangan pakai foto tanpa izin klien.'),
                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->rows(4)
                            ->columnSpanFull()
                            ->helperText('Ceritakan kebutuhan klien dan solusi yang diberikan. Jangan mengarang angka peserta atau hasil.'),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Section::make('Status')
                    ->schema([
                        Toggle::make('is_featured')
                            ->label('Sorot di beranda')
                            ->default(false)
                            ->helperText('Hanya jika portofolio ini layak tampil paling depan.'),
                        Toggle::make('is_active')
                            ->label('Tampilkan di situs')
                            ->default(false)
                            ->helperText('Biarkan nonaktif sampai foto dan izin klien siap.'),
                        TextInput::make('sort_order')
                            ->label('Urutan')
                            ->numeric()
                            ->integer()
                            ->minValue(0)
                            ->default(0)
                            ->required()
                            ->helperText('Angka lebih kecil tampil lebih dulu.'),
                    ])
                    ->columns(3)
                    ->columnSpanFull(),
            ]);
    }
}
