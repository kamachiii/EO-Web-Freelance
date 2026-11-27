<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInquiryRequest;
use App\Models\Inquiry;
use Illuminate\Http\RedirectResponse;

class StoreInquiryController extends Controller
{
    /**
     * Simpan permintaan dari form Kontak, lalu kembali dengan pesan sukses.
     * Data inquiry tidak dicatat di log dan tidak ditampilkan publik
     * (docs/AGENTS.md bagian 11).
     */
    public function __invoke(StoreInquiryRequest $request): RedirectResponse
    {
        Inquiry::create([
            ...$request->safe()->except(['website']),
            'status' => Inquiry::STATUS_NEW,
        ]);

        return to_route('contact')->with(
            'status',
            'Terima kasih, pesan Anda sudah kami terima. Kami akan menghubungi Anda melalui WhatsApp.'
        );
    }
}
