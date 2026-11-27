<?php

namespace App\Providers\Filament;

use App\Filament\Auth\Login;
use App\Filament\AvatarProviders\BrandAvatarProvider;
use App\Filament\Pages\Dashboard;
use App\Http\Middleware\NoIndex;
use Filament\Enums\ThemeMode;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Widgets\AccountWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->defaultAvatarProvider(BrandAvatarProvider::class)
            ->login(Login::class)
            ->darkMode(false)
            ->defaultThemeMode(ThemeMode::Light)
            ->brandLogo(fn () => view('filament.components.brand'))
            ->brandLogoHeight('2.75rem')
            ->favicon(asset('favicon.svg'))
            ->colors([
                // Palet penuh supaya warna panel sama persis dengan docs/DESIGN.md,
                // bukan turunan hue bawaan Filament.
                'primary' => [
                    50 => '#EEF3FA',
                    100 => '#DCE7F4',
                    200 => '#B9CDE8',
                    300 => '#8FAED8',
                    400 => '#5F86C1',
                    500 => '#3A62A4',
                    600 => '#274B87',
                    700 => '#1B3B6E',
                    800 => '#14305B',
                    900 => '#102546',
                    950 => '#0A172C',
                ],
                'success' => [
                    50 => '#E9F7F1',
                    100 => '#D3EFE3',
                    200 => '#A7DFC8',
                    300 => '#74C9A8',
                    400 => '#46AE87',
                    500 => '#2A916D',
                    600 => '#1E7A5C',
                    700 => '#186049',
                    800 => '#144C3B',
                    900 => '#103D30',
                    950 => '#08241C',
                ],
                'warning' => [
                    50 => '#FFF4E8',
                    100 => '#FFE7CC',
                    200 => '#FECF99',
                    300 => '#FDB466',
                    400 => '#FA9A3D',
                    500 => '#F5821F',
                    600 => '#D96A0F',
                    700 => '#B3530C',
                    800 => '#8F420C',
                    900 => '#74360D',
                    950 => '#3F1B05',
                ],
                'info' => [
                    50 => '#EEF3FA',
                    100 => '#DCE7F4',
                    200 => '#B9CDE8',
                    300 => '#8FAED8',
                    400 => '#5F86C1',
                    500 => '#3A62A4',
                    600 => '#274B87',
                    700 => '#1B3B6E',
                    800 => '#14305B',
                    900 => '#102546',
                    950 => '#0A172C',
                ],
            ])
            ->navigationGroups([
                // Ikon hanya di item navigasi, bukan di grup (aturan Filament).
                NavigationGroup::make('Konten'),
                NavigationGroup::make('Inquiry'),
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                AccountWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                PreventRequestForgery::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                NoIndex::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
