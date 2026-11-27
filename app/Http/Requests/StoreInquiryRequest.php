<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInquiryRequest extends FormRequest
{
    /**
     * Email dinormalisasi ke huruf kecil sebelum validasi. Aturan `lowercase`
     * tetap dipakai sebagai pengaman, tetapi pengunjung tidak perlu mengetik
     * ulang email yang mengandung huruf kapital.
     */
    protected function prepareForValidation(): void
    {
        if (is_string($this->email)) {
            $this->merge([
                'email' => mb_strtolower(trim($this->email)),
            ]);
        }
    }

    /**
     * Validasi form Kontak. Pesan dalam bahasa Indonesia karena ditampilkan
     * langsung ke pengunjung (docs/AGENTS.md bagian 8).
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'whatsapp' => ['required', 'string', 'max:40', 'regex:/^\+?[0-9][0-9\s\-().]{6,}$/'],
            'email' => ['nullable', 'string', 'lowercase', 'email', 'max:160'],
            'service_id' => ['nullable', 'integer', 'exists:services,id'],
            'message' => ['required', 'string', 'min:10', 'max:2000'],
            // Honeypot: kolom tersembunyi yang hanya diisi bot.
            'website' => ['prohibited'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama wajib diisi.',
            'name.max' => 'Nama terlalu panjang (maksimal :max karakter).',
            'whatsapp.required' => 'Nomor WhatsApp wajib diisi.',
            'whatsapp.max' => 'Nomor WhatsApp terlalu panjang (maksimal :max karakter).',
            'whatsapp.regex' => 'Nomor WhatsApp hanya boleh berisi angka, spasi, tanda hubung, dan tanda kurung.',
            'email.email' => 'Alamat email tidak valid.',
            'email.lowercase' => 'Alamat email tidak valid.',
            'email.max' => 'Alamat email terlalu panjang (maksimal :max karakter).',
            'service_id.exists' => 'Layanan yang dipilih tidak dikenal.',
            'message.required' => 'Pesan wajib diisi.',
            'message.min' => 'Pesan terlalu pendek; ceritakan singkat jenis acara Anda.',
            'message.max' => 'Pesan terlalu panjang (maksimal :max karakter).',
            'website.prohibited' => 'Pesan tidak dapat dikirim.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nama',
            'whatsapp' => 'nomor WhatsApp',
            'email' => 'email',
            'service_id' => 'layanan',
            'message' => 'pesan',
            'website' => 'website',
        ];
    }
}
