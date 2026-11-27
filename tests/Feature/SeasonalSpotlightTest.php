<?php

namespace Tests\Feature;

use App\Models\SeasonalSegment;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SeasonalSpotlightTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_does_not_show_a_spotlight_without_an_active_campaign(): void
    {
        $this->campaign([
            'is_active' => false,
        ]);

        $response = $this->get('/');

        $response->assertOk();
        $response->assertDontSee('id="sorotan-musim"', false);
        $response->assertSee('Konsultasi Gratis Sekarang');
    }

    public function test_home_shows_the_active_campaign_and_featured_services_in_order(): void
    {
        $first = $this->service('Outbound Uji', 'outbound-uji', 1);
        $second = $this->service('Amazing Race Uji', 'amazing-race-uji', 2);
        $third = $this->service('MICE Uji', 'mice-uji', 3);

        $this->campaign([
            'is_active' => true,
            'label' => 'Musim Uji',
            'hero_subheadline' => 'Sub-headline musim uji.',
            'spotlight_title' => 'Sorotan Musim Uji',
            'spotlight_description' => 'Deskripsi sorotan uji.',
            'cta_label' => 'Minta Proposal Uji',
            'whatsapp_message' => 'Halo musim uji',
            'featured_service_ids' => [$third->id, $first->id],
        ]);

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('id="sorotan-musim"', false);
        $response->assertSee('Musim Uji');
        $response->assertSee('Sub-headline musim uji.');
        $response->assertSee('Sorotan Musim Uji');
        $response->assertSee('Deskripsi sorotan uji.');
        $response->assertSee('Minta Proposal Uji');
        $response->assertSee(rawurlencode('Halo musim uji'), false);

        $band = $this->spotlightHtml($response->getContent());

        $this->assertStringContainsString($third->name, $band);
        $this->assertStringContainsString($first->name, $band);
        $this->assertStringNotContainsString($second->name, $band);
        $this->assertLessThan(
            strpos($band, $first->name),
            strpos($band, $third->name),
        );
    }

    public function test_home_uses_the_highest_priority_campaign_when_dates_overlap(): void
    {
        $this->campaign([
            'name' => 'Musim Prioritas Rendah',
            'label' => 'Musim Prioritas Rendah',
            'priority' => 1,
        ]);

        $this->campaign([
            'name' => 'Musim Prioritas Tinggi',
            'label' => 'Musim Prioritas Tinggi',
            'priority' => 10,
        ]);

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('Musim Prioritas Tinggi');
        $response->assertDontSee('Musim Prioritas Rendah');
    }

    public function test_expired_campaign_is_not_shown(): void
    {
        $this->campaign([
            'starts_at' => now()->subMonth()->toDateString(),
            'ends_at' => now()->subDay()->toDateString(),
        ]);

        $response = $this->get('/');

        $response->assertOk();
        $response->assertDontSee('id="sorotan-musim"', false);
    }

    public function test_preview_is_only_available_to_an_admin(): void
    {
        $campaign = $this->campaign([
            'is_active' => false,
        ]);

        $guest = $this->get('/?preview='.$campaign->id);
        $guest->assertOk();
        $guest->assertDontSee('id="sorotan-musim"', false);

        $this->actingAs(User::factory()->create(['is_admin' => true]));

        $admin = $this->get('/?preview='.$campaign->id);
        $admin->assertOk();
        $admin->assertSee('id="sorotan-musim"', false);
        $admin->assertSee('<meta name="robots" content="noindex, nofollow">', false);
    }

    /**
     * @param  array<string, mixed>  $overrides
     */
    private function campaign(array $overrides = []): SeasonalSegment
    {
        return SeasonalSegment::create([
            'name' => 'Musim Uji',
            'label' => 'Musim Uji',
            'period' => 'Periode Uji',
            'starts_at' => now()->subDay()->toDateString(),
            'ends_at' => now()->addDay()->toDateString(),
            'description' => 'Deskripsi internal uji.',
            'spotlight_title' => 'Sorotan Uji',
            'spotlight_description' => 'Deskripsi sorotan uji.',
            'cta_label' => 'Minta Proposal',
            'whatsapp_message' => 'Halo musim uji',
            'priority' => 0,
            'sort_order' => 0,
            'is_active' => true,
            ...$overrides,
        ]);
    }

    private function service(string $name, string $slug, int $sortOrder): Service
    {
        return Service::create([
            'name' => $name,
            'slug' => $slug,
            'excerpt' => 'Ringkasan '.$name,
            'description' => 'Deskripsi '.$name,
            'sort_order' => $sortOrder,
            'is_active' => true,
        ]);
    }

    private function spotlightHtml(string $html): string
    {
        $start = strpos($html, 'id="sorotan-musim"');

        $this->assertNotFalse($start);

        return substr($html, $start, 8000);
    }
}
