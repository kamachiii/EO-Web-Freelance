<?php

namespace Tests\Unit;

use App\Support\WhatsApp;
use Tests\TestCase;

class WhatsAppTest extends TestCase
{
    public function test_link_uses_the_configured_number_and_default_message(): void
    {
        $expected = 'https://wa.me/6285771239861?text='.rawurlencode(config('site.whatsapp.default_message'));

        $this->assertSame($expected, WhatsApp::link());
    }

    public function test_link_accepts_a_custom_message(): void
    {
        $message = 'Halo, saya mau minta penawaran untuk Outbound Fun Games & Team Building.';

        $this->assertSame(
            'https://wa.me/6285771239861?text='.rawurlencode($message),
            WhatsApp::link($message),
        );
    }

    public function test_display_number_is_readable(): void
    {
        $this->assertSame('+62 8577-123-9861', WhatsApp::display());
    }
}
