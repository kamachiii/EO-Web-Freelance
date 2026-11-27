<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Sitemap XML untuk halaman pengunjung (docs/AGENTS.md bagian 10).
     * Halaman Fase 2 ditambahkan ke daftar ini saat tersedia.
     */
    public function __invoke(): Response
    {
        $urls = [
            route('home'),
            route('about'),
            route('services.index'),
            route('supporting-services.index'),
            route('contact'),
            route('privacy'),
        ];

        foreach (Service::active()->get() as $service) {
            $urls[] = route('services.show', $service);
        }

        return response()
            ->view('sitemap', ['urls' => $urls])
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }
}
