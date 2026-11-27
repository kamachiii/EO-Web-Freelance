<?php

namespace Tests\Feature;

use App\Models\Service;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SitemapTest extends TestCase
{
    use RefreshDatabase;

    public function test_sitemap_lists_visitor_pages(): void
    {
        $this->seed(DatabaseSeeder::class);

        $response = $this->get('/sitemap.xml');

        $response->assertOk();
        $response->assertHeader('Content-Type', 'application/xml; charset=UTF-8');

        $content = $response->getContent();

        $this->assertStringContainsString('http://www.sitemaps.org/schemas/sitemap/0.9', $content);

        $services = Service::active()->get();
        $this->assertSame(5 + $services->count(), substr_count($content, '<loc>'));
        $this->assertStringContainsString('<loc>'.route('home').'</loc>', $content);
        $this->assertStringContainsString('<loc>'.route('about').'</loc>', $content);
        $this->assertStringContainsString('<loc>'.route('services.index').'</loc>', $content);
        $this->assertStringContainsString('<loc>'.route('supporting-services.index').'</loc>', $content);
        $this->assertStringContainsString('<loc>'.route('contact').'</loc>', $content);

        foreach ($services as $service) {
            $this->assertStringContainsString('<loc>'.route('services.show', $service).'</loc>', $content);
        }
    }

    public function test_sitemap_skips_inactive_services(): void
    {
        $this->seed(DatabaseSeeder::class);

        $service = Service::active()->firstOrFail();
        $service->update(['is_active' => false]);

        $content = $this->get('/sitemap.xml')->getContent();

        $this->assertStringNotContainsString('<loc>'.route('services.show', $service).'</loc>', $content);
    }

    public function test_robots_txt_allows_crawlers_and_references_sitemap(): void
    {
        $response = $this->get('/robots.txt');

        $response->assertOk();

        $content = $response->getContent();

        $this->assertStringContainsString('User-agent: *', $content);
        $this->assertStringContainsString('Disallow: /admin', $content);
        $this->assertStringContainsString('Sitemap: '.route('sitemap'), $content);
    }
}
