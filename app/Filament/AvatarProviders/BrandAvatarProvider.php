<?php

namespace App\Filament\AvatarProviders;

use Filament\AvatarProviders\Contracts\AvatarProvider;
use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Model;

class BrandAvatarProvider implements AvatarProvider
{
    /**
     * Avatar bawaan berupa SVG lokal, bukan layanan pihak ketiga.
     * Warna mengikuti docs/DESIGN.md: navy, mist, dan aksen signal.
     */
    public function get(Model $record): string
    {
        $initials = str(Filament::getNameForDefaultAvatar($record))
            ->trim()
            ->explode(' ')
            ->map(fn (string $segment): string => mb_substr((string) preg_replace('/^[^\p{L}\p{N}]+/u', '', $segment), 0, 1))
            ->filter()
            ->take(2)
            ->join('');

        $initials = htmlspecialchars(mb_strtoupper($initials), ENT_QUOTES | ENT_XML1, 'UTF-8');

        $svg = <<<SVG
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64">
            <rect width="64" height="64" rx="32" fill="#14305B"/>
            <circle cx="32" cy="32" r="29" fill="none" stroke="#F5821F" stroke-width="1.5" stroke-opacity=".55"/>
            <text x="32" y="40" text-anchor="middle" font-family="Inter, Segoe UI, Arial, sans-serif" font-size="22" font-weight="600" fill="#E9F0F9">{$initials}</text>
        </svg>
        SVG;

        return 'data:image/svg+xml;base64,'.base64_encode($svg);
    }
}
