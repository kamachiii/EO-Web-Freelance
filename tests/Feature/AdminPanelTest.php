<?php

namespace Tests\Feature;

use App\Filament\Resources\Banners\BannerResource;
use App\Filament\Resources\Inquiries\InquiryResource;
use App\Filament\Resources\Packages\PackageResource;
use App\Filament\Resources\PortfolioItems\PortfolioItemResource;
use App\Filament\Resources\Posts\PostResource;
use App\Filament\Resources\SeasonalSegments\SeasonalSegmentResource;
use App\Filament\Resources\Services\ServiceResource;
use App\Filament\Resources\Testimonials\TestimonialResource;
use App\Models\Banner;
use App\Models\Inquiry;
use App\Models\Package;
use App\Models\PortfolioItem;
use App\Models\Post;
use App\Models\SeasonalSegment;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\User;
use Database\Seeders\AdminUserSeeder;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminPanelTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(DatabaseSeeder::class);
    }

    public function test_guest_is_redirected_to_login(): void
    {
        $this->get('/admin')->assertRedirect('/admin/login');
    }

    public function test_login_page_is_not_indexed(): void
    {
        $response = $this->get('/admin/login');

        $response->assertOk();
        $response->assertHeader('X-Robots-Tag', 'noindex, nofollow');
    }

    public function test_authenticated_user_can_open_dashboard_and_resources(): void
    {
        $this->actingAs(User::factory()->create(['is_admin' => true]));

        foreach ([
            '/admin',
            '/admin/banners',
            '/admin/banners/create',
            '/admin/services',
            '/admin/services/create',
            '/admin/seasonal-segments',
            '/admin/seasonal-segments/create',
            '/admin/portfolio-items',
            '/admin/portfolio-items/create',
            '/admin/testimonials',
            '/admin/testimonials/create',
            '/admin/packages',
            '/admin/packages/create',
            '/admin/posts',
            '/admin/posts/create',
            '/admin/inquiries',
        ] as $url) {
            $this->get($url)->assertOk();
        }

        $inquiry = Inquiry::create([
            'name' => 'Uji Inquiry',
            'whatsapp' => '081234567890',
            'email' => 'uji@example.test',
            'message' => 'Pesan uji dari panel admin.',
        ]);

        $this->get(BannerResource::getUrl('edit', ['record' => Banner::firstOrFail()]))->assertOk();
        $this->get(ServiceResource::getUrl('edit', ['record' => Service::firstOrFail()]))->assertOk();
        $this->get(SeasonalSegmentResource::getUrl('edit', ['record' => SeasonalSegment::firstOrFail()]))->assertOk();
        $this->get(PortfolioItemResource::getUrl('edit', ['record' => PortfolioItem::firstOrFail()]))->assertOk();
        $this->get(TestimonialResource::getUrl('edit', ['record' => Testimonial::firstOrFail()]))->assertOk();
        $this->get(PackageResource::getUrl('edit', ['record' => Package::firstOrFail()]))->assertOk();
        $this->get(PostResource::getUrl('edit', ['record' => Post::firstOrFail()]))->assertOk();
        $this->get(InquiryResource::getUrl('view', ['record' => $inquiry]))->assertOk();
    }

    public function test_seeded_catalog_placeholders_are_not_published(): void
    {
        $this->assertSame(0, PortfolioItem::where('is_active', true)->count());
        $this->assertSame(0, Testimonial::where('is_active', true)->count());
        $this->assertSame(0, Package::where('is_active', true)->count());
        $this->assertSame(0, Post::where('is_published', true)->count());
    }

    public function test_inquiry_cannot_be_created_from_admin(): void
    {
        $this->actingAs(User::factory()->create(['is_admin' => true]));

        $this->get('/admin/inquiries/create')->assertNotFound();
    }

    public function test_admin_seeder_creates_user_from_config(): void
    {
        config([
            'admin.name' => 'Admin Uji',
            'admin.email' => 'admin-uji@example.test',
            'admin.password' => 'kata-sandi-uji-yang-kuat',
        ]);

        $this->seed(AdminUserSeeder::class);

        $user = User::where('email', 'admin-uji@example.test')->firstOrFail();

        $this->assertSame('Admin Uji', $user->name);
        $this->assertTrue($user->is_admin);
        $this->assertTrue(Hash::check('kata-sandi-uji-yang-kuat', $user->password));
    }
}
