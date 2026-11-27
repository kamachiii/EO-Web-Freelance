<?php

namespace Tests\Feature;

use App\Models\Inquiry;
use App\Models\Service;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(DatabaseSeeder::class);
    }

    /**
     * @return array<string, int|string|null>
     */
    private function validPayload(array $overrides = []): array
    {
        return array_merge([
            'name' => 'Andi Saputra',
            'whatsapp' => '0812 3456 7890',
            'email' => 'andi@example.com',
            'service_id' => Service::first()->id,
            'message' => 'Kami ingin outbound team building untuk 60 peserta di Bogor.',
            'website' => '',
        ], $overrides);
    }

    public function test_valid_inquiry_is_stored_and_visitor_sees_success_message(): void
    {
        $response = $this->post('/kontak', $this->validPayload());

        $response->assertRedirect(route('contact'));
        $response->assertSessionHas('status');

        $this->assertDatabaseHas('inquiries', [
            'name' => 'Andi Saputra',
            'whatsapp' => '0812 3456 7890',
            'email' => 'andi@example.com',
            'status' => Inquiry::STATUS_NEW,
        ]);

        $this->get('/kontak')
            ->assertOk()
            ->assertSee('Pesan Anda terkirim');
    }

    public function test_inquiry_without_optional_fields_is_stored(): void
    {
        $response = $this->post('/kontak', $this->validPayload([
            'email' => null,
            'service_id' => null,
        ]));

        $response->assertRedirect(route('contact'));
        $this->assertDatabaseCount('inquiries', 1);

        $inquiry = Inquiry::first();
        $this->assertNull($inquiry->email);
        $this->assertNull($inquiry->service_id);
    }

    public function test_email_is_normalized_to_lowercase(): void
    {
        $this->post('/kontak', $this->validPayload([
            'email' => 'QA@Example.COM',
        ]))
            ->assertRedirect(route('contact'))
            ->assertSessionHasNoErrors();

        $this->assertDatabaseHas('inquiries', [
            'email' => 'qa@example.com',
        ]);
    }

    public function test_filled_honeypot_rejects_submission(): void
    {
        $response = $this->post('/kontak', $this->validPayload([
            'website' => 'http://spam.example',
        ]));

        $response->assertSessionHasErrors('website');
        $this->assertDatabaseCount('inquiries', 0);
    }

    public function test_validation_errors_are_shown_in_indonesian(): void
    {
        $invalid = [
            'name' => '',
            'whatsapp' => 'bukan nomor',
            'message' => 'pendek',
        ];

        $this->from(route('contact'))
            ->post('/kontak', $invalid)
            ->assertSessionHasErrors(['name', 'whatsapp', 'message']);

        // Pengunjung mengirim form dari halaman kontak, jadi validasi gagal
        // mengembalikan mereka ke halaman itu dengan pesan error.
        $this->from(route('contact'))
            ->followingRedirects()
            ->post('/kontak', $invalid)
            ->assertSee('Nama wajib diisi.')
            ->assertSee('Nomor WhatsApp hanya boleh berisi angka, spasi, tanda hubung, dan tanda kurung.')
            ->assertSee('Pesan terlalu pendek; ceritakan singkat jenis acara Anda.')
            ->assertSee('isian perlu diperbaiki');
    }

    public function test_old_input_is_preserved_after_validation_error(): void
    {
        $this->from(route('contact'))
            ->followingRedirects()
            ->post('/kontak', [
                'name' => 'Budi',
                'whatsapp' => 'salah',
                'message' => 'pesan yang cukup panjang untuk lolos validasi.',
            ])
            ->assertSee('value="Budi"', false)
            ->assertSee('pesan yang cukup panjang untuk lolos validasi.');
    }

    public function test_too_many_submissions_are_throttled(): void
    {
        for ($i = 0; $i < 5; $i++) {
            $this->post('/kontak', $this->validPayload(['name' => 'Pengirim '.$i]));
        }

        $this->assertDatabaseCount('inquiries', 5);

        $this->post('/kontak', $this->validPayload(['name' => 'Keenam']))
            ->assertStatus(429)
            ->assertSee('Terlalu banyak percobaan')
            ->assertSee('<title>Terlalu banyak percobaan | MR Global Events &amp; Solutions</title>', false);

        $this->assertDatabaseCount('inquiries', 5);
    }
}
