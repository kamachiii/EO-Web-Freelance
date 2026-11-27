<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\SeasonalSegment;
use App\Models\Service;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(Request $request): View
    {
        $spotlight = null;
        $isSpotlightPreview = false;
        $previewId = $request->integer('preview');

        // Pratinjau hanya untuk admin atau lingkungan lokal (docs/SEASONAL.md bagian 5).
        if ($previewId > 0 && (app()->environment('local') || $request->user()?->is_admin)) {
            $spotlight = SeasonalSegment::find($previewId);
            $isSpotlightPreview = $spotlight !== null;
        }

        if (! $spotlight && config('site.features.seasonal_spotlight', true)) {
            $spotlight = SeasonalSegment::current()->first();
        }

        return view('home', [
            'banner' => Banner::active()->first(),
            'services' => Service::active()->get(),
            'spotlight' => $spotlight,
            'spotlightServices' => $spotlight?->featuredServices() ?? collect(),
            'isSpotlightPreview' => $isSpotlightPreview,
            'seo' => config('site.seo.home'),
        ]);
    }
}
