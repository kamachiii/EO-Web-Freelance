<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Contracts\View\View;

class ServiceDetailController extends Controller
{
    public function __invoke(Service $service): View
    {
        abort_unless($service->is_active, 404);

        $description = $service->description ?: $service->excerpt;

        return view('services.show', [
            'service' => $service,
            'otherServices' => Service::active()->whereKeyNot($service->getKey())->get(),
            'seo' => [
                'title' => $service->name.' | MR Global',
                'description' => $description.' Konsultasi gratis dan minta penawaran melalui WhatsApp.',
            ],
        ]);
    }
}
