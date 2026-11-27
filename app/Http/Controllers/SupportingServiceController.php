<?php

namespace App\Http\Controllers;

use App\Models\SupportingServiceCategory;
use Illuminate\Contracts\View\View;

class SupportingServiceController extends Controller
{
    public function __invoke(): View
    {
        return view('supporting-services.index', [
            'categories' => SupportingServiceCategory::query()->with('items')->ordered()->get(),
            'seo' => config('site.seo.supporting_services'),
        ]);
    }
}
