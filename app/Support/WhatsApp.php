<?php

namespace App\Support;

/**
 * Satu-satunya tempat menyusun link WhatsApp (docs/AGENTS.md bagian 5).
 */
final class WhatsApp
{
    /**
     * Link wa.me dengan pesan awal. Pesan kustom dipakai untuk menyebut
     * nama layanan, misalnya pada tombol "Minta Penawaran".
     */
    public static function link(?string $message = null): string
    {
        $url = 'https://wa.me/'.self::number();

        $text = $message ?? config('site.whatsapp.default_message');

        return $text ? $url.'?text='.rawurlencode($text) : $url;
    }

    /**
     * Nomor WhatsApp tanpa tanda hubung, spasi, atau tanda plus.
     */
    public static function number(): string
    {
        return (string) config('site.whatsapp.number');
    }

    /**
     * Nomor WhatsApp dalam bentuk yang mudah dibaca pengunjung.
     */
    public static function display(): string
    {
        return (string) config('site.whatsapp.display');
    }
}
