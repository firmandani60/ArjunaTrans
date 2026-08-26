@extends('layout.admin')
@section('title', 'Rute & Harga Sewa Arjuna Trans')
@section('content')

<div x-data="ruteManager()" class="space-y-6">
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
                    <h2 class="text-base font-bold text-slate-900">Daftar Rute</h2>
                    <button type="button" @click="showNewForm = true" class="inline-flex items-center gap-1.5 rounded-lg bg-orange-500 px-3 py-1.5 text-xs font-bold text-white transition hover:bg-orange-600">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14"/></svg>
                        Tambah Rute
                    </button>
                </div>

                <div class="mt-4 space-y-4">
                    <template x-if="showNewForm">
                        <div class="rounded-xl border border-orange-200 bg-orange-50/70 p-4">
                            <div class="space-y-3">
                                <div>
                                    <label class="mb-1 block text-[10px] font-bold uppercase text-slate-500">Nama Destinasi</label>
                                    <input type="text" x-model="newItem.nama_destinasi" placeholder="Wisata Pantai Malang" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-orange-400 focus:ring-1 focus:ring-orange-400">
                                </div>
                                <div>
                                    <label class="mb-1 block text-[10px] font-bold uppercase text-slate-500">Deskripsi / Detail Rute</label>
                                    <input type="text" x-model="newItem.deskripsi_rute" placeholder="Eksplorasi Pantai Selatan Malang" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-orange-400 focus:ring-1 focus:ring-orange-400">
                                </div>
                                <div class="grid grid-cols-2 gap-3">
                                    <div>
                                        <label class="mb-1 block text-[10px] font-bold uppercase text-slate-500">Harga - ELF LONG</label>
                                        <input type="text" x-model="newItem.harga_elf_long" placeholder="1.800.000" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-orange-400 focus:ring-1 focus:ring-orange-400">
                                    </div>
                                    <div>
                                        <label class="mb-1 block text-[10px] font-bold uppercase text-slate-500">Harga - MEDIUM BUS</label>
                                        <input type="text" x-model="newItem.harga_medium_bus" placeholder="3.400.000" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-orange-400 focus:ring-1 focus:ring-orange-400">
                                    </div>
                                </div>
                                <div>
                                    <label class="mb-1 block text-[10px] font-bold uppercase text-slate-500">Kategori</label>
                                    <select x-model="newItem.kategori" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-orange-400 focus:ring-1 focus:ring-orange-400">
                                        <option value="popular">POPULAR</option>
                                        <option value="wisata_religi">WISATA RELIGI</option>
                                        <option value="metropolitan">METROPOLITAN</option>
                                        <option value="advent">ADVENT</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="mb-1 block text-[10px] font-bold uppercase text-slate-500">Gambar Rute</label>
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

                    <template x-for="(item, index) in rute" :key="index">
                        <div class="rounded-xl border border-slate-200 bg-slate-50/70 p-4">
                            <div class="flex items-start gap-3">
                                <div class="cursor-grab text-slate-400 hover:text-slate-600" @mousedown="startDrag($event, index)">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 8h16M4 16h16"/></svg>
                                </div>
                                <div class="flex-1 space-y-3">
                                    <div>
                                        <label class="mb-1 block text-[10px] font-bold uppercase text-slate-500">Nama Destinasi</label>
                                        <input type="text" x-model="item.nama_destinasi" placeholder="Wisata Pantai Malang" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-orange-400 focus:ring-1 focus:ring-orange-400">
                                    </div>
                                    <div>
                                        <label class="mb-1 block text-[10px] font-bold uppercase text-slate-500">Deskripsi / Detail Rute</label>
                                        <input type="text" x-model="item.deskripsi_rute" placeholder="Eksplorasi Pantai Selatan Malang" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-orange-400 focus:ring-1 focus:ring-orange-400">
                                    </div>
                                    <div class="grid grid-cols-2 gap-3">
                                        <div>
                                            <label class="mb-1 block text-[10px] font-bold uppercase text-slate-500">Harga - ELF LONG</label>
                                            <input type="text" x-model="item.harga_elf_long" placeholder="1.800.000" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-orange-400 focus:ring-1 focus:ring-orange-400">
                                        </div>
                                        <div>
                                            <label class="mb-1 block text-[10px] font-bold uppercase text-slate-500">Harga - MEDIUM BUS</label>
                                            <input type="text" x-model="item.harga_medium_bus" placeholder="3.400.000" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-orange-400 focus:ring-1 focus:ring-orange-400">
                                        </div>
                                    </div>
                                    <div>
                                        <label class="mb-1 block text-[10px] font-bold uppercase text-slate-500">Kategori</label>
                                        <select x-model="item.kategori" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-orange-400 focus:ring-1 focus:ring-orange-400">
                                            <option value="popular">POPULAR</option>
                                            <option value="wisata_religi">WISATA RELIGI</option>
                                            <option value="metropolitan">METROPOLITAN</option>
                                            <option value="advent">ADVENT</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="mb-1 block text-[10px] font-bold uppercase text-slate-500">Gambar Rute</label>
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
                                <button type="button" @click="hapusRute(index)" class="mt-1 rounded-lg p-1.5 text-rose-500 transition hover:bg-rose-50">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </div>
                        </div>
                    </template>

                    <template x-if="rute.length === 0 && !showNewForm">
                        <div class="rounded-xl border-2 border-dashed border-slate-200 p-6 text-center text-sm text-slate-500">
                            Belum ada rute. Klik "Tambah Rute" untuk mulai menambahkan.
                        </div>
                    </template>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-orange-50/70 p-4 text-xs text-orange-800">
                <strong>💡 Tips:</strong> Harga ditampilkan dalam format Rupiah. Cukup tulis angka tanpa titik, sistem akan memformat otomatis. Contoh: <code class="rounded bg-white px-1.5 py-0.5 font-mono">1800000</code> akan menjadi <code class="rounded bg-white px-1.5 py-0.5 font-mono">Rp 1.800.000</code>
            </div>
        </section>

        <x-live-preview>
            <div class="py-4">
                <h3 class="text-center text-xs font-bold uppercase tracking-wider text-orange-500">Destinasi Populer</h3>
                <h4 class="mt-1 text-center text-lg font-extrabold text-slate-900">Daftar Rute & Harga Sewa</h4>
                <p class="mt-1 text-center text-xs text-slate-500">Pilihan tujuan wisata terbaik dengan titik jemput area Mojokerto dan sekitarnya.</p>
                <template x-for="kategori in ['popular', 'wisata_religi', 'metropolitan', 'advent']" :key="kategori">
                    <div x-show="rute.filter(r => r.kategori === kategori).length > 0" class="mt-4">
                        <h5 class="text-sm font-bold uppercase tracking-wider text-slate-700" x-text="kategori === 'popular' ? 'POPULAR' : kategori === 'wisata_religi' ? 'WISATA RELIGI' : kategori === 'metropolitan' ? 'METROPOLITAN' : 'ADVENT'">POPULAR</h5>
                        <div class="mt-2 space-y-3">
                            <template x-for="item in rute.filter(r => r.kategori === kategori)" :key="item.id">
                                <div class="rounded-xl border border-slate-100 bg-white p-3 shadow-sm">
                                    <div class="flex items-start gap-3">
                                        <img x-show="item.gambarPreview" :src="item.gambarPreview" class="h-16 w-24 rounded-lg object-cover ring-1 ring-slate-200">
                                        <div x-show="!item.gambarPreview" class="h-16 w-24 rounded-lg bg-slate-100 ring-1 ring-slate-200 flex items-center justify-center text-xs text-slate-400">No image</div>
                                        <div class="min-w-0 flex-1">
                                            <p class="text-sm font-bold text-slate-900" x-text="item.nama_destinasi || 'Nama Destinasi'">Wisata Pantai Malang</p>
                                            <p class="text-xs text-slate-500" x-text="item.deskripsi_rute || 'Deskripsi rute'">Eksplorasi Pantai Selatan Malang</p>
                                            <div class="mt-1 flex flex-wrap gap-2 text-xs font-semibold">
                                                <span class="rounded-full bg-orange-100 px-2 py-0.5 text-orange-700">ELF LONG: Rp <span x-text="Number(item.harga_elf_long || 0).toLocaleString('id-ID')">1.800.000</span></span>
                                                <span class="rounded-full bg-blue-100 px-2 py-0.5 text-blue-700">MEDIUM BUS: Rp <span x-text="Number(item.harga_medium_bus || 0).toLocaleString('id-ID')">3.400.000</span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </template>

                <template x-if="rute.length === 0">
                    <div class="py-6 text-center text-sm text-slate-400">Belum ada rute</div>
                </template>

                <div class="mt-4 rounded-lg bg-orange-500 px-4 py-2 text-center text-xs font-bold text-white">LIVE SUPPORT — Hubungi Admin</div>
                <p class="mt-2 text-center text-[10px] text-slate-400">Hingga sewaktu-waktu dapat berubah bergantung ke situasi dan muamalat. Belum termasuk Tok Piknik dan Tiga Ku</p>
            </div>
        </x-live-preview>
    </div>
</div>

<script>
    function ruteManager() {
        return {
            rute: @json($rute),
            nextId: 100000,
            showNewForm: false,
            newItem: { nama_destinasi: '', deskripsi_rute: '', harga_elf_long: '', harga_medium_bus: '', kategori: 'popular', gambarPreview: null, gambarPath: null },

            async handleGambarBaru(event) {
                const file = event.target.files[0]; if (!file) return;
                try { const uploaded = await window.arjunaUploadImage(file); this.newItem.gambarPreview = uploaded.url; this.newItem.gambarPath = uploaded.path; }
                catch (error) { alert(error.message); }
            },
            async handleGambarItem(event, index) {
                const file = event.target.files[0]; if (!file) return;
                try { const uploaded = await window.arjunaUploadImage(file); this.rute[index].gambarPreview = uploaded.url; this.rute[index].gambarPath = uploaded.path; }
                catch (error) { alert(error.message); }
            },
            simpanTambah() { if (!this.newItem.nama_destinasi.trim()) return alert('Nama destinasi harus diisi.'); this.rute.push({ id: 'new-' + this.nextId++, ...this.newItem }); this.batalTambah(); },
            batalTambah() { this.showNewForm = false; this.newItem = { nama_destinasi: '', deskripsi_rute: '', harga_elf_long: '', harga_medium_bus: '', kategori: 'popular', gambarPreview: null, gambarPath: null }; },
            hapusRute(index) { if (this.rute.length <= 1) return alert('Minimal harus ada satu rute.'); if (confirm('Hapus rute ini?')) this.rute.splice(index, 1); },
            startDrag() { alert('Urutan yang tampil mengikuti urutan daftar saat disimpan.'); },
            async saveAll() {
                try {
                    const response = await window.arjunaRequest(@json(route('admin.rute-harga.update')), { method: 'POST', body: JSON.stringify({ items: this.rute }) });
                    this.rute = response.data; alert(response.message);
                } catch (error) { alert(error.message); }
            }
        };
    }
</script>
@endsection