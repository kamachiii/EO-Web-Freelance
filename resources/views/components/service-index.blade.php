@props([
    'services',
    'detailed' => false,
])

{{--
    Katalog program (docs/DESIGN.md bagian 6): program pertama menjadi pembuka
    lebar, program berikutnya disusun grid dua kolom pada layar lebar. Satu
    tautan per item dengan area klik penuh.
--}}
<ul {{ $attributes->merge(['class' => '-mx-4 grid border-t-2 border-navy lg:-mx-6 lg:grid-cols-2 lg:gap-x-8']) }}>
    @foreach ($services as $service)
        @php
            $image = config('site.service_images.'.$service->slug);
            $number = str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT);
            $summary = $detailed && $service->description ? $service->description : $service->excerpt;
        @endphp

        <li @class([
            'border-b border-line',
            'lg:col-span-2' => $loop->first,
        ])>
            @if ($loop->first)
                <article class="group relative grid gap-8 px-4 py-8 transition-colors duration-300 ease-editorial hover:bg-mist focus-within:bg-mist md:grid-cols-12 md:items-center md:gap-10 md:px-6 md:py-10">
                    <div class="md:col-span-6">
                        <p class="flex items-center gap-3 text-label font-semibold uppercase tracking-label text-charcoal">
                            <span class="tabular-nums text-navy" aria-hidden="true">{{ $number }}</span>
                            <span class="h-px w-8 shrink-0 bg-signal" aria-hidden="true"></span>
                            <span>Program</span>
                        </p>

                        <h3 class="mt-5 text-pretty font-display text-chapter font-bold tracking-heading text-navy">
                            <a href="{{ route('services.show', $service) }}"
                               aria-label="Lihat detail {{ $service->name }}"
                               class="after:absolute after:inset-0 after:z-10">
                                <x-service-name :name="$service->name" />
                            </a>
                        </h3>

                        <p class="mt-4 max-w-prose text-lead text-charcoal">
                            {{ $summary }}
                        </p>

                        <span aria-hidden="true" class="mt-6 inline-flex min-h-11 items-center gap-2 text-label font-semibold uppercase tracking-label text-navy">
                            <span class="underline-offset-4 group-hover:underline group-focus-within:underline">Lihat detail</span>
                            <x-site-icon name="arrow-up-right" class="h-4 w-4 transition-transform duration-300 ease-editorial group-hover:-translate-y-0.5 group-hover:translate-x-0.5 group-focus-within:-translate-y-0.5 group-focus-within:translate-x-0.5" />
                        </span>
                    </div>

                    @if ($image)
                        <div class="md:col-span-6">
                            <div class="overflow-hidden bg-mist">
                                <img src="{{ asset($image['file']) }}"
                                     alt="{{ $image['alt'] }}"
                                     width="800" height="500"
                                     loading="lazy" decoding="async"
                                     class="aspect-[16/10] w-full object-cover transition-transform duration-500 ease-editorial group-hover:scale-[1.03] group-focus-within:scale-[1.03]">
                            </div>
                        </div>
                    @endif
                </article>
            @else
                <article class="group relative grid h-full grid-cols-12 gap-4 px-4 py-6 transition-colors duration-300 ease-editorial hover:bg-mist focus-within:bg-mist lg:gap-6 lg:px-6 lg:py-7">
                    <div class="col-span-12 flex flex-col md:col-span-9 lg:col-span-7">
                        <div class="flex items-baseline gap-3">
                            <span class="text-label font-semibold tabular-nums text-charcoal" aria-hidden="true">{{ $number }}</span>
                            <h3 class="text-pretty font-display text-card-lg font-bold tracking-heading text-navy transition-transform duration-300 ease-editorial group-hover:translate-x-0.5 group-focus-within:translate-x-0.5">
                                <a href="{{ route('services.show', $service) }}"
                                   aria-label="Lihat detail {{ $service->name }}"
                                   class="after:absolute after:inset-0 after:z-10">
                                    <x-service-name :name="$service->name" />
                                </a>
                            </h3>
                        </div>

                        <p class="mt-2 max-w-prose text-small text-charcoal">
                            {{ $summary }}
                        </p>

                        <span aria-hidden="true" class="mt-auto inline-flex min-h-11 items-center gap-2 pt-4 text-label font-semibold uppercase tracking-label text-navy">
                            <span class="underline-offset-4 group-hover:underline group-focus-within:underline">Lihat detail</span>
                            <x-site-icon name="arrow-up-right" class="h-4 w-4 transition-transform duration-300 ease-editorial group-hover:-translate-y-0.5 group-hover:translate-x-0.5 group-focus-within:-translate-y-0.5 group-focus-within:translate-x-0.5" />
                        </span>
                    </div>

                    @if ($image)
                        <div class="hidden md:col-span-3 md:block md:self-start lg:col-span-5">
                            <div class="overflow-hidden bg-mist">
                                <img src="{{ asset($image['file']) }}"
                                     alt="{{ $image['alt'] }}"
                                     width="800" height="500"
                                     loading="lazy" decoding="async"
                                     class="aspect-[4/3] w-full object-cover transition-transform duration-500 ease-editorial group-hover:scale-[1.03] group-focus-within:scale-[1.03]">
                            </div>
                        </div>
                    @endif
                </article>
            @endif
        </li>
    @endforeach
</ul>
