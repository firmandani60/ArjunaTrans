@extends('layout.admin')
@section('title', 'Kontak Arjuna Trans')
@section('content')

<div x-data="kontakManager()" class="space-y-6">
    <section class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
        <button type="button" @click="saveAll()" class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-orange-500 to-orange-600 px-5 py-2.5 text-sm font-bold text-white shadow-[0_10px_25px_rgba(249,115,22,0.25)] transition hover:-translate-y-0.5 hover:from-orange-600 hover:to-orange-700">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
            Simpan Perubahan
        </button>
    </section>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-[1fr_1.1fr]">
        <section class="space-y-5">
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <h2 class="text-base font-bold text-slate-900">Informasi Operasional</h2>
                <div class="mt-4 space-y-4">
                    <div>
                        <label class="mb-1 block text-sm font-bold text-slate-700">Deskripsi Perusahaan</label>
                        <textarea x-model="data.deskripsi" rows="5" placeholder="Arjuna Trans adalah penyedia layanan transportasi terpercaya..." class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-orange-400 focus:ring-2 focus:ring-orange-100"></textarea>
                        <p class="mt-1 text-xs text-slate-400">Deskripsi ini akan ditampilkan di footer dan halaman tentang kami.</p>
                    </div>
                     <div>
    <label class="mb-1 block text-sm font-bold text-slate-700">
        Alamat Kantor
    </label>

    <textarea
        x-model="data.alamat"
        rows="2"
        placeholder="Masukkan alamat lengkap kantor..."
        class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-orange-400 focus:ring-2 focus:ring-orange-100"
    ></textarea>
</div>

<div>
    <label class="mb-1 block text-sm font-bold text-slate-700">
        Link Google Maps
    </label>

    <input
        type="url"
        x-model="data.maps_link"
        placeholder="https://maps.google.com/..."
        class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-orange-400 focus:ring-2 focus:ring-orange-100"
    >

    <p class="mt-1 text-xs text-slate-400">
        Masukkan link lokasi kantor dari Google Maps.
    </p>
<div>
    <div class="mb-2 flex items-center justify-between">
        <label class="block text-sm font-bold text-slate-700">
            Nomor WhatsApp
        </label>

        <button
            type="button"
            @click="tambahWhatsapp()"
            class="inline-flex items-center gap-1 rounded-lg bg-orange-500 px-3 py-1.5 text-xs font-bold text-white hover:bg-orange-600"
        >
            <span class="text-lg leading-none">+</span>
            Tambah Nomor
        </button>
    </div>

    <div class="space-y-2">
        <template
            x-for="(nomor, index) in data.whatsapp"
            :key="nomor.id ?? index"
        >
            <div class="flex gap-2">
                <input
                    type="text"
                    x-model="nomor.nomor"
                    placeholder="+62 812 3456 7890"
                    class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-orange-400 focus:ring-2 focus:ring-orange-100"
                >

                <button
                    type="button"
                    @click="hapusWhatsapp(index)"
                    class="rounded-xl bg-red-100 px-4 text-red-600 hover:bg-red-200"
                    title="Hapus nomor"
                >
                    −
                </button>
            </div>
        </template>
    </div>

    <p class="mt-1 text-xs text-slate-400">
        Tambahkan nomor WhatsApp menggunakan tombol +.
    </p>
</div>
                        <div>
                            <label class="mb-1 block text-sm font-bold text-slate-700">Alamat Email</label>
                            <input type="email" x-model="data.email" placeholder="info@arjunatrans.com" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-orange-400 focus:ring-2 focus:ring-orange-100">
                        </div>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <h2 class="text-base font-bold text-slate-900">Sosial Media</h2>
                <div class="mt-4 space-y-3">
                    <div>
                        <label class="mb-1 block text-sm font-bold text-slate-700">Instagram</label>
                        <input type="text" x-model="data.instagram" placeholder="https://instagram.com/arjunatrans" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-orange-400 focus:ring-2 focus:ring-orange-100">
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-bold text-slate-700">Facebook</label>
                        <input type="text" x-model="data.facebook" placeholder="https://facebook.com/arjunatrans" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-orange-400 focus:ring-2 focus:ring-orange-100">
                    </div>
                    <div>
    <label class="mb-1 block text-sm font-bold text-slate-700">YouTube</label>
    <input type="text" x-model="data.youtube" placeholder="https://youtube.com/@arjunatrans" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-orange-400 focus:ring-2 focus:ring-orange-100">
</div>

<div>
    <label class="mb-1 block text-sm font-bold text-slate-700">TikTok</label>
    <input type="text" x-model="data.tiktok" placeholder="https://tiktok.com/@arjunatrans" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-orange-400 focus:ring-2 focus:ring-orange-100">
</div>
                </div> 
            </div>

            <div class="rounded-2xl border border-slate-200 bg-orange-50/70 p-4 text-xs text-orange-800">
                <strong>💡 Tips:</strong> Pastikan nomor WhatsApp menggunakan kode negara (contoh: +62) dan alamat email valid. Sosial media akan ditampilkan sebagai ikon di footer.
            </div>
        </section>

        <x-live-preview>
            <div class="py-4">
                <div class="space-y-4">
                    <div class="border-b border-slate-200 pb-4">
                        <p class="text-center text-xs text-slate-600" x-text="data.deskripsi || 'Arjuna Trans adalah penyedia layanan transportasi terpercaya...'">Arjuna Trans adalah penyedia layanan transportasi terpercaya...</p>
                    </div>
                    <div class="grid grid-cols-2 gap-4 text-xs">
                        <div>
                            <p class="font-bold text-slate-800">NAVIGASI</p>
                            <ul class="mt-1 space-y-1 text-slate-500">
                                <li>Beranda</li>
                                <li>Daftar Armada</li>
                                <li>Pilihan Tujuan</li>
                                <li>Cara Pesan</li>
                            </ul>
                        </div>
                        <div>
                            <p class="font-bold text-slate-800">INFORMASI</p>
                            <ul class="mt-1 space-y-1 text-slate-500">
                                <li>Syarat & Ketentuan</li>
                                <li>Kebijakan Privasi</li>
                                <li>Testimoni</li>
                                <li>Karir Sopir</li>
                            </ul>
                        </div>
                    </div>
                    <div class="border-t border-slate-200 pt-4">
                        <p class="text-xs font-bold text-slate-800">KANTOR KAMI</p>
                        <p class="mt-1 text-xs text-slate-600" x-text="data.alamat || 'Jl. Raya Utama No. 123, Jakarta Pusat'">Jl. Raya Utama No. 123, Jakarta Pusat</p>
                        <div class="mt-2 space-y-1 text-xs">
                            <template x-for="nomor in data.whatsapp" :key="nomor.id ?? nomor.nomor">
    <p class="flex items-center gap-2 text-slate-600">
        <span class="font-semibold">📞</span>
        <span x-text="nomor.nomor"></span>
    </p>
</template>
                            <p class="flex items-center gap-2 text-slate-600"><span class="font-semibold">📧</span> <span x-text="data.email || 'info@arjunatrans.com'">info@arjunatrans.com</span></p>
                        </div>
                        <div class="mt-3 flex gap-3">
                            <a x-show="data.instagram" :href="data.instagram" target="_blank" class="text-slate-400 hover:text-orange-500">Instagram</a>
                            <a x-show="data.facebook" :href="data.facebook" target="_blank" class="text-slate-400 hover:text-orange-500">Facebook</a>
                            <a x-show="data.youtube" :href="data.youtube" target="_blank" class="text-slate-400 hover:text-orange-500">YouTube</a>
                            <a x-show="data.tiktok" :href="data.tiktok" target="_blank" class="text-slate-400 hover:text-orange-500">TikTok</a>
                        </div>
                    </div>
                    <div class="border-t border-slate-200 pt-4 text-center text-[10px] text-slate-400">
                        © 2024 Arjuna Trans. Crafted for Premium Travel Experience.
                    </div>
                </div>
            </div>
        </x-live-preview>
    </div>
</div>

<script>
    function kontakManager() {
        return {
            data: @json($kontak),

            tambahWhatsapp() {
                this.data.whatsapp.push({
                    id: null,
                    nomor: ''
                });
            },

            hapusWhatsapp(index) {
                this.data.whatsapp.splice(index, 1);
            },

            async saveAll() {
                try {
                    console.log(this.data);

                    const response = await window.arjunaRequest(
                        @json(route('admin.kontak.update')),
                        {
                            method: 'POST',
                            body: JSON.stringify(this.data)
                        }
                    );

                    this.data = response.data;

                    alert(response.message);

                } catch (error) {
                    alert(error.message);
                }
            }
        };
    }
</script>

@endsection