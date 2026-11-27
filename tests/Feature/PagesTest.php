<?php

namespace Tests\Feature;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class PagesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(DatabaseSeeder::class);
    }

    /**
     * @return array<string, array{uri: string, h1: string, title: string, sees: array<int, string>}>
     */
    public static function pageProvider(): array
    {
        return [
            'beranda' => [
                'uri' => '/',
                'h1' => 'Push Your Limits, Build Your Team',
                'title' => 'MR Global Events &amp; Solutions | Outbound &amp; Team Building',
                'sees' => [
                    'Kami melayani',
                    'Mengapa Memilih Kami',
                    'Layanan kami',
                    'Outbound Fun Games &amp; Team Building',
                    'https://wa.me/6285771239861',
                    'application/ld+json',
                ],
            ],
            'tentang' => [
                'uri' => '/tentang',
                'h1' => 'Siapa Kami?',
                'title' => 'Tentang Kami',
                'sees' => [
                    'Visi',
                    'Misi',
                    'Tiga komitmen',
                    'Standar Keamanan &amp; Kualitas',
                    'berstandar tinggi',
                ],
            ],
            'layanan' => [
                'uri' => '/layanan',
                'h1' => 'Layanan',
                'title' => 'Layanan Outbound &amp; Team Building | MR Global',
                'sees' => [
                    'Layanan utama',
                    'Minta Penawaran',
                    'Lihat detail',
                    'Lengkapi acara Anda',
                    'Penyelenggaraan gathering skala besar, rapat kerja, seminar, hingga acara tematik perusahaan.',
                ],
            ],
            'layanan detail' => [
                'uri' => '/layanan/outbound-fun-games-team-building',
                'h1' => 'Outbound Fun Games &amp; Team Building',
                'title' => 'Outbound Fun Games &amp; Team Building | MR Global',
                'sees' => [
                    'Program pencairan kebekuan (ice breaking) dan penguatan komunikasi kelompok.',
                    'Minta Penawaran',
                    'Konsultasi gratis',
                    'Layanan lainnya',
                    'https://wa.me/6285771239861',
                ],
            ],
            'layanan pendukung' => [
                'uri' => '/layanan-pendukung',
                'h1' => 'Layanan Pendukung',
                'title' => 'Layanan Pendukung Acara',
                'sees' => [
                    'Kategori layanan pendukung',
                    'Tenda &amp; Alat Pesta',
                    'Sablon kaos/jersey tim',
                    'Paket lunch, snack box, kambing guling',
                ],
            ],
            'kontak' => [
                'uri' => '/kontak',
                'h1' => 'Kontak',
                'title' => 'Kontak dan Konsultasi Gratis',
                'sees' => [
                    'Kirim pesan',
                    'Kirim Pesan',
                    'mrayaglobal@gmail.com',
                    'Bogor / Jakarta',
                    'name="website"',
                    'name="_token"',
                ],
            ],
        ];
    }

    #[DataProvider('pageProvider')]
    public function test_page_renders_with_content_and_seo(string $uri, string $h1, string $title, array $sees): void
    {
        $response = $this->get($uri);

        $response->assertOk();

        $content = $response->getContent();

        $this->assertStringContainsString('<h1', $content);
        $this->assertSame(1, substr_count($content, '<h1'));
        $this->assertStringContainsString($h1, $content);
        $this->assertStringContainsString($title, $content);
        $this->assertStringContainsString('<meta name="description" content="', $content);
        $this->assertStringContainsString('<link rel="canonical"', $content);
        $this->assertStringContainsString('<meta property="og:title"', $content);
        $this->assertStringContainsString('aria-label="Chat WhatsApp"', $content);

        foreach ($sees as $needle) {
            $this->assertStringContainsString($needle, $content);
        }
    }

    public function test_beranda_schema_only_contains_confirmed_data(): void
    {
        $content = $this->get('/')->getContent();

        $this->assertSame(1, preg_match('/<script type="application\/ld\+json">(.+?)<\/script>/s', $content, $matches), 'JSON-LD tidak ditemukan.');

        $schema = json_decode($matches[1], true);

        $this->assertSame('Organization', $schema['@type']);
        $this->assertSame(config('site.name'), $schema['name']);
        $this->assertSame('+6285771239861', $schema['telephone']);
        $this->assertArrayNotHasKey('email', $schema, 'Email belum dikonfirmasi; jangan masukkan ke JSON-LD.');
        $this->assertStringNotContainsString('PT Mitra Raya Global', $matches[1], 'Badan hukum belum dikonfirmasi.');
    }

    public function test_unknown_page_returns_custom_404(): void
    {
        $response = $this->get('/tidak-ada');

        $response->assertNotFound();
        $response->assertSee('Halaman tidak ditemukan');

        $content = $response->getContent();

        $this->assertStringContainsString('<title>Halaman tidak ditemukan | MR Global Events &amp; Solutions</title>', $content);
        $this->assertStringContainsString('<meta name="description" content="Halaman yang Anda cari tidak tersedia.', $content);
        $this->assertStringNotContainsString('&amp;amp;', $content);
    }
}
