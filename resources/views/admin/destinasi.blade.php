@extends('layout.admin')
@section('title', 'Destinasi Arjuna Trans')
@section('content')

<div x-data="destinasiManager()" class="space-y-6">
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
                    <h2 class="text-base font-bold text-slate-900">Daftar Destinasi</h2>
                    <button type="button" @click="showNewForm = true" class="inline-flex items-center gap-1.5 rounded-lg bg-orange-500 px-3 py-1.5 text-xs font-bold text-white transition hover:bg-orange-600">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14"/></svg>
                        Tambah Destinasi
                    </button>
                </div>

                <div class="mt-4 space-y-4">
                    <template x-if="showNewForm">
                        <div class="rounded-xl border border-orange-200 bg-orange-50/70 p-4">
                            <div class="space-y-3">
                                <div>
                                    <label class="mb-1 block text-[10px] font-bold uppercase text-slate-500">Nama Destinasi</label>
                                    <input type="text" x-model="newItem.nama" placeholder="Wisata Pantai Malang" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-orange-400 focus:ring-1 focus:ring-orange-400">
                                </div>
                                <div>
                                    <label class="mb-1 block text-[10px] font-bold uppercase text-slate-500">Deskripsi Singkat</label>
                                    <input type="text" x-model="newItem.deskripsi" placeholder="Pantai Balekambang, Sendang Biru, hingga Teluk Asmara." class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-orange-400 focus:ring-1 focus:ring-orange-400">
                                </div>
                                <div>
                                    <label class="mb-1 block text-[10px] font-bold uppercase text-slate-500">Rute Terkait</label>
                                    <input type="text" x-model="newItem.rute" placeholder="Malang Selatan Route" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-orange-400 focus:ring-1 focus:ring-orange-400">
                                </div>
                                <div>
                                    <label class="mb-1 block text-[10px] font-bold uppercase text-slate-500">Gambar (opsional)</label>
                                    <div class="flex items-center gap-3">
                                        <img x-show="newItem.gambarPreview" :src="newItem.gambarPreview" class="h-14 w-20 rounded-lg object-cover ring-1 ring-slate-200">
                                        <div x-show="!newItem.gambarPreview" class="flex h-14 w-20 items-center justify-center rounded-lg bg-slate-100 text-xs text-slate-400 ring-1 ring-slate-200">No image</div>
                                        <label class="cursor-pointer rounded-lg bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-600 hover:bg-slate-200">
                                            Pilih
                                            <input type="file" accept="image/*" class="sr-only" @change="handleGambarBaru($event)">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3 flex justify-end gap-2">
                                <button type="button" @click="batalTambah()" class="rounded-lg border border-slate-300 px-4 py-1.5 text-xs font-bold text-slate-600 hover:bg-slate-100">Batal</button>
                                <button type="button" @click="simpanTambah()" class="rounded-lg bg-orange-500 px-4 py-1.5 text-xs font-bold text-white hover:bg-orange-600">Simpan</button>
                            </div>
                        </div>
                    </template>

                    <template x-for="(item, index) in destinasi" :key="index">
                        <div class="rounded-xl border border-slate-200 bg-slate-50/70 p-4">
                            <div class="flex items-start gap-3">
                                <div class="cursor-grab text-slate-400 hover:text-slate-600" @mousedown="startDrag($event, index)">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 8h16M4 16h16"/></svg>
                                </div>
                                <div class="flex-1 space-y-3">
                                    <div>
                                        <label class="mb-1 block text-[10px] font-bold uppercase text-slate-500">Nama Destinasi</label>
                                        <input type="text" x-model="item.nama" placeholder="Wisata Pantai Malang" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-orange-400 focus:ring-1 focus:ring-orange-400">
                                    </div>
                                    <div>
                                        <label class="mb-1 block text-[10px] font-bold uppercase text-slate-500">Deskripsi Singkat</label>
                                        <input type="text" x-model="item.deskripsi" placeholder="Pantai Balekambang..." class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-orange-400 focus:ring-1 focus:ring-orange-400">
                                    </div>
                                    <div>
                                        <label class="mb-1 block text-[10px] font-bold uppercase text-slate-500">Rute Terkait</label>
                                        <input type="text" x-model="item.rute" placeholder="Malang Selatan Route" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-orange-400 focus:ring-1 focus:ring-orange-400">
                                    </div>
                                    <div>
                                        <label class="mb-1 block text-[10px] font-bold uppercase text-slate-500">Gambar</label>
                                        <div class="flex items-center gap-3">
                                            <img x-show="item.gambarPreview" :src="item.gambarPreview" class="h-14 w-20 rounded-lg object-cover ring-1 ring-slate-200">
                                            <div x-show="!item.gambarPreview" class="flex h-14 w-20 items-center justify-center rounded-lg bg-slate-100 text-xs text-slate-400 ring-1 ring-slate-200">No image</div>
                                            <label class="cursor-pointer rounded-lg bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-600 hover:bg-slate-200">
                                                Ganti
                                                <input type="file" accept="image/*" class="sr-only" @change="handleGambarItem($event, index)">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" @click="hapusDestinasi(index)" class="mt-1 rounded-lg p-1.5 text-rose-500 transition hover:bg-rose-50">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </div>
                        </div>
                    </template>

                    <template x-if="destinasi.length === 0 && !showNewForm">
                        <div class="rounded-xl border-2 border-dashed border-slate-200 p-6 text-center text-sm text-slate-500">
                            Belum ada destinasi. Klik "Tambah Destinasi" untuk mulai menambahkan.
                        </div>
                    </template>
                </div>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-orange-50/70 p-4 text-xs text-orange-800">
                <strong>💡 Tips:</strong> Setiap destinasi akan ditampilkan dengan nomor urut di landing page. Anda dapat mengurutkan dengan drag & drop (fitur segera hadir).
            </div>
        </section>

        <x-live-preview>
            <div class="py-4">
                <h3 class="text-center text-xs font-bold uppercase tracking-wider text-orange-500">Destinasi Populer</h3>
                <h4 class="mt-1 text-center text-lg font-extrabold text-slate-900">Eksplorasi Keindahan Jawa dengan Arjuna Trans</h4>
                <p class="mt-1 text-center text-xs text-slate-500">Kami telah merancang rute-rute terbaik untuk pengalaman liburan Anda yang tak terlupakan.</p>

                <div class="mt-4 space-y-3">
                    <template x-for="(item, index) in destinasi" :key="item.id">
                        <div class="flex items-start gap-3 rounded-xl border border-slate-100 bg-white p-3 shadow-sm">
                            <span class="grid h-8 w-8 shrink-0 place-items-center rounded-full bg-orange-500 text-xs font-bold text-white" x-text="String(index + 1).padStart(2, '0')">01</span>
                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-bold text-slate-900" x-text="item.nama || 'Nama Destinasi'">Wisata Pantai Malang</p>
                                <p class="text-xs text-slate-500" x-text="item.deskripsi || 'Deskripsi'">Pantai Balekambang, Sendang Biru, hingga Teluk Asmara.</p>
                                <p class="mt-0.5 text-[10px] font-semibold text-orange-600" x-text="item.rute ? '🚌 ' + item.rute : ''">Malang Selatan Route</p>
                            </div>
                            <img x-show="item.gambarPreview" :src="item.gambarPreview" class="h-14 w-20 rounded-lg object-cover ring-1 ring-slate-200">
                        </div>
                    </template>
                    <template x-if="destinasi.length === 0">
                        <div class="py-6 text-center text-sm text-slate-400">Belum ada destinasi</div>
                    </template>
                </div>

                <div class="mt-4 rounded-lg bg-orange-500 px-4 py-2 text-center text-xs font-bold text-white">CHAT ADMIN — Rencanakan Perjalanan Anda</div>
            </div>
        </x-live-preview>
    </div>
</div>

<script>
    function destinasiManager() {
        return {
            destinasi: @json($destinasi),
            nextId: 100000,
            showNewForm: false,
            newItem: { nama: '', deskripsi: '', rute: '', gambarPreview: null, gambarPath: null },

            async handleGambarBaru(event) {
                const file = event.target.files[0]; if (!file) return;
                try { const uploaded = await window.arjunaUploadImage(file); this.newItem.gambarPreview = uploaded.url; this.newItem.gambarPath = uploaded.path; }
                catch (error) { alert(error.message); }
            },
            async handleGambarItem(event, index) {
                const file = event.target.files[0]; if (!file) return;
                try { const uploaded = await window.arjunaUploadImage(file); this.destinasi[index].gambarPreview = uploaded.url; this.destinasi[index].gambarPath = uploaded.path; }
                catch (error) { alert(error.message); }
            },
            simpanTambah() { if (!this.newItem.nama.trim()) return alert('Nama destinasi harus diisi.'); this.destinasi.push({ id: 'new-' + this.nextId++, ...this.newItem }); this.batalTambah(); },
            batalTambah() { this.showNewForm = false; this.newItem = { nama: '', deskripsi: '', rute: '', gambarPreview: null, gambarPath: null }; },
            hapusDestinasi(index) { if (this.destinasi.length <= 1) return alert('Minimal harus ada satu destinasi.'); if (confirm('Hapus destinasi ini?')) this.destinasi.splice(index, 1); },
            startDrag() { alert('Urutan yang tampil mengikuti urutan daftar saat disimpan.'); },
            async saveAll() {
                try {
                    const response = await window.arjunaRequest(@json(route('admin.destinasi.update')), { method: 'POST', body: JSON.stringify({ items: this.destinasi }) });
                    this.destinasi = response.data; alert(response.message);
                } catch (error) { alert(error.message); }
            }
        };
    }
</script>
@endsection