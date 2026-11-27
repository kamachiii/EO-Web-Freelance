<?php

namespace Tests\Feature;

use App\Models\Banner;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BannerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(DatabaseSeeder::class);
    }

    public function test_replacing_or_removing_banner_images_deletes_old_files(): void
    {
        Storage::fake('hero');
        Storage::disk('hero')->put('old-desktop.webp', 'x');
        Storage::disk('hero')->put('old-mobile.webp', 'x');

        $banner = Banner::firstOrFail();
        $banner->update([
            'image_desktop' => 'old-desktop.webp',
            'image_mobile' => 'old-mobile.webp',
        ]);

        $banner->update(['image_desktop' => 'new-desktop.webp']);
        Storage::disk('hero')->assertMissing('old-desktop.webp');
        Storage::disk('hero')->assertExists('old-mobile.webp');

        $banner->update(['image_mobile' => null]);
        Storage::disk('hero')->assertMissing('old-mobile.webp');
    }

    public function test_deleting_banner_removes_its_images_but_keeps_defaults(): void
    {
        Storage::fake('hero');
        Storage::disk('hero')->put('upload.webp', 'x');
        Storage::disk('hero')->put('hero-desktop.webp', 'x');

        $banner = Banner::firstOrFail();
        $banner->update(['image_desktop' => 'upload.webp']);
        $banner->delete();

        Storage::disk('hero')->assertMissing('upload.webp');
        Storage::disk('hero')->assertExists('hero-desktop.webp');
    }
}
