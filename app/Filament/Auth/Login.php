<?php

namespace App\Filament\Auth;

use Filament\Auth\Pages\Login as BaseLogin;
use Illuminate\Contracts\Support\Htmlable;

class Login extends BaseLogin
{
    public function getHeading(): string|Htmlable|null
    {
        if (filled($this->userUndertakingMultiFactorAuthentication)) {
            return parent::getHeading();
        }

        return 'Masuk ke panel';
    }

    public function getSubheading(): string|Htmlable|null
    {
        return 'Kelola konten, layanan, dan jadwal musim MR Global Events & Solutions.';
    }
}
