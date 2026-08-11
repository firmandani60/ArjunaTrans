@extends('layout.admin')
@section('title', 'Kelola Tentang Kami | Arjuna Trans')
@section('content')

<div x-data="tentangKamiManager()" class="space-y-6">
    <section class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
        <button type="button" @click="saveAll()" class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-orange-500 to-orange-600 px-5 py-2.5 text-sm font-bold text-white shadow-[0_10px_25px_rgba(249,115,22,0.25)] transition hover:-translate-y-0.5 hover:from-orange-600 hover:to-orange-700">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
            Simpan Perubahan
        </button>
    </section>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-[1fr_1.1fr]">
        <section class="space-y-5">
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <h2 class="text-base font-bold text-slate-900">Profil Perusahaan</h2>
                <div class="mt-4">
                    <label class="mb-1 block text-sm font-semibold text-slate-700">Deskripsi Perusahaan</label>
                    <textarea x-model="deskripsi" rows="7" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-orange-400 focus:ring-1 focus:ring-orange-400" placeholder="Arjuna Trans adalah penyedia layanan transportasi terkemuka..."></textarea>
                    <p class="mt-1 text-xs text-slate-500">Deskripsi ini akan ditampilkan di halaman utama 'Tentang Kami'.</p>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <h2 class="text-base font-bold text-slate-900">Visi & Misi</h2>
                <div class="mt-4 space-y-4">
                    <div>
                        <label class="mb-1 block text-sm font-semibold text-slate-700">Visi Perusahaan</label>
                        <textarea x-model="visi" rows="5" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-orange-400 focus:ring-1 focus:ring-orange-400" placeholder="Menjadi perusahaan penyedia jasa transportasi darat terbaik..."></textarea>
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-semibold text-slate-700">Misi Perusahaan</label>
                        <textarea x-model="misi" rows="5" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-orange-400 focus:ring-1 focus:ring-orange-400" placeholder="Misi perusahaan..."></textarea>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <h2 class="text-base font-bold text-slate-900">Galeri Armada</h2>
                    <span class="text-xs text-slate-500" x-text="galeri.length + ' foto'"></span>
                </div>
                <p class="mt-1 text-xs text-slate-500">Kelola gambar yang ditampilkan di bagian kolase armada pada halaman Tentang Kami.</p>
                <div class="mt-4 grid grid-cols-3 gap-3">
                    <template x-for="(foto, index) in galeri" :key="index">
                        <div class="relative group">
                            <img :src="foto" alt="Galeri armada" class="h-24 w-full rounded-lg object-cover ring-1 ring-slate-200">
                            <button type="button" @click="hapusFoto(index)" class="absolute -top-1 -right-1 grid h-5 w-5 place-items-center rounded-full bg-rose-500 text-[10px] font-bold text-white opacity-0 transition group-hover:opacity-100 hover:bg-rose-600">
                                ✕
                            </button>
                        </div>
                    </template>
                    <template x-if="galeri.length === 0">
                        <div class="col-span-3 rounded-lg border-2 border-dashed border-slate-200 p-4 text-center text-xs text-slate-400">Belum ada foto</div>
                    </template>
                    <label class="relative flex h-24 w-full cursor-pointer flex-col items-center justify-center rounded-lg border-2 border-dashed border-slate-300 bg-slate-50 transition hover:border-orange-400 hover:bg-orange-50/50">
                        <svg class="h-6 w-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                        <span class="text-[10px] text-slate-500">Tambah Foto</span>
                        <input type="file" accept="image/*" multiple class="sr-only" @change="tambahFoto($event)">
                    </label>
                </div>
            </div>
        </section>

        <x-live-preview>
            <div class="py-4">
                <div class="text-center">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-orange-500">Tentang Kami</h3>
                    <h4 class="mt-1 text-lg font-extrabold text-slate-900">Mendefinisikan Ulang Perjalanan Wisata Anda</h4>
                    <p class="mt-3 text-xs leading-6 text-slate-600" x-text="deskripsi || 'Arjuna Trans adalah penyedia layanan transportasi terkemuka...'"></p>
                </div>

                <div class="mt-4 grid grid-cols-2 gap-3 text-center">
                    <div class="rounded-lg border border-slate-200 bg-slate-50 p-3">
                        <p class="text-[10px] font-bold uppercase text-orange-500">Visi</p>
                        <p class="mt-1 text-[11px] leading-5 text-slate-700" x-text="visi || 'Menjadi perusahaan transportasi terbaik...'"></p>
                    </div>
                    <div class="rounded-lg border border-slate-200 bg-slate-50 p-3">
                        <p class="text-[10px] font-bold uppercase text-orange-500">Misi</p>
                        <p class="mt-1 text-[11px] leading-5 text-slate-700" x-text="misi || 'Memberikan layanan terbaik...'"></p>
                    </div>
                </div>

                <div class="mt-4 grid grid-cols-2 gap-2">
                    <div class="rounded-lg bg-orange-50 p-2 text-center text-xs font-semibold text-orange-700">Armada High-Spec</div>
                    <div class="rounded-lg bg-orange-50 p-2 text-center text-xs font-semibold text-orange-700">Kabin Steril & Wangi</div>
                    <div class="rounded-lg bg-orange-50 p-2 text-center text-xs font-semibold text-orange-700">Driver Profesional</div>
                    <div class="rounded-lg bg-orange-50 p-2 text-center text-xs font-semibold text-orange-700">Hiburan Full Karaoke</div>
                </div>

                <div class="mt-4">
                    <p class="text-[10px] font-bold uppercase text-slate-400">Galeri Armada</p>
                    <div class="mt-2 grid grid-cols-3 gap-2">
                        <template x-for="foto in galeri" :key="foto">
                            <img :src="foto" alt="Galeri" class="h-16 w-full rounded-lg object-cover ring-1 ring-slate-200">
                        </template>
                        <template x-if="galeri.length === 0">
                            <div class="col-span-3 py-2 text-center text-xs text-slate-400">Tidak ada foto</div>
                        </template>
                    </div>
                </div>
                <div class="mt-4 rounded-lg bg-orange-500 px-4 py-2 text-center text-xs font-bold text-white">Chat Admin</div>
            </div>
        </x-live-preview>
    </div>
</div>

<script>
    function tentangKamiManager() {
        return {
            deskripsi: 'Arjuna Trans adalah penyedia layanan transportasi terkemuka yang berdedikasi untuk memberikan pengalaman perjalanan yang aman, nyaman, dan terpercaya. Berdiri sejak tahun 2010, kami telah melayani ribuan pelanggan di seluruh Indonesia dengan armada modern dan fasilitas premium.',
            visi: 'Menjadi perusahaan penyedia jasa transportasi darat terbaik dan terpercaya di Indonesia dengan mengutamakan keselamatan dan kenyamanan pelanggan.',
            misi: 'Memberikan pelayanan transportasi yang aman, nyaman, dan tepat waktu dengan armada yang terawat dan tenaga profesional yang berdedikasi.',
            galeri: [
                'https://picsum.photos/seed/bus1/400/300',
                'https://picsum.photos/seed/bus2/400/300',
                'https://picsum.photos/seed/bus3/400/300'
            ],

            tambahFoto(event) {
                const files = event.target.files;
                for (let file of files) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.galeri.push(e.target.result);
                    };
                    reader.readAsDataURL(file);
                }
                event.target.value = '';
            },

            hapusFoto(index) {
                if (this.galeri.length <= 1) {
                    alert('Minimal harus ada satu foto galeri.');
                    return;
                }
                this.galeri.splice(index, 1);
            },

            saveAll() {
                alert('Data tentang kami berhasil disimpan (simulasi).');
                console.log({
                    deskripsi: this.deskripsi,
                    visi: this.visi,
                    misi: this.misi,
                    galeri: this.galeri
                });
            }
        };
    }
</script>
@endsection