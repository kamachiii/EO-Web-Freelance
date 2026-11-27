<?php

namespace Tests\Feature;

use App\Models\Service;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServiceDetailTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(DatabaseSeeder::class);
    }

    public function test_every_active_service_has_a_detail_page(): void
    {
        foreach (Service::active()->get() as $service) {
            $response = $this->get(route('services.show', $service));

            $response->assertOk();
            $response->assertSee($service->name);
            $response->assertSee($service->description);
            $response->assertSee('Minta Penawaran');
            $response->assertSee('Konsultasi gratis');
        }
    }

    public function test_detail_page_has_unique_seo_and_whatsapp_link(): void
    {
        $service = Service::where('slug', 'extreme-water-adventure')->firstOrFail();

        $response = $this->get(route('services.show', $service));

        $response->assertOk();
        $response->assertSee('<title>'.e($service->name.' | MR Global').'</title>', false);
        $response->assertSee('<meta name="description" content="'.e($service->description), false);
        $response->assertSee('<link rel="canonical"', false);
        $response->assertSee('https://wa.me/6285771239861', false);
    }

    public function test_inactive_service_returns_not_found(): void
    {
        $service = Service::active()->firstOrFail();
        $service->update(['is_active' => false]);

        $this->get(route('services.show', $service))->assertNotFound();
    }

    public function test_unknown_service_slug_returns_not_found(): void
    {
        $this->get('/layanan/layanan-yang-tidak-ada')->assertNotFound();
    }
}
