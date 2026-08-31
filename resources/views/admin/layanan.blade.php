@extends('layout.admin')
@section('title', 'Layanan Arjuna Trans')
@section('content')

<div x-data="layananManager()" class="space-y-6">
    <section class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
        <button type="button" @click="saveAll()" class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-orange-500 to-orange-600 px-5 py-2.5 text-sm font-bold text-white shadow-[0_10px_25px_rgba(249,115,22,0.25)] transition hover:-translate-y-0.5 hover:from-orange-600 hover:to-orange-700">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
            Simpan Perubahan
        </button>
    </section>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-[1fr_1.1fr]">
        <section class="space-y-5">
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <h2 class="text-base font-bold text-slate-900">Daftar Layanan</h2>
                    <button type="button" @click="showNewForm = true" class="inline-flex items-center gap-1.5 rounded-lg bg-orange-500 px-3 py-1.5 text-xs font-bold text-white transition hover:bg-orange-600">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14"/></svg>
                        Tambah Layanan
                    </button>
                </div>

                <div class="mt-4 space-y-4">
                    <template x-if="showNewForm">
                        <div class="rounded-xl border border-orange-200 bg-orange-50/70 p-4">
                            <div class="space-y-3">
                                <div>
                                    <label class="mb-1 block text-[10px] font-bold uppercase text-slate-500">Judul Layanan</label>
                                    <input type="text" x-model="newItem.judul" placeholder="School Bus" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-orange-400 focus:ring-1 focus:ring-orange-400">
                                </div>
                                <div>
                                    <label class="mb-1 block text-[10px] font-bold uppercase text-slate-500">Ikon (Material Symbol)</label>
                                    <input type="text" x-model="newItem.ikon" placeholder="school" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-orange-400 focus:ring-1 focus:ring-orange-400">
                                </div>
                                <div>
                                    <label class="mb-1 block text-[10px] font-bold uppercase text-slate-500">Gambar</label>
                                    <div class="flex items-center gap-3">
                                        <img x-show="newItem.gambarPreview" :src="newItem.gambarPreview" class="h-14 w-20 rounded-lg object-cover ring-1 ring-slate-200">
                                        <div x-show="!newItem.gambarPreview" class="h-14 w-20 rounded-lg bg-slate-100 ring-1 ring-slate-200 flex items-center justify-center text-xs text-slate-400">No image</div>
                                        <label class="cursor-pointer rounded-lg bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-600 hover:bg-slate-200">
                                            Pilih
                                            <input type="file" accept="image/*" class="sr-only" @change="handleGambarBaru($event, 'newItem')">
                                        </label>
                                    </div>
                                </div>
                                <div>
                                    <label class="mb-1 block text-[10px] font-bold uppercase text-slate-500">Deskripsi</label>
                                    <textarea x-model="newItem.deskripsi" rows="2" placeholder="Layanan transportasi antar-jemput sekolah..." class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-orange-400 focus:ring-1 focus:ring-orange-400"></textarea>
                                </div>
                            </div>
                            <div class="mt-3 flex justify-end gap-2">
                                <button type="button" @click="batalTambah()" class="rounded-lg border border-slate-300 px-4 py-1.5 text-xs font-bold text-slate-600 hover:bg-slate-100">Batal</button>
                                <button type="button" @click="simpanTambah()" class="rounded-lg bg-orange-500 px-4 py-1.5 text-xs font-bold text-white hover:bg-orange-600">Simpan</button>
                            </div>
                        </div>
                    </template>

                    <template x-for="(item, index) in layanan" :key="item.id || index">
                        <div class="rounded-xl border border-slate-200 bg-slate-50/70 p-4">
                            <div class="flex items-start gap-3">
                                <div class="cursor-grab text-slate-400 hover:text-slate-600" @mousedown="startDrag($event, index)">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 8h16M4 16h16"/></svg>
                                </div>
                                <div class="flex-1 space-y-3">
                                    <div>
                                        <label class="mb-1 block text-[10px] font-bold uppercase text-slate-500">Judul Layanan</label>
                                        <input type="text" x-model="item.judul" placeholder="School Bus" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-orange-400 focus:ring-1 focus:ring-orange-400">
                                    </div>
                                    <div>
                                        <label class="mb-1 block text-[10px] font-bold uppercase text-slate-500">Ikon (Material Symbol)</label>
                                        <input type="text" x-model="item.ikon" placeholder="school" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-orange-400 focus:ring-1 focus:ring-orange-400">
                                    </div>
                                    <div>
                                        <label class="mb-1 block text-[10px] font-bold uppercase text-slate-500">Gambar</label>
                                        <div class="flex items-center gap-3">
                                            <img x-show="item.gambarPreview" :src="item.gambarPreview" class="h-14 w-20 rounded-lg object-cover ring-1 ring-slate-200">
                                            <div x-show="!item.gambarPreview" class="h-14 w-20 rounded-lg bg-slate-100 ring-1 ring-slate-200 flex items-center justify-center text-xs text-slate-400">No image</div>
                                            <label class="cursor-pointer rounded-lg bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-600 hover:bg-slate-200">
                                                Ganti
                                                <input type="file" accept="image/*" class="sr-only" @change="handleGambarItem($event, index)">
                                            </label>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="mb-1 block text-[10px] font-bold uppercase text-slate-500">Deskripsi</label>
                                        <textarea x-model="item.deskripsi" rows="2" placeholder="Layanan transportasi..." class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-orange-400 focus:ring-1 focus:ring-orange-400"></textarea>
                                    </div>
                                </div>
                                <button type="button" @click="hapusLayanan(index)" class="mt-1 rounded-lg p-1.5 text-rose-500 transition hover:bg-rose-50">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </div>
                        </div>
                    </template>

                    <template x-if="layanan.length === 0 && !showNewForm">
                        <div class="rounded-xl border-2 border-dashed border-slate-200 p-6 text-center text-sm text-slate-500">
                            Belum ada layanan. Klik "Tambah Layanan" untuk mulai menambahkan.
                        </div>
                    </template>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-orange-50/70 p-4 text-xs text-orange-800">
                <strong>💡 Ikon Material Symbols:</strong> Gunakan nama ikon dari 
                <a href="https://fonts.google.com/icons" target="_blank" class="font-bold text-orange-900 underline">Google Material Symbols</a>.
                Contoh: <code class="rounded bg-white px-1.5 py-0.5 font-mono">school</code>, <code class="rounded bg-white px-1.5 py-0.5 font-mono">mosque</code>, <code class="rounded bg-white px-1.5 py-0.5 font-mono">bus</code>.
            </div>
        </section>

        <x-live-preview>
            <div class="py-4 text-center">
                <h3 class="text-xs font-bold uppercase tracking-wider text-orange-500">Fasilitas & Layanan</h3>
                <h4 class="mt-1 text-lg font-extrabold text-slate-900">Prioritas Kenyamanan Anda</h4>
                <div class="mt-4 grid grid-cols-2 gap-3">
                    <template x-for="item in layanan" :key="item.id">
                        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm transition hover:shadow-md">
                            <img :src="item.gambarPreview || 'https://picsum.photos/seed/' + item.id + '/400/300'" alt="Gambar layanan" class="h-28 w-full object-cover">
                            <div class="p-3 text-center">
                                <span
                                    class="material-symbols-outlined text-2xl"
    x-text="item.ikon || 'star'">
</span>
                                <p class="mt-1 text-xs font-bold text-slate-800" x-text="item.judul || 'Judul'">Judul</p>
                                <p class="mt-1 text-[10px] leading-4 text-slate-500" x-text="item.deskripsi || 'Deskripsi layanan'">Deskripsi</p>
                            </div>
                        </div>
                    </template>
                    <template x-if="layanan.length === 0">
                        <div class="col-span-2 py-4 text-center text-xs text-slate-400">Belum ada layanan</div>
                    </template>
                </div>
                <div class="mt-4 rounded-lg bg-orange-500 px-4 py-2 text-center text-xs font-bold text-white">LIVE SUPPORT — Hubungi Admin</div>
            </div>
        </x-live-preview>
    </div>
</div>

<script>
    function layananManager() {
        return {
            layanan: @json($layanan),
            nextId: 100000,
            showNewForm: false,
            newItem: { ikon: 'star', judul: '', deskripsi: '', gambarPreview: null, gambarPath: null },

            async handleGambarBaru(event) {
                const file = event.target.files[0];
                if (!file) return;
                try {
                    const uploaded = await window.arjunaUploadImage(file);
                    this.newItem.gambarPreview = uploaded.url;
                    this.newItem.gambarPath = uploaded.path;
                } catch (error) { alert(error.message); }
            },
            async handleGambarItem(event, index) {
                const file = event.target.files[0];
                if (!file) return;
                try {
                    const uploaded = await window.arjunaUploadImage(file);
                    this.layanan[index].gambarPreview = uploaded.url;
                    this.layanan[index].gambarPath = uploaded.path;
                } catch (error) { alert(error.message); }
            },
            simpanTambah() {
                if (!this.newItem.judul.trim()) return alert('Judul harus diisi.');
                this.layanan.push({ id: 'new-' + this.nextId++, ...this.newItem });
                this.batalTambah();
            },
            batalTambah() {
                this.showNewForm = false;
                this.newItem = { ikon: 'star', judul: '', deskripsi: '', gambarPreview: null, gambarPath: null };
            },
            hapusLayanan(index) {
                if (this.layanan.length <= 1) return alert('Minimal harus ada satu layanan.');
                if (confirm('Hapus layanan ini?')) this.layanan.splice(index, 1);
            },
            startDrag() { alert('Urutan yang tampil mengikuti urutan daftar saat disimpan.'); },
            async saveAll() {
                try {
                    const response = await window.arjunaRequest(@json(route('admin.layanan.update')), {
                        method: 'POST', body: JSON.stringify({ items: this.layanan })
                    });
                    this.layanan = response.data;
                    alert(response.message);
                } catch (error) { alert(error.message); }
            }
        };
    }
</script>
@endsection