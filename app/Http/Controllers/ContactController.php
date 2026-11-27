<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __invoke(Request $request): View
    {
        // Halaman detail layanan menautkan ke form dengan ?service=slug,
        // supaya pilihan layanan langsung terisi (docs/DESIGN.md bagian 6).
        $slug = $request->query('service');
        $selectedService = is_string($slug)
            ? Service::active()->where('slug', $slug)->first()
            : null;

        return view('contact', [
            'services' => Service::active()->get(),
            'selectedServiceId' => $selectedService?->id,
            'seo' => config('site.seo.contact'),
        ]);
    }
}
