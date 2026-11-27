<?php

namespace App\Filament\Resources\SeasonalSegments\Schemas;

use App\Models\Service;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class SeasonalSegmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Identitas musim')
                    ->description('Nama ini dipakai di panel. Label publik hanya tampil setelah disetujui klien.')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama internal')
                            ->required()
                            ->maxLength(120)
                            ->helperText('Contoh: Ramadan 2027, Study Tour Sekolah, Year-End Gathering.'),
                        TextInput::make('label')
                            ->label('Label publik')
                            ->required()
                            ->maxLength(160)
                            ->helperText('Contoh: Musim Study Tour Sekolah. Jangan aktifkan sebelum label disetujui.'),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Section::make('Jadwal musim')
                    ->description('Pilih rentang tanggal dari kalender. Kalender admin memakai rentang ini untuk menampilkan musim.')
                    ->schema([
                        DatePicker::make('starts_at')
                            ->label('Tanggal mulai')
                            ->native(false)
                            ->displayFormat('d M Y')
                            ->placeholder('Pilih tanggal')
                            ->weekStartsOnMonday()
                            ->closeOnDateSelection()
                            ->helperText('Boleh dikosongkan jika musim sudah berjalan.'),
                        DatePicker::make('ends_at')
                            ->label('Tanggal selesai')
                            ->native(false)
                            ->displayFormat('d M Y')
                            ->placeholder('Pilih tanggal')
                            ->weekStartsOnMonday()
                            ->closeOnDateSelection()
                            ->minDate(fn (Get $get): ?string => $get('starts_at'))
                            ->rules(['after_or_equal:starts_at'])
                            ->validationMessages([
                                'after_or_equal' => 'Tanggal selesai tidak boleh sebelum tanggal mulai.',
                            ])
                            ->helperText('Boleh dikosongkan jika musim belum punya batas akhir.'),
                        TextInput::make('period')
                            ->label('Label periode')
                            ->maxLength(120)
                            ->helperText('Kosongkan untuk diisi otomatis dari tanggal, misalnya "08 Feb 2027 - 09 Mar 2027".'),
                        TextInput::make('sort_order')
                            ->label('Urutan')
                            ->numeric()
                            ->integer()
                            ->minValue(0)
                            ->default(0)
                            ->required()
                            ->helperText('Musim dengan urutan lebih kecil tampil lebih dulu di tabel.'),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Section::make('Sorotan publik')
                    ->description('Label menjadi eyebrow di hero. Sub-headline menggantikan teks hero. Tombol utama memakai label dan pesan WhatsApp. Judul, deskripsi, dan program unggulan tampil di band sorotan.')
                    ->schema([
                        TextInput::make('spotlight_title')
                            ->label('Judul sorotan')
                            ->maxLength(160)
                            ->helperText('Kosongkan untuk memakai label publik.'),
                        TextInput::make('cta_label')
                            ->label('Label tombol utama')
                            ->maxLength(80)
                            ->helperText('Kosongkan untuk "Konsultasi Gratis Sekarang".'),
                        Textarea::make('hero_subheadline')
                            ->label('Sub-headline hero')
                            ->rows(2)
                            ->maxLength(300)
                            ->columnSpanFull()
                            ->helperText('Menggantikan sub-headline banner di hero. Kosongkan untuk memakai teks banner.'),
                        Textarea::make('spotlight_description')
                            ->label('Deskripsi sorotan')
                            ->rows(3)
                            ->columnSpanFull()
                            ->helperText('Satu paragraf pendek untuk band sorotan. Jangan mengarang promo, harga, atau kuota.'),
                        Textarea::make('whatsapp_message')
                            ->label('Pesan WhatsApp')
                            ->rows(2)
                            ->columnSpanFull()
                            ->helperText('Pesan awal saat pengunjung menekan tombol utama.'),
                        Select::make('featured_service_ids')
                            ->label('Program unggulan')
                            ->multiple()
                            ->options(fn (): array => Service::active()->pluck('name', 'id')->all())
                            ->maxItems(3)
                            ->searchable()
                            ->columnSpanFull()
                            ->helperText('Maksimal tiga layanan. Urutan pilihan mengikuti urutan klik.'),
                    ])
                    ->columns(2)
                    ->columnSpanFull()
                    ->collapsible()
                    ->collapsed(),

                Section::make('Status')
                    ->schema([
                        TextInput::make('priority')
                            ->label('Prioritas')
                            ->numeric()
                            ->integer()
                            ->minValue(0)
                            ->default(0)
                            ->required()
                            ->helperText('Jika tanggal bertumpuk, angka terbesar yang tampil.'),
                        Toggle::make('is_active')
                            ->label('Aktifkan musim')
                            ->default(false)
                            ->extraAttributes(['aria-label' => 'Aktifkan musim'])
                            ->helperText('Hanya musim aktif dan berada dalam rentang tanggal yang tampil di situs.'),
                        Textarea::make('description')
                            ->label('Catatan internal')
                            ->rows(2)
                            ->columnSpanFull()
                            ->helperText('Tidak tampil di situs. Dipakai sebagai cadangan deskripsi sorotan.'),
                    ])
                    ->columns(2)
                    ->columnSpanFull()
                    ->collapsible(),
            ]);
    }
}
