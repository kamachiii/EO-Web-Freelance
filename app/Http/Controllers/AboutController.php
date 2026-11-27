<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class AboutController extends Controller
{
    public function __invoke(): View
    {
        return view('about', [
            'seo' => config('site.seo.about'),
        ]);
    }
}
