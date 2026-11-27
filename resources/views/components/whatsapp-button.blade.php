@use('App\Support\WhatsApp')

{{--
    Tombol WhatsApp mengambang: lingkaran signal 56 px, ikon navy, kanan bawah,
    tampil di semua halaman (docs/DESIGN.md bagian 7).
    Fokus memakai dua warna supaya terlihat di atas latar terang maupun navy.
--}}
<a href="{{ WhatsApp::link() }}"
   target="_blank"
   rel="noopener"
   aria-label="Chat WhatsApp"
   class="wa-float fixed bottom-5 right-5 z-40 inline-flex h-14 w-14 items-center justify-center rounded-full bg-signal text-navy transition-colors duration-150 hover:bg-signal-hover focus-visible:outline-white focus-visible:ring-2 focus-visible:ring-navy lg:hidden">
    <x-site-icon name="chat-bubble-left-right" class="h-7 w-7" />
</a>
