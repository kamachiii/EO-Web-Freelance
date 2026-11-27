<?php

namespace Tests\Feature;

use App\Models\Banner;
use App\Models\Package;
use App\Models\PortfolioItem;
use App\Models\Post;
use App\Models\SeasonalSegment;
use App\Models\Service;
use App\Models\SupportingServiceCategory;
use App\Models\SupportingServiceItem;
use App\Models\Testimonial;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContentSeedersTest extends TestCase
{
    use RefreshDatabase;

    public function test_seeders_fill_the_site_content_from_content_md(): void
    {
        $this->seed(DatabaseSeeder::class);

        $this->assertSame(7, Service::count());
        $this->assertSame('Outbound Fun Games & Team Building', Service::active()->first()->name);
        $this->assertSame(
            'amazing-race-treasure-hunt',
            Service::where('name', 'Amazing Race / Treasure Hunt')->value('slug'),
        );

        $this->assertSame(5, SupportingServiceCategory::count());
        $this->assertSame(8, SupportingServiceItem::count());

        $this->assertSame(3, SeasonalSegment::count());
        $this->assertNull(SeasonalSegment::active()->first());
        $this->assertSame(1, SeasonalSegment::where('name', 'like', 'Contoh:%')->count());

        $banner = Banner::active()->first();
        $this->assertNotNull($banner);
        $this->assertNull($banner->seasonal_label);
        $this->assertNull($banner->image_desktop, 'Foto hero belum ada dari klien.');
    }

    public function test_seeders_can_be_run_twice_without_duplicates(): void
    {
        $this->seed(DatabaseSeeder::class);
        $this->seed(DatabaseSeeder::class);

        $this->assertSame(7, Service::count());
        $this->assertSame(5, SupportingServiceCategory::count());
        $this->assertSame(8, SupportingServiceItem::count());
        $this->assertSame(3, PortfolioItem::count());
        $this->assertSame(2, Testimonial::count());
        $this->assertSame(2, Package::count());
        $this->assertSame(2, Post::count());
        $this->assertSame(1, Banner::count());
    }

    public function test_site_copy_contains_no_unconfirmed_claims(): void
    {
        $site = config('site');

        $copy = implode(' ', [
            ...$site['about']['intro'],
            $site['vision'],
            ...array_column($site['mission'], 'text'),
            ...array_column($site['pillars'], 'text'),
        ]);

        $this->assertStringNotContainsString('PT Mitra Raya Global', $copy);
        $this->assertStringNotContainsString('bersertifikat', $copy);
        $this->assertStringNotContainsString('masyarakat lokal', $copy);
    }
}
