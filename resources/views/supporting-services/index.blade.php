<x-layout :title="$seo['title']" :description="$seo['description']">
    <x-page-cover eyebrow="Add-on"
                  title="Layanan Pendukung"
                  title-id="judul-pendukung"
                  intro="Add-on untuk melengkapi acara Anda, dari perlengkapan dan panggung hingga konsumsi dan dokumentasi."
                  action-label="Lihat kategori"
                  action-href="#judul-kategori">
        <x-slot:meta>
            <p class="text-label font-semibold uppercase tracking-label text-mist">
                <span class="text-white">{{ str_pad((string) $categories->count(), 2, '0', STR_PAD_LEFT) }}</span> Kategori
            </p>
        </x-slot:meta>
    </x-page-cover>

    <x-section tone="mist" aria-labelledby="judul-kategori">
        <x-container>
            <div class="grid gap-6 lg:grid-cols-12 lg:items-end lg:gap-10" data-reveal>
                <div class="lg:col-span-7">
                    <x-eyebrow>Kategori</x-eyebrow>
                    <h2 id="judul-kategori" class="mt-4 font-display text-chapter font-bold tracking-heading text-navy">
                        Kategori layanan pendukung
                    </h2>
                </div>
                <div class="lg:col-span-5">
                    <p class="max-w-prose text-lead text-charcoal">
                        Pilih kebutuhan tambahan untuk acara Anda. Semua item disesuaikan dengan lokasi, jumlah peserta, dan konsep acara.
                    </p>
                </div>
            </div>

            <div class="mt-10 grid gap-x-8 gap-y-8 border-t-2 border-navy pt-8 lg:mt-12 lg:grid-cols-12 lg:pt-10">
                @foreach ($categories as $category)
                    <article id="kategori-{{ $category->slug }}"
                             aria-labelledby="judul-kategori-{{ $category->slug }}"
                             @class([
                                 'md:col-span-6' => ! $loop->first,
                                 'md:col-span-12 lg:col-span-7' => $loop->first,
                                 'lg:col-span-5' => $loop->iteration === 2,
                                 'lg:col-span-4' => $loop->iteration > 2,
                                 'border-t border-line pt-6' => ! $loop->first,
                                 'lg:border-t-0 lg:pt-0' => $loop->iteration === 2,
                             ])>
                        <p class="flex flex-wrap items-center gap-x-3 gap-y-1 text-label font-semibold uppercase tracking-label text-charcoal">
                            <span class="tabular-nums text-navy" aria-hidden="true">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                            <span class="h-px w-6 shrink-0 bg-signal" aria-hidden="true"></span>
                            <span>Kategori</span>
                            <span class="ml-auto tabular-nums">{{ $category->items->count() }} item</span>
                        </p>

                        <h3 id="judul-kategori-{{ $category->slug }}"
                            @class([
                                'mt-4 font-display font-bold tracking-heading text-navy',
                                'text-quote' => $loop->iteration <= 2,
                                'text-card-lg' => $loop->iteration > 2,
                            ])>
                            {{ $category->name }}
                        </h3>

                        <ul @class([
                            'mt-6',
                            'grid gap-6 sm:grid-cols-3 lg:gap-5' => $loop->first,
                            'space-y-5' => ! $loop->first,
                        ])>
                            @foreach ($category->items as $item)
                                <li @class(['border-t border-line pt-4' => $loop->parent->first])>
                                    @if ($item->name !== $category->name)
                                        <h4 class="text-body font-semibold text-navy">{{ $item->name }}</h4>
                                    @endif
                                    <p @class(['text-small text-charcoal', 'mt-2' => $item->name !== $category->name])>{{ $item->description }}</p>
                                </li>
                            @endforeach
                        </ul>
                    </article>
                @endforeach
            </div>
        </x-container>
    </x-section>

    <x-section>
        <x-container class="pb-10" data-reveal>
            <x-cta-card
                title="Lengkapi acara Anda"
                text="Sampaikan kebutuhan tambahan Anda, kami bantu sesuaikan dengan konsep dan anggaran acara." />
        </x-container>
    </x-section>
</x-layout>
