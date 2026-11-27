<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Service;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        return view('home', [
            'banner' => Banner::active()->first(),
            'services' => Service::active()->get(),
            'seo' => config('site.seo.home'),
        ]);
    }
}
