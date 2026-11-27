<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class RobotstxtController extends Controller
{
    /**
     * robots.txt memakai route agar alamat sitemap mengikuti APP_URL
     * (docs/AGENTS.md bagian 2 dan 10).
     */
    public function __invoke(): Response
    {
        $lines = [
            'User-agent: *',
            'Disallow: /admin',
            '',
            'Sitemap: '.route('sitemap'),
            '',
        ];

        return response(implode("\n", $lines), 200, ['Content-Type' => 'text/plain; charset=UTF-8']);
    }
}
