@extends('layout.admin')
@section('title', 'Cara Pemesanan Arjuna Trans')
@section('content')

<div x-data="caraPesanManager()" class="space-y-6">
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
                    <h2 class="text-base font-bold text-slate-900">Daftar Langkah</h2>
                    <button type="button" @click="tambahLangkah()" class="inline-flex items-center gap-1.5 rounded-lg bg-orange-500 px-3 py-1.5 text-xs font-bold text-white transition hover:bg-orange-600">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14"/></svg>
                        Tambah Langkah
                    </button>
                </div>
                <div class="mt-4 space-y-4">
                    <template x-for="(item, index) in langkah" :key="index">
                        <div class="rounded-xl border border-slate-200 bg-slate-50/70 p-4">
                            <div class="flex items-start gap-3">
                                <div class="cursor-grab text-slate-400 hover:text-slate-600" @mousedown="startDrag($event, index)">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 8h16M4 16h16"/></svg>
                                </div>
                                <div class="flex-1 space-y-3">
                                    <div>
                                        <label class="mb-1 block text-[10px] font-bold uppercase text-slate-500">Judul Langkah</label>
                                        <input type="text" x-model="item.judul" placeholder="Informasi Ketersediaan" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-orange-400 focus:ring-1 focus:ring-orange-400">
                                    </div>
                                    <div>
                                        <label class="mb-1 block text-[10px] font-bold uppercase text-slate-500">Deskripsi</label>
                                        <textarea x-model="item.deskripsi" rows="4" placeholder="Hubungi Customer Service..." class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-orange-400 focus:ring-1 focus:ring-orange-400"></textarea>
                                    </div>
                                </div>
                                <button type="button" @click="hapusLangkah(index)" class="mt-1 rounded-lg p-1.5 text-rose-500 transition hover:bg-rose-50">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </div>
                        </div>
                    </template>

                    <template x-if="langkah.length === 0">
                        <div class="rounded-xl border-2 border-dashed border-slate-200 p-6 text-center text-sm text-slate-500">
                            Belum ada langkah. Klik "Tambah Langkah" untuk mulai menambahkan.
                        </div>
                    </template>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-orange-50/70 p-4 text-xs text-orange-800">
                <strong>💡 Tips:</strong> Urutan langkah akan otomatis diberi nomor (1, 2, 3, ...) di landing page. Anda dapat mengubah urutan dengan drag & drop (fitur segera hadir).
            </div>
        </section>

        <x-live-preview>
            <div class="py-4">
                <h3 class="text-center text-xs font-bold uppercase tracking-wider text-orange-500">Alur Reservasi</h3>
                <h4 class="mt-1 text-center text-lg font-extrabold text-slate-900">Cara Pemesanan Arjuna Pariwisata</h4>
                <p class="mt-1 text-center text-xs text-slate-500">Kami menyederhanakan proses booking untuk menghemat waktu berharga Anda. Ikuti langkah mudah berikut.</p>

                <div class="mt-4 space-y-4">
                    <template x-for="(item, index) in langkah" :key="item.id">
                        <div class="flex items-start gap-3 rounded-xl border border-slate-100 bg-white p-3 shadow-sm">
                            <span class="grid h-8 w-8 shrink-0 place-items-center rounded-full bg-orange-500 text-xs font-bold text-white" x-text="index + 1">1</span>
                            <div>
                                <p class="text-sm font-bold text-slate-900" x-text="item.judul || 'Judul Langkah'">Informasi Ketersediaan</p>
                                <p class="mt-1 text-xs text-slate-500" x-text="item.deskripsi || 'Deskripsi langkah'">Hubungi Customer Service...</p>
                            </div>
                        </div>
                    </template>
                    <template x-if="langkah.length === 0">
                        <div class="py-6 text-center text-sm text-slate-400">Belum ada langkah</div>
                    </template>
                </div>
                <div class="mt-4 rounded-lg bg-orange-500 px-4 py-2 text-center text-xs font-bold text-white">Hubungi Admin Sekarang</div>
            </div>
        </x-live-preview>
    </div>
</div>

<script>
    function caraPesanManager() {
        return {
            langkah: [
                {
                    id: 1,
                    judul: 'Informasi Ketersediaan',
                    deskripsi: 'Hubungi Customer Service kami via WhatsApp untuk menanyakan ketersediaan armada pada tanggal yang Anda inginkan.'
                },
                {
                    id: 2,
                    judul: 'Konfirmasi Titik Jemput',
                    deskripsi: 'Berikan detail alamat penjemputan dan rute tujuan. Kami akan mengirimkan invoice digital untuk Anda.'
                },
                {
                    id: 3,
                    judul: 'Penjemputan Tepat Waktu',
                    deskripsi: 'Sopir kami akan menghubungi Anda H-1 jam sebelum jam keberangkatan untuk memastikan posisi Anda siap dijemput.'
                },
                {
                    id: 4,
                    judul: 'Pembayaran Akhir',
                    deskripsi: 'Lakukan pelunasan pembayaran langsung kepada sopir sebelum perjalanan dimulai atau via transfer bank.'
                }
            ],
            nextId: 5,

            tambahLangkah() {
                this.langkah.push({
                    id: this.nextId++,
                    judul: 'Langkah Baru',
                    deskripsi: 'Tulis deskripsi langkah di sini...'
                });
            },

            hapusLangkah(index) {
                if (this.langkah.length <= 1) {
                    alert('Minimal harus ada satu langkah.');
                    return;
                }
                if (confirm('Hapus langkah ini?')) {
                    this.langkah.splice(index, 1);
                }
            },

            startDrag(event, index) {
                alert('Fitur drag & drop untuk mengurutkan (akan diimplementasikan nanti).');
            },

            saveAll() {
                alert('Data cara pemesanan berhasil disimpan (simulasi).');
                console.log(this.langkah);
            }
        };
    }
</script>
@endsection