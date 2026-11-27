<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Contracts\View\View;

class ServiceController extends Controller
{
    public function __invoke(): View
    {
        return view('services.index', [
            'services' => Service::active()->get(),
            'seo' => config('site.seo.services'),
        ]);
    }
}
