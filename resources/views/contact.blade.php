@use('App\Support\WhatsApp')

@php
    // Kolom form memakai garis navy tipis, teks navy, dan ring fokus 2 px yang ringkas.
    $fieldBase = 'w-full rounded-[4px] border bg-white px-4 text-body text-navy transition-colors duration-150 placeholder:text-charcoal/60 hover:border-navy/80 focus:border-navy focus:ring-2 focus:ring-navy/20 focus-visible:outline-none';
    $fieldBorder = 'border-navy/60';
    $fieldError = 'border-navy ring-2 ring-navy/15';
@endphp

<x-layout :title="$seo['title']" :description="$seo['description']">
    <x-page-cover eyebrow="Kontak"
                  title="Kontak"
                  title-id="judul-kontak"
                  intro="Konsultasi gratis untuk merencanakan acara Anda. Hubungi kami lewat WhatsApp, email, atau formulir."
                  action-label="Kirim pesan"
                  action-href="#formulir">
        <x-slot:meta>
            <p class="text-label font-semibold uppercase tracking-label text-mist">Kontak langsung</p>
        </x-slot:meta>

        <x-slot:aside>
            <div class="page-cover-aside mt-8">
                <a href="{{ WhatsApp::link() }}"
                   class="group flex min-h-14 items-center justify-between gap-4 border-b border-line pb-3 text-navy no-underline transition-colors duration-150 hover:border-navy">
                    <span class="min-w-0">
                        <span class="block text-label font-semibold uppercase tracking-label text-charcoal">WhatsApp</span>
                        <span class="mt-1 block whitespace-nowrap text-body font-semibold sm:text-card-lg">{{ WhatsApp::display() }}</span>
                    </span>
                    <x-icon name="arrow-up-right" class="h-5 w-5 shrink-0 transition-transform duration-150 group-hover:-translate-y-0.5 group-hover:translate-x-0.5" />
                </a>

                <div class="page-cover-email mt-4">
                    <a href="mailto:{{ config('site.email') }}"
                       class="group flex min-h-14 items-center justify-between gap-4 border-b border-line pb-3 text-navy no-underline transition-colors duration-150 hover:border-navy">
                        <span class="min-w-0">
                            <span class="block text-label font-semibold uppercase tracking-label text-charcoal">Email</span>
                            <span class="mt-1 block break-all text-body font-semibold sm:text-card-lg">{{ config('site.email') }}</span>
                        </span>
                        <x-icon name="arrow-up-right" class="h-5 w-5 shrink-0 transition-transform duration-150 group-hover:-translate-y-0.5 group-hover:translate-x-0.5" />
                    </a>

                    <p class="mt-3 hidden max-w-prose text-small text-charcoal min-[360px]:block">
                        Untuk penawaran, sertakan perkiraan jumlah peserta dan tanggal acara.
                    </p>
                </div>
            </div>
        </x-slot:aside>
    </x-page-cover>

    <x-section tone="mist" aria-label="Formulir dan informasi kontak">
        <x-container class="grid gap-12 lg:grid-cols-12 lg:gap-10">
            {{-- Info kontak: tampil setelah form di mobile (docs/DESIGN.md bagian 6). --}}
            <div class="order-2 border-t-2 border-navy pt-6 lg:order-1 lg:col-span-4" data-reveal>
                <h2 class="font-display text-chapter font-bold tracking-heading text-navy">Hubungi kami</h2>
                <p class="mt-3 max-w-sm text-body text-charcoal">
                    Kami membalas melalui WhatsApp. Untuk permintaan penawaran, sertakan perkiraan jumlah peserta dan tanggal acara.
                </p>

                <dl class="mt-8 border-t border-line">
                    <div class="border-b border-line py-5">
                        <dt class="text-label font-semibold uppercase tracking-label text-charcoal">WhatsApp</dt>
                        <dd class="mt-2">
                            <a href="{{ WhatsApp::link() }}"
                               class="inline-flex min-h-11 items-center text-card-lg font-semibold text-navy underline decoration-navy/30 underline-offset-4 transition-colors duration-150 hover:decoration-navy">
                                {{ WhatsApp::display() }}
                            </a>
                            <p class="text-small text-charcoal">Konsultasi gratis</p>
                        </dd>
                    </div>

                    <div class="border-b border-line py-5">
                        <dt class="text-label font-semibold uppercase tracking-label text-charcoal">Email</dt>
                        <dd class="mt-2">
                            <a href="mailto:{{ config('site.email') }}"
                               class="inline-flex min-h-11 items-center break-all text-body font-semibold text-navy underline decoration-navy/30 underline-offset-4 transition-colors duration-150 hover:decoration-navy">
                                {{ config('site.email') }}
                            </a>
                        </dd>
                    </div>

                    <div class="border-b border-line py-5">
                        <dt class="text-label font-semibold uppercase tracking-label text-charcoal">Basecamp</dt>
                        <dd class="mt-2 text-body text-charcoal">{{ config('site.basecamp') }}</dd>
                    </div>

                    <div class="border-b border-line py-5">
                        <dt class="text-label font-semibold uppercase tracking-label text-charcoal">Area layanan</dt>
                        <dd class="mt-2 text-body text-charcoal">{{ config('site.service_area_summary') }}</dd>
                    </div>
                </dl>
            </div>

            {{-- Form tampil lebih dulu di mobile. --}}
            <div id="formulir" class="order-1 lg:order-2 lg:col-span-7 lg:col-start-6" data-reveal style="--reveal-delay: 100ms">
                @if (session('status'))
                    <div class="border-t-2 border-navy pt-8" role="status">
                        <p class="text-label font-semibold uppercase tracking-label text-forest">Terkirim</p>
                        <h2 class="mt-3 font-display text-chapter font-bold tracking-heading text-navy">Pesan Anda terkirim</h2>
                        <p class="mt-4 max-w-prose text-body-lg text-charcoal">{{ session('status') }}</p>

                        <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:gap-4">
                            <x-button :href="WhatsApp::link()">Chat WhatsApp</x-button>
                            <x-button href="{{ route('contact') }}" variant="outline">Kirim pesan lain</x-button>
                        </div>
                    </div>
                @else
                    <form action="{{ route('contact.store') }}" method="POST" class="border-t-2 border-navy pt-6">
                        @csrf

                        <h2 class="font-display text-chapter font-bold tracking-heading text-navy">Kirim pesan</h2>
                        <p class="mt-3 max-w-prose text-body text-charcoal">
                            Isi formulir ini untuk meminta penawaran. Kami akan membalas melalui WhatsApp.
                        </p>

                        @if ($errors->any())
                            <div id="form-errors" class="mt-8 border-2 border-navy bg-white p-6" tabindex="-1">
                                <h3 class="font-display text-card-lg font-bold text-navy">{{ $errors->count() }} isian perlu diperbaiki</h3>
                                <ul class="mt-3 list-inside space-y-1 text-body text-charcoal">
                                    @foreach (['name' => 'nama', 'whatsapp' => 'nomor WhatsApp', 'email' => 'email', 'service_id' => 'layanan', 'message' => 'pesan'] as $field => $label)
                                        @if ($errors->has($field))
                                            <li><a href="#{{ $field }}" class="text-navy underline underline-offset-4">{{ $errors->first($field) }}</a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            <script>document.getElementById('form-errors').focus();</script>
                        @endif

                        <div class="mt-8 grid gap-x-5 gap-y-6 sm:grid-cols-2">
                            <div>
                                <label for="name" class="block text-small font-semibold text-navy">Nama <span aria-hidden="true">*</span><span class="sr-only">(wajib)</span></label>
                                <input id="name" name="name" type="text" required autocomplete="name" value="{{ old('name') }}"
                                       @if ($errors->has('name')) aria-invalid="true" aria-describedby="name-error" @endif
                                       class="mt-2 h-12 {{ $fieldBase }} {{ $errors->has('name') ? $fieldError : $fieldBorder }}">
                                @if ($errors->has('name'))
                                    <p id="name-error" class="mt-2 text-small font-semibold text-navy" role="alert">{{ $errors->first('name') }}</p>
                                @endif
                            </div>

                            <div>
                                <label for="whatsapp" class="block text-small font-semibold text-navy">Nomor WhatsApp <span aria-hidden="true">*</span><span class="sr-only">(wajib)</span></label>
                                <input id="whatsapp" name="whatsapp" type="tel" required inputmode="tel" autocomplete="tel" value="{{ old('whatsapp') }}"
                                       aria-describedby="whatsapp-hint{{ $errors->has('whatsapp') ? ' whatsapp-error' : '' }}"
                                       @if ($errors->has('whatsapp')) aria-invalid="true" @endif
                                       class="mt-2 h-12 {{ $fieldBase }} {{ $errors->has('whatsapp') ? $fieldError : $fieldBorder }}">
                                @if ($errors->has('whatsapp'))
                                    <p id="whatsapp-error" class="mt-2 text-small font-semibold text-navy" role="alert">{{ $errors->first('whatsapp') }}</p>
                                @else
                                    <p id="whatsapp-hint" class="mt-2 text-tiny text-charcoal">Nomor yang bisa kami hubungi, contoh: 0812 3456 7890.</p>
                                @endif
                            </div>

                            <div>
                                <label for="email" class="block text-small font-semibold text-navy">Email <span class="font-normal text-charcoal/70">(opsional)</span></label>
                                <input id="email" name="email" type="email" autocomplete="email" value="{{ old('email') }}"
                                       @if ($errors->has('email')) aria-invalid="true" aria-describedby="email-error" @endif
                                       class="mt-2 h-12 {{ $fieldBase }} {{ $errors->has('email') ? $fieldError : $fieldBorder }}">
                                @if ($errors->has('email'))
                                    <p id="email-error" class="mt-2 text-small font-semibold text-navy" role="alert">{{ $errors->first('email') }}</p>
                                @endif
                            </div>

                            <div>
                                <label for="service_id" class="block text-small font-semibold text-navy">Layanan yang diminati <span class="font-normal text-charcoal/70">(opsional)</span></label>
                                <div class="relative mt-2">
                                    <select id="service_id" name="service_id"
                                            @if ($errors->has('service_id')) aria-invalid="true" aria-describedby="service_id-error" @endif
                                            class="h-12 appearance-none pr-10 {{ $fieldBase }} {{ $errors->has('service_id') ? $fieldError : $fieldBorder }}">
                                        <option value="">Pilih layanan</option>
                                        @foreach ($services as $service)
                                            <option value="{{ $service->id }}" @selected((string) old('service_id', $selectedServiceId) === (string) $service->id)>
                                                {{ $service->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-icon name="chevron-down" class="pointer-events-none absolute right-4 top-1/2 h-4 w-4 -translate-y-1/2 text-navy" />
                                </div>
                                @if ($errors->has('service_id'))
                                    <p id="service_id-error" class="mt-2 text-small font-semibold text-navy" role="alert">{{ $errors->first('service_id') }}</p>
                                @endif
                            </div>

                            <div class="sm:col-span-2">
                                <label for="message" class="block text-small font-semibold text-navy">Pesan <span aria-hidden="true">*</span><span class="sr-only">(wajib)</span></label>
                                <textarea id="message" name="message" rows="3" required
                                          aria-describedby="message-hint{{ $errors->has('message') ? ' message-error' : '' }}"
                                          @if ($errors->has('message')) aria-invalid="true" @endif
                                          class="mt-2 resize-y py-3 {{ $fieldBase }} {{ $errors->has('message') ? $fieldError : $fieldBorder }}">{{ old('message') }}</textarea>
                                @if ($errors->has('message'))
                                    <p id="message-error" class="mt-2 text-small font-semibold text-navy" role="alert">{{ $errors->first('message') }}</p>
                                @else
                                    <p id="message-hint" class="mt-2 text-tiny text-charcoal">Ceritakan jenis acara, perkiraan jumlah peserta, dan tanggal bila sudah ada.</p>
                                @endif
                            </div>

                            {{-- Honeypot: disembunyikan dari pengunjung, diisi bot (docs/AGENTS.md bagian 11). --}}
                            <div class="hidden" aria-hidden="true">
                                <label for="website">Website</label>
                                <input id="website" name="website" type="text" tabindex="-1" autocomplete="off">
                            </div>

                            <div class="sm:col-span-2">
                                <x-button type="submit" class="w-full sm:w-auto">Kirim Pesan</x-button>
                                <p class="mt-4 text-tiny text-charcoal">
                                    Data Anda hanya kami gunakan untuk membalas permintaan ini.
                                    <a href="{{ route('privacy') }}"
                                       class="underline decoration-line underline-offset-2 transition-colors duration-150 hover:text-navy hover:decoration-navy">
                                        Kebijakan privasi
                                    </a>.
                                </p>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </x-container>
    </x-section>
</x-layout>
