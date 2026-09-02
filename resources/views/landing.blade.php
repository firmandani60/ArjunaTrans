<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Arjuna Trans - layanan transportasi wisata dan perjalanan rombongan dengan armada nyaman dan terawat.">
    <title>Arjuna Trans | Perjalanan Wisata Nyaman</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <style>
        [x-cloak] {
            display: none !important;
        }

        .section-kicker {
            letter-spacing: .18em;
        }
    </style>
</head>

<body class="bg-[#fffaf7] text-stone-900 antialiased">
    @php
    $imageUrl = function (?string $path, string $fallback) {
    if (!$path) return $fallback;
    if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://') || str_starts_with($path, 'data:'))
    return $path;
    return asset('storage/'.ltrim($path, '/'));
    };
    $waNumber = preg_replace('/\D+/', '', $contact?->whatsapp ?? '628124320296');
    if (str_starts_with($waNumber, '0')) $waNumber = '62'.substr($waNumber, 1);
    $waLink = 'https://wa.me/'.$waNumber;
    @endphp

    <header class="sticky top-0 z-50 border-b border-orange-100/80 bg-[#fffaf7]/95 backdrop-blur">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-5 py-4 lg:px-8">
            <a href="#beranda" class="text-xl font-black tracking-tight"><span class="text-orange-600">Arjuna</span>
                Trans</a>
            <nav class="hidden items-center gap-8 text-sm font-semibold text-stone-600 md:flex">
                <a href="#beranda" class="transition hover:text-orange-600">Beranda</a>
                <a href="#tentang" class="transition hover:text-orange-600">Tentang Kami</a>
                <a href="#armada" class="transition hover:text-orange-600">Armada</a>
                <a href="#tujuan" class="transition hover:text-orange-600">Tujuan</a>
                <a href="#cara-pesan" class="transition hover:text-orange-600">Cara Pesan</a>
                <a href="#kontak" class="transition hover:text-orange-600">Kontak</a>
            </nav>
            <a href="{{ $waLink }}" target="_blank" class="rounded-full bg-orange-600 px-5 py-2.5 text-sm font-bold text-white shadow-lg shadow-orange-600/20 transition hover:bg-orange-700">Pesan
                Sekarang</a>
        </div>
    </header>

    <main>
        {{-- Hero --}}
        <section id="beranda" class="relative isolate overflow-hidden bg-stone-950 bg-[url({{ $imageUrl($hero?->image_path, 'https://picsum.photos/seed/arjuna-main/1800/1000') }})] bg-fixed bg-cover bg-center bg-no-repeat bg-opacity-60">
            {{-- <img src="{{ $imageUrl($hero?->image_path, 'https://picsum.photos/seed/arjuna-main/1800/1000') }}" alt="{{ $hero?->image_alt ?: 'Armada Arjuna Trans' }}" class="absolute inset-0 -z-20 h-full w-full object-cover opacity-60"> --}}
            <div class="absolute inset-0 -z-10 bg-black/50"></div>
            <div class="mx-auto grid min-h-[650px] max-w-7xl items-center px-5 py-24 lg:px-8">
                <div class="max-w-3xl text-white">
                    <span class="inline-flex items-center rounded-full border border-orange-400/30 bg-black/25 px-4 py-2 text-xs font-bold uppercase tracking-[.16em] text-orange-200">
                        {{ $hero?->badge ?: 'Mitra Perjalanan Terpercaya' }}
                    </span>
                    <h1 class="mt-6 text-4xl font-black leading-tight sm:text-5xl lg:text-6xl">
                        {{ $hero?->title ?: 'Eksplorasi Perjalanan Tanpa Batas dengan Kenyamanan Eksekutif' }}
                    </h1>
                    <p class="mt-6 max-w-2xl text-base leading-8 text-stone-200 sm:text-lg">{{ $hero?->description }}
                    </p>
                    <div class="mt-8 flex flex-wrap gap-3">
                        <a href="{{ $hero?->primary_button_url ?: '#cara-pesan' }}" class="inline-flex items-center gap-2 rounded-xl bg-orange-600 px-6 py-3.5 text-sm font-extrabold text-white transition hover:bg-orange-700">
                            <i data-lucide="ticket-check" class="h-4 w-4"></i>{{ $hero?->primary_button_label ?: 'Booking Perjalanan' }}
                        </a>
                        <a href="{{ $hero?->secondary_button_url ?: $waLink }}" target="_blank"
                            class="inline-flex items-center gap-2 rounded-xl border border-white/20 bg-white/10 px-6 py-3.5 text-sm font-bold text-white backdrop-blur transition hover:bg-white/20">
                            <i data-lucide="message-circle" class="h-4 w-4"></i>{{ $hero?->secondary_button_label ?: 'WhatsApp Admin' }}
                        </a>
                    </div>
                </div>
            </div>
        </section>

        {{-- Keunggulan --}}
        <section class="px-5 py-20 lg:px-8">
            <div class="mx-auto max-w-7xl">
                <div class="text-center">
                    <p class="section-kicker text-xs font-black uppercase text-orange-600">Mengapa Memilih Kami</p>
                    <h2 class="mt-3 text-3xl font-black tracking-tight sm:text-4xl">Keunggulan Arjuna Trans</h2>
                    <div class="mx-auto mt-4 h-1 w-14 rounded-full bg-orange-600"></div>
                </div>
                <div class="mt-12 grid gap-5 md:grid-cols-2 lg:grid-cols-3">
                    @forelse($advantages as $advantage)
                    <article class="rounded-[28px] border border-orange-100 bg-white p-7 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                        <div class="grid h-12 w-12 place-items-center rounded-2xl bg-orange-50 text-orange-600">
                            <span class="material-symbols-outlined h-6 w-6">{{ $advantage->icon ?: 'star' }}</span>
                        </div>
                        <h3 class="mt-6 text-lg font-black">{{ $advantage->title }}</h3>
                        <p class="mt-3 text-sm leading-7 text-stone-600">{{ $advantage->description }}</p>
                    </article>
                    @empty
                    <p class="col-span-full text-center text-stone-500">Data keunggulan belum tersedia.</p>
                    @endforelse
                </div>
            </div>
        </section>

        {{-- Fasilitas & layanan --}}
        <section class="bg-[#fff1eb] px-5 py-20 lg:px-8">
            <div class="mx-auto max-w-7xl">
                <div class="text-center">
                    <p class="section-kicker text-xs font-black uppercase text-orange-600">Fasilitas & Layanan</p>
                    <h2 class="mt-3 text-3xl font-black sm:text-4xl">Prioritas Kenyamanan Anda</h2>
                    <div class="mx-auto mt-4 h-1 w-14 rounded-full bg-orange-600"></div>
                </div>
                <div class="mt-12 grid gap-6 md:grid-cols-2">
                    @foreach($services as $service)
                    <article class="overflow-hidden rounded-[28px] bg-white shadow-sm">
                        <img src="{{ $imageUrl($service->gambar, 'https://picsum.photos/seed/service-'.$service->id_layanan.'/900/560') }}" alt="{{ $service->jenis_layanan }}" class="h-64 w-full object-cover">

                        <div class="p-7">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <p class="text-xs font-black uppercase tracking-wider text-orange-600">Layanan</p>

                                    <h3 class="mt-2 text-2xl font-black">
                                        {{ $service->jenis_layanan }}
                                    </h3>
                                </div>

                                <span class="text-4xl font-black text-orange-100">
                                    {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                </span>
                            </div>

                            <p class="mt-4 text-sm leading-7 text-stone-600">
                                {{ $service->deskripsi }}
                            </p>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Tentang --}}
        <section id="tentang" class="px-5 py-20 lg:px-8">
            <div class="mx-auto grid max-w-7xl gap-12 lg:grid-cols-2 lg:items-center">
                <div class="grid grid-cols-2 gap-4">
                    @forelse($about?->galleryImages ?? collect() as $image)
                    <img src="{{ $imageUrl($image->image_path, 'https://picsum.photos/seed/about-'.$loop->iteration.'/600/760') }}" alt="{{ $image->alt_text ?: 'Armada Arjuna Trans' }}"
                        class="h-60 w-full rounded-[26px] object-cover {{ $loop->even ? 'translate-y-6' : '' }}">
                    @empty
                    <img src="https://picsum.photos/seed/about-a/600/760" alt="Armada" class="h-60 w-full rounded-[26px] object-cover">
                    <img src="https://picsum.photos/seed/about-b/600/760" alt="Armada" class="h-60 w-full translate-y-6 rounded-[26px] object-cover">
                    @endforelse
                </div>
                <div>
                    <p class="section-kicker text-xs font-black uppercase text-orange-600">
                        {{ $about?->eyebrow ?: 'Tentang Kami' }}</p>
                    <h2 class="mt-3 text-3xl font-black leading-tight sm:text-4xl">
                        {{ $about?->title ?: 'Mendefinisikan Ulang Perjalanan Wisata Anda' }}</h2>
                    <p class="mt-6 text-base leading-8 text-stone-600">{{ $about?->description }}</p>
                    <div class="mt-8 grid gap-3 sm:grid-cols-2">
                        @foreach(['Armada High-Spec', 'Kabin Steril & Wangi', 'Driver Profesional', 'Hiburan Full Karaoke'] as $feature)
                        <div class="flex items-center gap-3 rounded-2xl bg-orange-50 px-4 py-3 text-sm font-bold text-stone-700">
                            <span class="grid h-7 w-7 place-items-center rounded-full bg-white text-orange-600">✓</span>{{ $feature }}
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        {{-- Katalog Armada --}}
        <section id="armada" class="bg-white px-5 py-20 lg:px-8">
            <div class="mx-auto max-w-7xl">
                <div class="flex flex-col justify-between gap-5 md:flex-row md:items-end">
                    <div>
                        <p class="section-kicker text-xs font-black uppercase text-orange-600">Pilihan Kendaraan</p>
                        <h2 class="mt-3 text-3xl font-black sm:text-4xl">Katalog Armada Kami</h2>
                    </div>
                    <a href="{{ $waLink }}" target="_blank" class="text-sm font-extrabold text-orange-600 hover:text-orange-700">Tanyakan ketersediaan →</a>
                </div>
                <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach($fleets as $fleet)
                    <article class="overflow-hidden rounded-[26px] border border-stone-100 bg-[#fffaf7] shadow-sm">
                        <img src="{{ $imageUrl($fleet->image_path, 'https://picsum.photos/seed/fleet-'.$fleet->id.'/700/520') }}" alt="{{ $fleet->name }}" class="h-48 w-full object-cover">
                        <div class="p-5">
                            <span class="rounded-full bg-orange-100 px-3 py-1 text-[11px] font-black uppercase text-orange-700">{{ $fleet->category }}</span>
                            <h3 class="mt-4 text-lg font-black">{{ $fleet->name }}</h3>
                            <p class="mt-2 text-sm leading-6 text-stone-600">{{ $fleet->description }}</p>
                            <div class="mt-5 flex flex-wrap gap-2 text-xs font-bold text-stone-600">
                                @if($fleet->capacity)<span class="rounded-lg bg-white px-2.5 py-1.5">{{ $fleet->capacity }}</span>@endif
                                @if($fleet->facilities)
                                @foreach(preg_split('/\s*[|,]\s*/', $fleet->facilities, -1, PREG_SPLIT_NO_EMPTY) as $facility)
                                <span class="rounded-lg bg-white px-2.5 py-1.5">{{ trim($facility) }}</span>
                                @endforeach
                                @endif
                                @if(($fleet->unit_count ?? 0) > 0)<span class="rounded-lg bg-white px-2.5 py-1.5">{{ $fleet->unit_count }} Unit</span>@endif
                            </div>
                            @if(($fleet->daily_price ?? 0) > 0)
                            <div class="mt-4 flex items-center justify-between border-t border-orange-100 pt-4">
                                <span class="text-xs font-bold text-stone-500">Mulai dari</span>
                                <span class="text-sm font-black text-orange-600">Rp
                                    {{ number_format($fleet->daily_price, 0, ',', '.') }} / hari</span>
                            </div>
                            @endif
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Section Galeri -->
        <section id="galeri" class="bg-[#fffaf7] px-5 py-20 lg:px-8">
            <div class="mx-auto max-w-7xl">
                <!-- Judul Section -->
                <div class="text-center">
                    <p class="section-kicker text-xs font-black uppercase text-orange-600">Koleksi Visual</p>
                    <h2 class="mt-3 text-3xl font-black sm:text-4xl">Galeri Arjuna Trans</h2>
                    <div class="mx-auto mt-4 h-1 w-14 rounded-full bg-orange-600"></div>
                </div>

                <!-- Tombol Filter -->
                <div class="mt-10 flex flex-wrap justify-center gap-3" id="filter-buttons">
                    <button class="filter-btn active rounded-full bg-orange-600 px-6 py-2 text-sm font-bold text-white shadow-md transition hover:bg-orange-700" data-filter="semua">Semua</button>
                    <button class="filter-btn rounded-full bg-orange-100 px-6 py-2 text-sm font-bold text-orange-700 transition hover:bg-orange-200" data-filter="armada">Armada</button>
                    <button class="filter-btn rounded-full bg-orange-100 px-6 py-2 text-sm font-bold text-orange-700 transition hover:bg-orange-200" data-filter="destinasi">Destinasi</button>
                </div>

                <!-- Grid Foto (Seragam) -->
                <div class="mt-10 grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3" id="gallery-grid">
                    <!-- Foto Armada -->
                    <div class="gallery-item overflow-hidden rounded-[26px] shadow-sm transition duration-300 hover:shadow-xl cursor-pointer" data-category="armada" onclick="openLightbox(this)">
                        <img src="https://loremflickr.com/800/600/bus?random=11" alt="Armada 1" class="h-64 w-full object-cover transition duration-500 hover:scale-110">
                    </div>
                    <!-- Foto Destinasi -->
                    <div class="gallery-item overflow-hidden rounded-[26px] shadow-sm transition duration-300 hover:shadow-xl cursor-pointer" data-category="destinasi" onclick="openLightbox(this)">
                        <img src="https://loremflickr.com/600/800/nature?random=12" alt="Destinasi 1" class="h-64 w-full object-cover transition duration-500 hover:scale-110">
                    </div>
                    <!-- Foto Armada -->
                    <div class="gallery-item overflow-hidden rounded-[26px] shadow-sm transition duration-300 hover:shadow-xl cursor-pointer" data-category="armada" onclick="openLightbox(this)">
                        <img src="https://loremflickr.com/800/800/bus?random=13" alt="Armada 2" class="h-64 w-full object-cover transition duration-500 hover:scale-110">
                    </div>
                    <!-- Foto Destinasi -->
                    <div class="gallery-item overflow-hidden rounded-[26px] shadow-sm transition duration-300 hover:shadow-xl cursor-pointer" data-category="destinasi" onclick="openLightbox(this)">
                        <img src="https://loremflickr.com/800/500/landscape?random=14" alt="Destinasi 2" class="h-64 w-full object-cover transition duration-500 hover:scale-110">
                    </div>
                    <!-- Foto Destinasi -->
                    <div class="gallery-item overflow-hidden rounded-[26px] shadow-sm transition duration-300 hover:shadow-xl cursor-pointer" data-category="destinasi" onclick="openLightbox(this)">
                        <img src="https://loremflickr.com/600/900/nature?random=15" alt="Destinasi 3" class="h-64 w-full object-cover transition duration-500 hover:scale-110">
                    </div>
                    <!-- Foto Armada -->
                    <div class="gallery-item overflow-hidden rounded-[26px] shadow-sm transition duration-300 hover:shadow-xl cursor-pointer" data-category="armada" onclick="openLightbox(this)">
                        <img src="https://loremflickr.com/800/600/transport?random=16" alt="Armada 3" class="h-64 w-full object-cover transition duration-500 hover:scale-110">
                    </div>
                </div>
            </div>
        </section>

        <!-- Lightbox Modal -->
        <div id="lightbox" class="fixed inset-0 z-[100] hidden items-center justify-center bg-stone-900/80 p-5 backdrop-blur-sm transition-opacity duration-300 opacity-0" onclick="closeLightbox(event)">
            <button class="absolute right-6 top-6 text-white/70 transition hover:scale-110 hover:text-orange-400" onclick="closeLightbox(event, true)">
                <span class="material-symbols-outlined text-4xl">close</span>
            </button>
            <img id="lightbox-img" src="" alt="Preview" class="max-h-[90vh] max-w-full rounded-[26px] object-contain shadow-2xl transition-transform duration-300 scale-95">
        </div>

        {{-- Tujuan --}}
        <section id="tujuan" class="bg-[#3a2119] px-5 py-20 text-white lg:px-8">
            <div class="mx-auto grid max-w-7xl gap-10 lg:grid-cols-[.9fr_1.1fr]">
                <div>
                    <p class="section-kicker text-xs font-black uppercase text-orange-300">Destinasi Populer</p>
                    <h2 class="mt-3 text-3xl font-black leading-tight sm:text-4xl">Eksplorasi Keindahan Jawa dengan
                        Arjuna Trans</h2>
                    <p class="mt-5 text-sm leading-7 text-stone-300">Pilih destinasi favorit Anda. Data tujuan ini
                        langsung dikelola dari halaman admin.</p>
                    <div class="mt-8 space-y-3">
                        @foreach($destinations as $destination)
                        <div class="rounded-2xl bg-white/8 p-5 ring-1 ring-white/10">
                            <div class="flex gap-4">
                                <span class="text-lg font-black text-orange-400">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                                <div>
                                    <h3 class="font-black">{{ $destination->name }}</h3>
                                    <p class="mt-1 text-xs leading-5 text-stone-300">{{ $destination->description }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4 self-center">
                    @foreach($destinations->take(7) as $destination)
                    <figure class="relative overflow-hidden rounded-[26px] {{ $loop->even ? 'translate-y-8' : '' }}">
                        <img src="{{ $imageUrl($destination->image_path, 'https://picsum.photos/seed/dest-'.$destination->id.'/650/760') }}" alt="{{ $destination->name }}" class="h-64 w-full object-cover">
                        <figcaption class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/80 to-transparent p-5 pt-12 text-sm font-black">
                            {{ $destination->name }}</figcaption>
                    </figure>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Daftar Rute & Harga Sewa --}}
        <section class="px-5 py-20 lg:px-8">
            <div class="mx-auto max-w-7xl">
                <div class="text-center">
                    <p class="section-kicker text-xs font-black uppercase text-orange-600">Destinasi Populer</p>
                    <h2 class="mt-3 text-3xl font-black sm:text-4xl">Daftar Rute & Harga Sewa</h2>
                    <p class="mx-auto mt-4 max-w-3xl text-sm leading-7 text-stone-600">Harga dapat diperbarui dari panel
                        admin. Konfirmasi kembali untuk tanggal, durasi, dan titik penjemputan Anda.</p>
                </div>
                <div class="mt-10 grid gap-6 md:grid-cols-2 xl:grid-cols-4">
                    @foreach($routes as $route)
                    <article class="overflow-hidden rounded-[26px] border border-orange-100 bg-white shadow-sm">
                        <div class="relative">
                            <img src="{{ $imageUrl($route->image_path, 'https://picsum.photos/seed/route-'.$route->id.'/700/520') }}" alt="{{ $route->destination_name }}" class="h-44 w-full object-cover">
                            <span class="absolute left-4 top-4 rounded-lg bg-orange-600 px-3 py-1 text-[10px] font-semibold uppercase text-white">{{ $route->fleet?->name ?? $route->fleet_name ?? 'Armada' }}</span>
                        </div>
                        <div class="p-5">
                            <h3 class="text-xl font-black">{{ $route->destination?->name ?? $route->destination_name }}
                            </h3>
                            <p class="mt-1 text-xs leading-5 text-stone-500">{{ $route->route_description }}</p>
                            <div class="mt-5 rounded-xl bg-orange-50 p-4">
                                <div class="flex flex-col items-center justify-between gap-3">
                                    <div class="flex flex-col items-center rounded-lg bg-white px-5 py-2 text-center">
                                        <p class="text-[10px] font-bold uppercase text-stone-400">Armada</p>
                                        <p class="mt-0.5 text-xs font-semibold text-stone-700">
                                            {{ $route->fleet?->name ?? $route->fleet_name ?? '-' }}</p>
                                    </div>
                                    <div class="flex flex-col items-center px-3 py-2">
                                        <p class="text-[10px] font-bold uppercase tracking-wider text-stone-500">Harga
                                            Sewa</p>
                                        <p class="mt-1 text-lg font-black text-orange-700">Rp
                                            {{ number_format($route->price ?? $route->elf_long_price ?? $route->medium_bus_price ?? 0, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ $waLink }}" target="_blank" class="mt-5 block rounded-xl bg-[#fff1eb] px-4 py-2.5 text-center text-xs font-black text-orange-700 transition hover:bg-orange-100">Pesan
                                Armada →</a>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Alur Pemesanan --}}
        <section id="cara-pesan" class="bg-[#25130f] px-5 py-20 text-white lg:px-8">
            <div class="mx-auto grid max-w-7xl gap-12 lg:grid-cols-[.8fr_1.2fr]">
                <div>
                    <p class="section-kicker text-xs font-black uppercase text-orange-400">Alur Pemesanan</p>
                    <h2 class="mt-3 text-3xl font-black sm:text-4xl">Cara Pemesanan Arjuna Pariwisata</h2>
                    <p class="mt-5 text-sm leading-7 text-stone-300">Kami menyediakan alur booking ringkas agar Anda
                        tidak kehilangan waktu berharga.</p>
                    <a href="{{ $waLink }}" target="_blank" class="mt-7 inline-flex items-center gap-2 rounded-xl bg-orange-600 px-5 py-3 text-sm font-black hover:bg-orange-700"><i data-lucide="message-circle" class="h-4 w-4"></i> Hubungi Admin
                        Sekarang</a>
                </div>
                <div class="space-y-5">
                    @foreach($orderSteps as $step)
                    <div class="grid grid-cols-[56px_1fr] gap-5">
                        <span class="grid h-12 w-12 place-items-center rounded-2xl bg-orange-600 font-black">{{ $loop->iteration }}</span>
                        <div class="border-b border-white/10 pb-5">
                            <h3 class="font-black">{{ $step->title }}</h3>
                            <p class="mt-2 text-sm leading-7 text-stone-300">{{ $step->description }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
    </main>

<footer id="kontak" class="bg-[#fffaf7] px-5 py-16 lg:px-8">
    <div class="mx-auto grid max-w-7xl gap-10 border-b border-orange-100 pb-12 md:grid-cols-2 lg:grid-cols-4">

        {{-- =========================
            ARJUNA TRANS + MAPS
        ========================== --}}
        <div>
            <div class="text-xl font-black">
                <span class="text-orange-600">Arjuna</span> Trans
            </div>

            <p class="mt-4 text-sm leading-7 text-stone-600">
                {{ $contact?->description }}
            </p>

            {{-- Google Maps --}}
@if($contact?->maps_link)
    <div class="mt-5 overflow-hidden rounded-xl border border-orange-100 shadow-sm">
        <iframe
            src="{{ $contact->maps_link }}"
            width="100%"
            height="180"
            style="border:0;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="strict-origin-when-cross-origin">
        </iframe>
    </div>
@endif
        </div>


        {{-- =========================
            NAVIGASI
        ========================== --}}
        <div>
            <h3 class="text-sm font-black uppercase tracking-wider text-orange-600">
                Navigasi
            </h3>

            <div class="mt-4 space-y-3 text-sm text-stone-600">
                <a class="block hover:text-orange-600" href="#beranda">
                    Beranda
                </a>

                <a class="block hover:text-orange-600" href="#armada">
                    Daftar Armada
                </a>

                <a class="block hover:text-orange-600" href="#tujuan">
                    Pilihan Tujuan
                </a>

                <a class="block hover:text-orange-600" href="#cara-pesan">
                    Cara Pesan
                </a>
            </div>
        </div>


        {{-- =========================
            INFORMASI
        ========================== --}}
        <div>
            <h3 class="text-sm font-black uppercase tracking-wider text-orange-600">
                Informasi
            </h3>

            <div class="mt-4 space-y-3 text-sm text-stone-600">
                <p>Syarat & Ketentuan</p>
                <p>Kebijakan Privasi</p>
                <p>Testimoni</p>
                <p>Karir Sopir</p>
            </div>
        </div>


        {{-- =========================
            KANTOR KAMI
        ========================== --}}
        <div>
            <h3 class="text-sm font-black uppercase tracking-wider text-orange-600">
                Kantor Kami
            </h3>

            <div class="mt-4 space-y-4 text-sm leading-6 text-stone-600">

                {{-- Alamat --}}
                @if($contact?->address)
                    <p class="flex gap-3">
                        <i
                            data-lucide="map-pin"
                            class="mt-1 h-5 w-5 shrink-0 text-orange-600">
                        </i>

                        <span>
                            {{ $contact->address }}
                        </span>
                    </p>
                @endif


                {{-- WhatsApp --}}
                @if($contact?->whatsapps && $contact->whatsapps->count())
                    @foreach($contact->whatsapps as $wa)
                        <a
                            href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $wa->phone_number) }}"
                            target="_blank"
                            class="flex gap-3 hover:text-orange-600">

                            <i
                                data-lucide="phone"
                                class="mt-1 h-5 w-5 shrink-0 text-orange-600">
                            </i>

                            <span>
                                {{ $wa->phone_number }}
                            </span>
                        </a>
                    @endforeach
                @endif


                {{-- Email --}}
                @if($contact?->email)
                    <a
                        href="mailto:{{ $contact->email }}"
                        class="flex gap-3 hover:text-orange-600">

                        <i
                            data-lucide="mail"
                            class="mt-1 h-5 w-5 shrink-0 text-orange-600">
                        </i>

                        <span>
                            {{ $contact->email }}
                        </span>
                    </a>
                @endif


                {{-- =========================
    SOCIAL MEDIA
========================== --}}
<div class="flex items-center gap-4 pt-2">

    {{-- Instagram --}}
    @if($contact?->instagram)
        <a
            href="{{ $contact->instagram }}"
            target="_blank"
            rel="noopener noreferrer"
            title="Instagram"
            class="text-stone-500 transition hover:text-orange-600">

            <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="currentColor"
                class="h-5 w-5">

                <path d="M7.75 2h8.5A5.75 5.75 0 0 1 22 7.75v8.5A5.75 5.75 0 0 1 16.25 22h-8.5A5.75 5.75 0 0 1 2 16.25v-8.5A5.75 5.75 0 0 1 7.75 2Zm0 2A3.75 3.75 0 0 0 4 7.75v8.5A3.75 3.75 0 0 0 7.75 20h8.5A3.75 3.75 0 0 0 20 16.25v-8.5A3.75 3.75 0 0 0 16.25 4h-8.5Zm4.25 3.25a4.75 4.75 0 1 1 0 9.5 4.75 4.75 0 0 1 0-9.5Zm0 2a2.75 2.75 0 1 0 0 5.5 2.75 2.75 0 0 0 0-5.5Zm5-2.25a1.125 1.125 0 1 1 0 2.25 1.125 1.125 0 0 1 0-2.25Z"/>
            </svg>
        </a>
    @endif


    {{-- Facebook --}}
    @if($contact?->facebook)
        <a
            href="{{ $contact->facebook }}"
            target="_blank"
            rel="noopener noreferrer"
            title="Facebook"
            class="text-stone-500 transition hover:text-orange-600">

            <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="currentColor"
                class="h-5 w-5">

                <path d="M13.5 21v-8h2.75l.5-3H13.5V8.25c0-.9.3-1.5 1.6-1.5h1.8V4.05c-.3-.05-1.3-.15-2.5-.15-2.5 0-4.15 1.5-4.15 4.3V10H7.5v3h2.75v8h3.25Z"/>
            </svg>
        </a>
    @endif


    {{-- YouTube --}}
    @if($contact?->youtube)
        <a
            href="{{ $contact->youtube }}"
            target="_blank"
            rel="noopener noreferrer"
            title="YouTube"
            class="text-stone-500 transition hover:text-orange-600">

            <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="currentColor"
                class="h-5 w-5">

                <path d="M23.5 6.2a3 3 0 0 0-2.1-2.1C19.5 3.5 12 3.5 12 3.5s-7.5 0-9.4.6A3 3 0 0 0 .5 6.2 31 31 0 0 0 0 12a31 31 0 0 0 .5 5.8 3 3 0 0 0 2.1 2.1c1.9.6 9.4.6 9.4.6s7.5 0 9.4-.6a3 3 0 0 0 2.1-2.1A31 31 0 0 0 24 12a31 31 0 0 0-.5-5.8ZM9.5 15.5v-7l6 3.5-6 3.5Z"/>
            </svg>
        </a>
    @endif


    {{-- TikTok --}}
    @if($contact?->tiktok)
        <a
            href="{{ $contact->tiktok }}"
            target="_blank"
            rel="noopener noreferrer"
            title="TikTok"
            class="text-stone-500 transition hover:text-orange-600">

            <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="currentColor"
                class="h-5 w-5">

                <path d="M19.589 6.686a4.793 4.793 0 0 1-3.77-3.77A4.796 4.796 0 0 1 15.734 2h-3.268v13.574a2.816 2.816 0 1 1-1.934-2.674V9.58a6.08 6.08 0 1 0 5.286 6V9.394a8.018 8.018 0 0 0 4.686 1.502V7.63a4.788 4.788 0 0 1-.915-.944z"/>
            </svg>
        </a>
    @endif

</div>

                </div>

            </div>
        </div>

    </div>




    {{-- =========================
         COPYRIGHT
    ========================== --}}
    <div class="mx-auto flex max-w-7xl flex-col gap-4 pt-7 text-xs text-stone-500 sm:flex-row sm:items-center sm:justify-between">

        <p>
            © {{ now()->year }} Arjuna Trans.
            Crafted for Premium Travel Experience.
        </p>

        <p>
            Hubungi kami untuk informasi perjalanan.
        </p>

    </div>
</footer>

    <a href="{{ $waLink }}" target="_blank" aria-label="Hubungi Admin melalui WhatsApp"
        class="fixed bottom-5 right-5 z-50 inline-flex items-center gap-2 rounded-full bg-emerald-500 px-5 py-3 text-sm font-black text-white shadow-2xl transition hover:-translate-y-1 hover:bg-emerald-600">
        <i data-lucide="message-circle" class="h-5 w-5"></i><span class="hidden sm:inline">Hubungi Admin</span>
    </a>

    <script>
        document.addEventListener('DOMContentLoaded', () => window.lucide && lucide.createIcons());
    </script>

    {{-- Script Section Gallery --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const filterBtns = document.querySelectorAll('.filter-btn');
            const galleryItems = document.querySelectorAll('.gallery-item');

            filterBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    // Reset semua tombol ke warna pastel (orange-100)
                    filterBtns.forEach(b => {
                        b.classList.remove('bg-orange-600', 'text-white', 'shadow-md');
                        b.classList.add('bg-orange-100', 'text-orange-700');
                    });
                    
                    // Ubah warna tombol yang sedang diklik jadi solid
                    btn.classList.remove('bg-orange-100', 'text-orange-700');
                    btn.classList.add('bg-orange-600', 'text-white', 'shadow-md');

                    // Logika memfilter gambar
                    const filterValue = btn.getAttribute('data-filter');
                    galleryItems.forEach(item => {
                        if (filterValue === 'semua' || item.getAttribute('data-category') === filterValue) {
                            item.style.display = 'block';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                });
            });
        });

        // Fungsi untuk membuka Lightbox
        function openLightbox(element) {
            const img = element.querySelector('img');
            const lightbox = document.getElementById('lightbox');
            const lightboxImg = document.getElementById('lightbox-img');

            lightboxImg.src = img.src;
            lightbox.classList.remove('hidden');
            lightbox.classList.add('flex');
            
            // Sedikit delay agar transisi opacity dan scale terlihat mulus
            setTimeout(() => {
                lightbox.classList.remove('opacity-0');
                lightboxImg.classList.remove('scale-95');
                lightboxImg.classList.add('scale-100');
            }, 10);
            
            // Mencegah body agar tidak bisa di-scroll saat lightbox terbuka
            document.body.style.overflow = 'hidden'; 
        }

        // Fungsi untuk menutup Lightbox
        function closeLightbox(event, force = false) {
            // Tutup jika tombol silang di-klik ATAU background gelap di-klik
            if (force || event.target.id === 'lightbox') {
                const lightbox = document.getElementById('lightbox');
                const lightboxImg = document.getElementById('lightbox-img');

                lightbox.classList.add('opacity-0');
                lightboxImg.classList.remove('scale-100');
                lightboxImg.classList.add('scale-95');

                setTimeout(() => {
                    lightbox.classList.add('hidden');
                    lightbox.classList.remove('flex');
                    document.body.style.overflow = 'auto'; // Kembalikan fungsi scroll
                }, 300);
            }
        }
    </script>
</body>

</html>