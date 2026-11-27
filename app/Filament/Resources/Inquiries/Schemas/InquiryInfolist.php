<?php

namespace App\Filament\Resources\Inquiries\Schemas;

use App\Models\Inquiry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class InquiryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Pemohon')
                    ->schema([
                        TextEntry::make('name')
                            ->label('Nama'),
                        TextEntry::make('whatsapp')
                            ->label('WhatsApp')
                            ->copyable(),
                        TextEntry::make('email')
                            ->label('Email')
                            ->placeholder('—')
                            ->copyable(),
                        TextEntry::make('service.name')
                            ->label('Layanan')
                            ->placeholder('—'),
                    ])
                    ->columns(2),
                Section::make('Pesan')
                    ->schema([
                        TextEntry::make('message')
                            ->label('Isi pesan')
                            ->columnSpanFull(),
                    ]),
                Section::make('Tindak lanjut')
                    ->schema([
                        TextEntry::make('status')
                            ->label('Status')
                            ->badge()
                            ->formatStateUsing(fn (string $state): string => Inquiry::STATUSES[$state] ?? $state)
                            ->color(fn (string $state): string => Inquiry::statusColor($state)),
                        TextEntry::make('created_at')
                            ->label('Masuk')
                            ->dateTime('d M Y H:i'),
                        TextEntry::make('updated_at')
                            ->label('Diperbarui')
                            ->dateTime('d M Y H:i'),
                    ])
                    ->columns(3),
            ]);
    }
}
