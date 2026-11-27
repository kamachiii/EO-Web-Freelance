<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class PrivacyController extends Controller
{
    public function __invoke(): View
    {
        return view('privacy', [
            'seo' => config('site.seo.privacy'),
        ]);
    }
}
