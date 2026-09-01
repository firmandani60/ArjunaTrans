@extends('layout.admin')
@section('title', 'Kelola Keunggulan | Arjuna Trans')
@section('content')

<div x-data="keunggulanManager()" class="space-y-6">
    <section class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
        <button type="button" @click="saveAll()"
            class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-orange-500 to-orange-600 px-5 py-2.5 text-sm font-bold text-white shadow-[0_10px_25px_rgba(249,115,22,0.25)] transition hover:-translate-y-0.5 hover:from-orange-600 hover:to-orange-700">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
            </svg>
            Simpan Perubahan
        </button>
    </section>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-[1fr_1.1fr]">
        <section class="space-y-5">
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <h2 class="text-base font-bold text-slate-900">Daftar Keunggulan</h2>
                    <button type="button" @click="showNewForm = true" class="inline-flex items-center gap-1.5 rounded-lg bg-orange-500 px-3 py-1.5 text-xs font-bold text-white transition hover:bg-orange-600">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14" />
                        </svg>
                        Tambah Baru
                    </button>
                </div>

                <div class="mt-4 space-y-4">
                    <template x-if="showNewForm">
                        <div class="rounded-xl border border-orange-200 bg-orange-50/70 p-4">
                            <div class="flex items-start gap-3">
                                <div class="flex-1 space-y-3">
                                    <div class="grid grid-cols-6 gap-3">
                                        <div class="col-span-1">
                                            <label class="mb-1 block text-[10px] font-bold uppercase text-slate-500">Ikon</label>
                                            <input type="text" x-model="newItem.ikon" placeholder="star" class="w-full rounded-lg border border-slate-300 px-2 py-1.5 text-xs focus:border-orange-400 focus:ring-1 focus:ring-orange-400">
                                        </div>
                                        <div class="col-span-5">
                                            <label class="mb-1 block text-[10px] font-bold uppercase text-slate-500">Judul</label>
                                            <input type="text" x-model="newItem.judul" placeholder="Judul Keunggulan" class="w-full rounded-lg border border-slate-300 px-2 py-1.5 text-xs focus:border-orange-400 focus:ring-1 focus:ring-orange-400">
                                        </div>
                                    </div>
                                    <div>
                                        <label class="mb-1 block text-[10px] font-bold uppercase text-slate-500">Deskripsi</label>
                                        <textarea x-model="newItem.deskripsi" rows="2" placeholder="Tulis deskripsi keunggulan di sini..."
                                            class="w-full rounded-lg border border-slate-300 px-2 py-1.5 text-xs focus:border-orange-400 focus:ring-1 focus:ring-orange-400"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3 flex justify-end gap-2">
                                <button type="button" @click="batalTambah()" class="rounded-lg border border-slate-300 px-3 py-1.5 text-xs font-bold text-slate-600 hover:bg-slate-100">
                                    Batal
                                </button>
                                <button type="button" @click="simpanTambah()" class="rounded-lg bg-orange-500 px-3 py-1.5 text-xs font-bold text-white hover:bg-orange-600">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </template>

                    <template x-for="(item, index) in keunggulan" :key="index">
                        <div class="rounded-xl border border-slate-200 bg-slate-50/70 p-4">
                            <div class="flex items-start gap-3">
                                <div class="cursor-grab text-slate-400 hover:text-slate-600" @mousedown="startDrag($event, index)">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 8h16M4 16h16" />
                                    </svg>
                                </div>
                                <div class="flex-1 space-y-3">
                                    <div class="grid grid-cols-6 gap-3">
                                        <div class="col-span-1">
                                            <label class="mb-1 block text-[10px] font-bold uppercase text-slate-500">Ikon</label>
                                            <input type="text" x-model="item.ikon" placeholder="manage_accounts" class="w-full rounded-lg border border-slate-300 px-2 py-1.5 text-xs focus:border-orange-400 focus:ring-1 focus:ring-orange-400">
                                        </div>
                                        <div class="col-span-5">
                                            <label class="mb-1 block text-[10px] font-bold uppercase text-slate-500">Judul</label>
                                            <input type="text" x-model="item.judul" placeholder="Kru Handal" class="w-full rounded-lg border border-slate-300 px-2 py-1.5 text-xs focus:border-orange-400 focus:ring-1 focus:ring-orange-400">
                                        </div>
                                    </div>
                                    <div>
                                        <label class="mb-1 block text-[10px] font-bold uppercase text-slate-500">Deskripsi</label>
                                        <textarea x-model="item.deskripsi" rows="2" placeholder="Pengemudi terlatih..."
                                            class="w-full rounded-lg border border-slate-300 px-2 py-1.5 text-xs focus:border-orange-400 focus:ring-1 focus:ring-orange-400"></textarea>
                                    </div>
                                </div>
                                <button type="button" @click="hapusKeunggulan(index)" class="mt-1 rounded-lg p-1 text-rose-500 transition hover:bg-rose-50">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </template>

                    <template x-if="keunggulan.length === 0 && !showNewForm">
                        <div class="rounded-xl border-2 border-dashed border-slate-200 p-6 text-center text-sm text-slate-500">
                            Belum ada keunggulan. Klik "Tambah Baru" untuk mulai menambahkan.
                        </div>
                    </template>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-amber-50 p-4 text-xs text-amber-800">
                <strong>💡 Ikon Material Symbols:</strong> Gunakan nama ikon dari
                <a href="https://fonts.google.com/icons" target="_blank" class="font-bold text-amber-900 underline">Google Material Symbols</a>.
                Contoh: <code class="rounded bg-white px-1.5 py-0.5 font-mono">manage_accounts</code>, <code class="rounded bg-white px-1.5 py-0.5 font-mono">ads_click</code>, <code class="rounded bg-white px-1.5 py-0.5 font-mono">verified</code>.
            </div>
        </section>

        <x-live-preview>
            <div class="text-center">
                <h3 class="text-sm font-bold uppercase tracking-wider text-orange-500">Mengapa Harus Arjuna Trans?</h3>
                <div class="mt-4 grid grid-cols-2 gap-4">
                    <template x-for="item in keunggulan" :key="item.id">
                        <div class="rounded-xl border border-slate-100 bg-slate-50 p-4 text-center transition hover:shadow-md">
                            <span class="material-symbols-outlined text-3xl text-orange-500" x-text="item.ikon || 'star'"></span>
                            <p class="mt-2 text-sm font-bold text-slate-800" x-text="item.judul || 'Judul'">Judul</p>
                            <p class="mt-1 text-xs text-slate-500" x-text="item.deskripsi || 'Deskripsi'">Deskripsi</p>
                        </div>
                    </template>
                    <template x-if="keunggulan.length === 0">
                        <div class="col-span-2 py-6 text-center text-sm text-slate-400">
                            Belum ada keunggulan untuk ditampilkan.
                        </div>
                    </template>
                </div>
            </div>
        </x-live-preview>
    </div>
</div>

<script>
    function keunggulanManager() {
        return {
            keunggulan: @json($keunggulan),
            nextId: 100000,
            showNewForm: false,
            newItem: { ikon: 'star', judul: '', deskripsi: '' },

            simpanTambah() {
                if (!this.newItem.judul.trim()) {
                    alert('Judul harus diisi.');
                    return;
                }
                this.keunggulan.push({
                    id: 'new-' + this.nextId++,
                    ikon: this.newItem.ikon || 'star',
                    judul: this.newItem.judul,
                    deskripsi: this.newItem.deskripsi || ''
                });
                this.batalTambah();
            },
            batalTambah() {
                this.showNewForm = false;
                this.newItem = { ikon: 'star', judul: '', deskripsi: '' };
            },
            hapusKeunggulan(index) {
                if (this.keunggulan.length <= 1) return alert('Minimal harus ada satu keunggulan.');
                if (confirm('Hapus keunggulan ini?')) this.keunggulan.splice(index, 1);
            },
            startDrag() {
                alert('Urutan yang tampil mengikuti urutan daftar saat disimpan.');
            },
            async saveAll() {
                try {
                    const response = await window.arjunaRequest(@json(route('admin.keunggulan.update')), {
                        method: 'POST',
                        body: JSON.stringify({ items: this.keunggulan })
                    });
                    this.keunggulan = response.data;
                    alert(response.message);
                } catch (error) {
                    alert(error.message);
                }
            }
        };
    }
</script>
@endsection