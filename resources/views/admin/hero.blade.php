@extends('layout.admin')
@section('title', 'Kelola Hero | Arjuna Trans')
@section('content')

<div x-data="heroEditor()" class="space-y-6">
    <section class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <button type="button" @click="saveHero()" class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-orange-500 to-orange-600 px-5 py-2.5 text-sm font-bold text-white shadow-[0_10px_25px_rgba(249,115,22,0.25)] transition hover:-translate-y-0.5 hover:from-orange-600 hover:to-orange-700">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
            Simpan Perubahan
        </button>
    </section>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-[1fr_1.1fr]">
        <div class="space-y-5">
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="text-base font-bold text-slate-900">Konfigurasi Konten</h2>
                <div class="mt-4 space-y-4">
                    <div>
                        <label class="mb-1 block text-sm font-bold text-slate-700">Judul Utama</label>
                        <input type="text" x-model="hero.judul" maxlength="50" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-sky-500 focus:ring-2 focus:ring-sky-100" placeholder="Perjalanan Aman dan Nyaman">
                        <p class="mt-1 text-xs text-slate-400">Maksimum 50 karakter untuk tampilan optimal.</p>
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-bold text-slate-700">Sub-deskripsi</label>
                        <textarea x-model="hero.sub_deskripsi" rows="3" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-sky-500 focus:ring-2 focus:ring-sky-100" placeholder="Nikmati pengalaman perjalanan terbaik..."></textarea>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="mb-1 block text-sm font-bold text-slate-700">Label Tombol Utama</label>
                            <input type="text" x-model="hero.tombol_label" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-sky-500 focus:ring-2 focus:ring-sky-100" placeholder="Pesan Sekarang">
                        </div>
                        <div>
                            <label class="mb-1 block text-sm font-bold text-slate-700">Tautan Tombol</label>
                            <input type="text" x-model="hero.tombol_link" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-sky-500 focus:ring-2 focus:ring-sky-100" placeholder="/booking">
                        </div>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="text-base font-bold text-slate-900">Media Latar Belakang</h2>
                <div class="mt-4">
                    <p class="text-sm font-semibold text-slate-700">Current Image</p>
                    <div class="mt-2 flex items-center gap-4 rounded-xl border border-slate-200 bg-slate-50 p-3">
                        <img :src="hero.gambar || 'https://picsum.photos/seed/arjuna/800/400'" alt="Preview" class="h-16 w-28 rounded-lg object-cover ring-1 ring-slate-200">
                        <div>
                            <p class="text-sm font-bold text-slate-800" x-text="hero.gambar_nama || 'Arjuna Trans - Pariwisata'">Arjuna Trans - Pariwisata</p>
                            <p class="text-xs text-slate-500" x-text="hero.gambar_keterangan || 'Astar Jampat Dior Tp Dior'">Astar Jampat Dior Tp Dior</p>
                        </div>
                    </div>

                    <div class="mt-4">
                        <label class="block cursor-pointer rounded-2xl border-2 border-dashed border-sky-200 bg-slate-50 px-5 py-6 text-center transition hover:border-sky-400 hover:bg-sky-50">
                            <svg class="mx-auto h-10 w-10 text-sky-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                            <span class="mt-2 block text-sm font-extrabold text-slate-800">Drag & drop new image</span>
                            <span class="mt-1 block text-xs text-slate-500">JPEG, PNG, WebP up to 5MB</span>
                            <input type="file" accept="image/*" class="sr-only" @change="handleImageUpload($event)">
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <x-live-preview>
            <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-inner">
                <div class="relative h-64 w-full bg-cover bg-center"
                    :style="'background-image: url(' + (hero.gambar || 'https://picsum.photos/seed/arjuna/800/400') + ');'">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/40 to-black/20"></div>
                    <div class="absolute inset-0 flex flex-col items-center justify-center px-6 text-center text-white">
                        <h1 class="text-2xl font-extrabold drop-shadow-lg" x-text="hero.judul || 'Perjalanan Aman dan Nyaman'">
                            Perjalanan Aman dan Nyaman
                        </h1>

                        <p class="mt-2 max-w-md text-sm leading-6 text-white/90 drop-shadow"
                            x-text="hero.sub_deskripsi || 'Nikmati pengalaman perjalanan terbaik bersama armada modern kami.'">
                            Nikmati pengalaman perjalanan terbaik bersama armada modern kami.
                        </p>
                        <a :href="hero.tombol_link || '#'"
                            class="mt-4 inline-block rounded-full bg-orange-500 px-8 py-2 text-sm font-bold text-white shadow-lg transition hover:bg-orange-600"
                            x-text="hero.tombol_label || 'Pesan Sekarang'"
                        >
                            Pesan Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </x-live-preview>
    </div>
</div>

@push('scripts')
<script>
    function heroEditor() {
        return {
            hero: @json($hero),
            saving: false,

            async handleImageUpload(event) {
                const file = event.target.files[0];
                if (!file) return;
                try {
                    const uploaded = await window.arjunaUploadImage(file);
                    this.hero.gambar = uploaded.url;
                    this.hero.gambar_path = uploaded.path;
                    this.hero.gambar_nama = uploaded.name;
                } catch (error) {
                    alert(error.message);
                }
            },

            async saveHero() {
                this.saving = true;
                try {
                    const response = await window.arjunaRequest(@json(route('admin.hero.update')), {
                        method: 'POST',
                        body: JSON.stringify(this.hero)
                    });
                    this.hero = response.data;
                    alert(response.message);
                } catch (error) {
                    alert(error.message);
                } finally {
                    this.saving = false;
                }
            }
        }
    }
</script>
@endpush
@endsection