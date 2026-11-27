<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Judul dan slug')
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul artikel')
                            ->required()
                            ->maxLength(180)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, ?string $state, Set $set): void {
                                if ($operation === 'create') {
                                    $set('slug', Str::slug((string) $state));
                                }
                            }),
                        TextInput::make('slug')
                            ->label('Slug URL')
                            ->required()
                            ->maxLength(200)
                            ->alphaDash()
                            ->unique(ignoreRecord: true)
                            ->helperText('Dipakai di /artikel/{slug}.'),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Section::make('Isi artikel')
                    ->schema([
                        Textarea::make('excerpt')
                            ->label('Ringkasan')
                            ->rows(2)
                            ->maxLength(300)
                            ->columnSpanFull()
                            ->helperText('Tampil di daftar artikel dan hasil pencarian.'),
                        Textarea::make('body')
                            ->label('Isi artikel')
                            ->rows(10)
                            ->columnSpanFull()
                            ->helperText('Pisahkan paragraf dengan satu baris kosong. Jangan mengarang data atau kutipan.'),
                        FileUpload::make('cover_image')
                            ->label('Gambar sampul')
                            ->image()
                            ->disk('media')
                            ->directory('posts')
                            ->visibility('public')
                            ->acceptedFileTypes(['image/webp', 'image/jpeg', 'image/png'])
                            ->maxSize(4096)
                            ->helperText('Rasio 16:9, maksimal 4 MB.'),
                    ])
                    ->columnSpanFull(),

                Section::make('Publikasi')
                    ->schema([
                        DateTimePicker::make('published_at')
                            ->label('Tanggal terbit')
                            ->native(false)
                            ->displayFormat('d M Y H:i')
                            ->seconds(false)
                            ->placeholder('Pilih tanggal dan jam')
                            ->helperText('Artikel baru tampil setelah tanggal ini lewat.'),
                        Toggle::make('is_published')
                            ->label('Terbitkan')
                            ->default(false)
                            ->helperText('Biarkan nonaktif selama artikel masih draf.'),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }
}
