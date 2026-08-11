@extends('layout.admin')
@section('title', 'Master Data Arjuna Trans')
@section('content')

<div x-data="dataMaster()" class="space-y-6">
    <section class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div class="flex flex-wrap gap-2">
            <button type="button" @click="syncNow()" class="inline-flex items-center gap-1 rounded-lg border border-slate-300 bg-white px-4 py-2 text-xs font-bold text-slate-600 transition hover:bg-slate-50">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                Sync Now
            </button>
            <button type="button" @click="publishAll()" class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-orange-500 to-orange-600 px-5 py-2.5 text-sm font-bold text-white shadow-[0_10px_25px_rgba(249,115,22,0.25)] transition hover:-translate-y-0.5">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                PUBLISH ALL
            </button>
        </div>
    </section>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <h2 class="text-base font-bold text-slate-900">Kategori Armada</h2>
                <button type="button" @click="showArmadaForm = true" class="inline-flex items-center gap-1 rounded-lg bg-orange-500 px-3 py-1.5 text-xs font-bold text-white transition hover:bg-orange-600">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14"/></svg>
                    Tambah Armada
                </button>
            </div>

            <template x-if="showArmadaForm">
                <div class="mt-3 rounded-xl border border-orange-200 bg-orange-50/70 p-3">
                    <div class="grid grid-cols-2 gap-2">
                        <input type="text" x-model="newArmada.nama" placeholder="Nama Armada" class="col-span-2 rounded-lg border border-slate-300 px-3 py-1.5 text-sm focus:border-orange-400 focus:ring-1 focus:ring-orange-400">
                        <input type="text" x-model="newArmada.kapasitas" placeholder="Kapasitas (45 Seat)" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm focus:border-orange-400 focus:ring-1 focus:ring-orange-400">
                        <input type="text" x-model="newArmada.fasilitas" placeholder="Fasilitas (pisah koma)" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm focus:border-orange-400 focus:ring-1 focus:ring-orange-400">
                        <input type="number" x-model="newArmada.jumlah" placeholder="Jumlah Unit" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm focus:border-orange-400 focus:ring-1 focus:ring-orange-400">
                        <input type="text" x-model="newArmada.harga_sewa" placeholder="Harga Sewa/Hari" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm focus:border-orange-400 focus:ring-1 focus:ring-orange-400">
                        <select x-model="newArmada.status" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm focus:border-orange-400 focus:ring-1 focus:ring-orange-400">
                            <option value="active">Active</option>
                            <option value="draft">Draft</option>
                        </select>
                        <div class="col-span-2 flex justify-end gap-2">
                            <button type="button" @click="batalArmada()" class="rounded-lg border border-slate-300 px-3 py-1 text-xs font-bold text-slate-600 hover:bg-slate-100">Batal</button>
                            <button type="button" @click="simpanArmada()" class="rounded-lg bg-orange-500 px-3 py-1 text-xs font-bold text-white hover:bg-orange-600">Simpan</button>
                        </div>
                    </div>
                </div>
            </template>

            <div class="mt-4 space-y-3">
                <template x-for="item in armada" :key="item.id">
                    <div class="rounded-xl border border-slate-200 bg-slate-50/70 p-3">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <p class="text-sm font-bold text-slate-900" x-text="item.nama"></p>
                                    <span class="rounded-full px-2 py-0.5 text-[10px] font-bold" :class="item.status === 'active' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700'" x-text="item.status === 'active' ? 'Active' : 'Draft'"></span>
                                    <span class="rounded-full bg-orange-100 px-2 py-0.5 text-[10px] font-bold text-orange-700" x-text="item.jumlah + ' unit'"></span>
                                </div>
                                <p class="text-xs text-slate-500" x-text="'Kapasitas: ' + item.kapasitas"></p>
                                <p class="text-xs font-bold text-orange-600" x-text="'Rp ' + Number(item.harga_sewa || 0).toLocaleString('id-ID') + ' / hari'"></p>
                                <div class="mt-1 flex flex-wrap gap-1">
                                    <template x-for="f in item.fasilitas.split(',')" :key="f">
                                        <span class="rounded-full bg-slate-200 px-2 py-0.5 text-[10px] text-slate-600" x-text="f.trim()"></span>
                                    </template>
                                </div>
                            </div>
                            <div class="flex gap-1">
                                <button type="button" @click="editArmada(item.id)" class="rounded-lg p-1 text-orange-500 transition hover:bg-orange-50">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </button>
                                <button type="button" @click="hapusArmada(item.id)" class="rounded-lg p-1 text-rose-500 transition hover:bg-rose-50">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </template>
                <template x-if="armada.length === 0">
                    <div class="py-6 text-center text-sm text-slate-400">Belum ada kategori armada.</div>
                </template>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <h2 class="text-base font-bold text-slate-900">Master Destinasi</h2>
                <button type="button" @click="showDestinasiForm = true" class="inline-flex items-center gap-1 rounded-lg bg-orange-500 px-3 py-1.5 text-xs font-bold text-white transition hover:bg-orange-600">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14"/></svg>
                    Tambah Destinasi
                </button>
            </div>

            <template x-if="showDestinasiForm">
                <div class="mt-3 rounded-xl border border-orange-200 bg-orange-50/70 p-3">
                    <div class="grid grid-cols-2 gap-2">
                        <input type="text" x-model="newDestinasi.nama" placeholder="Nama Destinasi" class="col-span-2 rounded-lg border border-slate-300 px-3 py-1.5 text-sm focus:border-orange-400 focus:ring-1 focus:ring-orange-400">
                        <input type="text" x-model="newDestinasi.rute" placeholder="Rute Terkait" class="col-span-2 rounded-lg border border-slate-300 px-3 py-1.5 text-sm focus:border-orange-400 focus:ring-1 focus:ring-orange-400">
                        <div class="col-span-2 flex justify-end gap-2">
                            <button type="button" @click="batalDestinasi()" class="rounded-lg border border-slate-300 px-3 py-1 text-xs font-bold text-slate-600 hover:bg-slate-100">Batal</button>
                            <button type="button" @click="simpanDestinasi()" class="rounded-lg bg-orange-500 px-3 py-1 text-xs font-bold text-white hover:bg-orange-600">Simpan</button>
                        </div>
                    </div>
                </div>
            </template>

            <div class="mt-4 space-y-2">
                <template x-for="item in destinasi" :key="item.id">
                    <div class="flex items-center justify-between rounded-lg border border-slate-200 bg-slate-50/70 px-3 py-2">
                        <div>
                            <p class="text-sm font-bold text-slate-900" x-text="item.nama"></p>
                            <p class="text-xs text-slate-500" x-text="item.rute"></p>
                        </div>
                        <button type="button" @click="hapusDestinasi(item.id)" class="rounded-lg p-1 text-rose-500 transition hover:bg-rose-50">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                </template>
                <template x-if="destinasi.length === 0">
                    <div class="py-6 text-center text-sm text-slate-400">Belum ada destinasi.</div>
                </template>
            </div>
        </div>
    </div>

    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
        <div class="flex items-center justify-between">
            <h2 class="text-base font-bold text-slate-900">Route & Harga Detail</h2>
            <button type="button" @click="showRouteForm = true" class="inline-flex items-center gap-1 rounded-lg bg-orange-500 px-3 py-1.5 text-xs font-bold text-white transition hover:bg-orange-600">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14"/></svg>
                Tambah Rute
            </button>
        </div>

        <template x-if="showRouteForm">
            <div class="mt-3 rounded-xl border border-orange-200 bg-orange-50/70 p-3">
                <div class="grid grid-cols-2 gap-2">
                    <input type="text" x-model="newRoute.nama_rute" placeholder="Nama Rute (base)" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm focus:border-orange-400 focus:ring-1 focus:ring-orange-400">
                    <select x-model="newRoute.destinasi_id" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm focus:border-orange-400 focus:ring-1 focus:ring-orange-400">
                        <option value="">Pilih Destinasi</option>
                        <template x-for="d in destinasi" :key="d.id">
                            <option :value="d.id" x-text="d.nama"></option>
                        </template>
                    </select>
                    <input type="text" x-model="newRoute.drop_off" placeholder="Titik Drop-off" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm focus:border-orange-400 focus:ring-1 focus:ring-orange-400">
                    <select x-model="newRoute.tipe_armada" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm focus:border-orange-400 focus:ring-1 focus:ring-orange-400">
                        <option value="Elf Long">Elf Long</option>
                        <option value="Medium Bus">Medium Bus</option>
                        <option value="Hiace Premio">Hiace Premio</option>
                    </select>
                    <input type="text" x-model="newRoute.harga" placeholder="Harga (IDR)" class="rounded-lg border border-slate-300 px-3 py-1.5 text-sm focus:border-orange-400 focus:ring-1 focus:ring-orange-400">
                    <div class="col-span-2 flex justify-end gap-2">
                        <button type="button" @click="batalRoute()" class="rounded-lg border border-slate-300 px-3 py-1 text-xs font-bold text-slate-600 hover:bg-slate-100">Batal</button>
                        <button type="button" @click="simpanRoute()" class="rounded-lg bg-orange-500 px-3 py-1 text-xs font-bold text-white hover:bg-orange-600">Simpan</button>
                    </div>
                </div>
            </div>
        </template>

        <div class="mt-4 overflow-x-auto">
            <table class="w-full min-w-[700px] border-collapse text-sm">
                <thead>
                    <tr class="border-b border-slate-200 bg-slate-50 text-left text-xs font-bold uppercase text-slate-500">
                        <th class="px-3 py-2">ID</th>
                        <th class="px-3 py-2">Destinasi</th>
                        <th class="px-3 py-2">Nama Rute</th>
                        <th class="px-3 py-2">Drop-off</th>
                        <th class="px-3 py-2">Tipe Armada</th>
                        <th class="px-3 py-2 text-right">Harga</th>
                        <th class="px-3 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="(item, index) in routes" :key="item.id">
                        <tr class="border-b border-slate-100 hover:bg-slate-50/70">
                            <td class="px-3 py-2 text-xs font-bold text-slate-500" x-text="String(index + 1).padStart(2, '0')">01</td>
                            <td class="px-3 py-2 font-semibold text-slate-800" x-text="item.destinasi_nama || '-'"></td>
                            <td class="px-3 py-2 font-semibold text-slate-800" x-text="item.nama_rute"></td>
                            <td class="px-3 py-2 text-slate-600" x-text="item.drop_off"></td>
                            <td class="px-3 py-2 text-slate-600" x-text="item.tipe_armada"></td>
                            <td class="px-3 py-2 text-right font-semibold text-orange-600" x-text="'Rp ' + Number(item.harga).toLocaleString('id-ID')"></td>
                            <td class="px-3 py-2 text-center">
                                <button type="button" @click="hapusRoute(index)" class="rounded-lg p-1 text-rose-500 transition hover:bg-rose-50">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </td>
                        </tr>
                    </template>
                    <template x-if="routes.length === 0">
                        <tr><td colspan="7" class="py-6 text-center text-sm text-slate-400">Belum ada data rute.</td></tr>
                    </template>
                </tbody>
            </table>
        </div>
    </div>

    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
        <div class="flex items-center justify-between">
            <h2 class="text-base font-bold text-slate-900">Data Fasilitas</h2>
            <button type="button" @click="showFasilitasForm = true" class="inline-flex items-center gap-1 rounded-lg bg-orange-500 px-3 py-1.5 text-xs font-bold text-white transition hover:bg-orange-600">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14"/></svg>
                Tambah Fasilitas
            </button>
        </div>

        <template x-if="showFasilitasForm">
            <div class="mt-3 rounded-xl border border-orange-200 bg-orange-50/70 p-3">
                <div class="flex gap-2">
                    <input type="text" x-model="newFasilitas.nama" placeholder="Nama Fasilitas" class="flex-1 rounded-lg border border-slate-300 px-3 py-1.5 text-sm focus:border-orange-400 focus:ring-1 focus:ring-orange-400">
                    <button type="button" @click="batalFasilitas()" class="rounded-lg border border-slate-300 px-3 py-1 text-xs font-bold text-slate-600 hover:bg-slate-100">Batal</button>
                    <button type="button" @click="simpanFasilitas()" class="rounded-lg bg-orange-500 px-3 py-1 text-xs font-bold text-white hover:bg-orange-600">Simpan</button>
                </div>
            </div>
        </template>

        <div class="mt-4 space-y-1.5">
            <template x-for="item in fasilitas" :key="item.id">
                <div class="flex items-center justify-between rounded-lg border border-slate-200 bg-slate-50/70 px-3 py-2">
                    <span class="text-sm text-slate-700" x-text="item.nama"></span>
                    <button type="button" @click="hapusFasilitas(item.id)" class="rounded-lg p-1 text-rose-500 transition hover:bg-rose-50">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </template>
            <template x-if="fasilitas.length === 0">
                <div class="py-6 text-center text-sm text-slate-400">Belum ada data fasilitas.</div>
            </template>
        </div>
    </div>
</div>

<script>
    function dataMaster() {
        return {
            armada: [
                { id: 1, nama: 'Bus Besar', kapasitas: '45-50 Seat', fasilitas: 'Full AC, Smart TV & Karaoke, Reclining Seat', jumlah: 5, harga_sewa: '2000000', status: 'active' },
                { id: 2, nama: 'Isuzu Elf Long', kapasitas: '19 Seat', fasilitas: 'Full AC, Audio System, Reclining Seat', jumlah: 3, harga_sewa: '1500000', status: 'active' },
                { id: 3, nama: 'Hiace Premio', kapasitas: '14 Seat', fasilitas: 'Executive AC, Captain Seat', jumlah: 2, harga_sewa: '1200000', status: 'draft' }
            ],
            showArmadaForm: false,
            newArmada: { nama: '', kapasitas: '', fasilitas: '', jumlah: '', harga_sewa: '', status: 'active' },
            nextArmadaId: 4,

            destinasi: [
                { id: 1, nama: 'Trenggalek', rute: 'Rute Pantai Prigi' },
                { id: 2, nama: 'Wali 5', rute: 'Ziarah Religi Jatim' },
                { id: 3, nama: 'BWI (Banyuwangi)', rute: 'Ijen & Baluran' },
                { id: 4, nama: 'Jogja', rute: 'Malioboro & Candi' }
            ],
            showDestinasiForm: false,
            newDestinasi: { nama: '', rute: '' },
            nextDestinasiId: 5,

            routes: [
                { id: 1, destinasi_id: 1, destinasi_nama: 'Trenggalek', nama_rute: 'Mojokerto - Trenggalek', drop_off: 'Pantai Prigi', tipe_armada: 'Elf Long', harga: '1800000' },
                { id: 2, destinasi_id: 2, destinasi_nama: 'Wali 5', nama_rute: 'Mojokerto - Wali 5', drop_off: 'Makam Wali', tipe_armada: 'Elf Long', harga: '1850000' },
                { id: 3, destinasi_id: 4, destinasi_nama: 'Jogja', nama_rute: 'Mojokerto - Jogja', drop_off: 'Malioboro', tipe_armada: 'Medium Bus', harga: '3200000' }
            ],
            showRouteForm: false,
            newRoute: { nama_rute: '', destinasi_id: '', drop_off: '', tipe_armada: 'Elf Long', harga: '' },
            nextRouteId: 4,

            fasilitas: [
                { id: 1, nama: 'Armada Bersih dan Terawat' },
                { id: 2, nama: 'Driver Professional dan Ramah' },
                { id: 3, nama: 'Harga Kompetitif' }
            ],
            showFasilitasForm: false,
            newFasilitas: { nama: '' },
            nextFasilitasId: 4,

            lastPublished: '24 Oct 2023, 14:30 WIB',

            get pendingChanges() {
                // Simulasi: hitung total data
                return this.armada.length + this.destinasi.length + this.routes.length + this.fasilitas.length;
            },

            simpanArmada() {
                if (!this.newArmada.nama.trim()) {
                    alert('Nama armada harus diisi.');
                    return;
                }
                this.armada.push({
                    id: this.nextArmadaId++,
                    nama: this.newArmada.nama,
                    kapasitas: this.newArmada.kapasitas || '-',
                    fasilitas: this.newArmada.fasilitas || '-',
                    jumlah: this.newArmada.jumlah || '0',
                    harga_sewa: this.newArmada.harga_sewa || '0',
                    status: this.newArmada.status || 'active'
                });
                this.batalArmada();
            },
            batalArmada() {
                this.showArmadaForm = false;
                this.newArmada = { nama: '', kapasitas: '', fasilitas: '', jumlah: '', harga_sewa: '', status: 'active' };
            },
            hapusArmada(id) {
                if (confirm('Hapus armada ini?')) {
                    this.armada = this.armada.filter(a => a.id !== id);
                }
            },
            editArmada(id) {
                alert('Edit armada ID: ' + id + ' (fitur segera hadir)');
            },

            simpanDestinasi() {
                if (!this.newDestinasi.nama.trim()) {
                    alert('Nama destinasi harus diisi.');
                    return;
                }
                this.destinasi.push({
                    id: this.nextDestinasiId++,
                    nama: this.newDestinasi.nama,
                    rute: this.newDestinasi.rute || ''
                });
                this.batalDestinasi();
            },
            batalDestinasi() {
                this.showDestinasiForm = false;
                this.newDestinasi = { nama: '', rute: '' };
            },
            hapusDestinasi(id) {
                if (confirm('Hapus destinasi ini?')) {
                    this.destinasi = this.destinasi.filter(d => d.id !== id);
                }
            },

            simpanRoute() {
                if (!this.newRoute.nama_rute.trim()) {
                    alert('Nama rute harus diisi.');
                    return;
                }
                const destinasi = this.destinasi.find(d => d.id == this.newRoute.destinasi_id);
                this.routes.push({
                    id: this.nextRouteId++,
                    destinasi_id: this.newRoute.destinasi_id || null,
                    destinasi_nama: destinasi ? destinasi.nama : '-',
                    nama_rute: this.newRoute.nama_rute,
                    drop_off: this.newRoute.drop_off || '',
                    tipe_armada: this.newRoute.tipe_armada || 'Elf Long',
                    harga: this.newRoute.harga || '0'
                });
                this.batalRoute();
            },
            batalRoute() {
                this.showRouteForm = false;
                this.newRoute = { nama_rute: '', destinasi_id: '', drop_off: '', tipe_armada: 'Elf Long', harga: '' };
            },
            hapusRoute(index) {
                if (confirm('Hapus rute ini?')) {
                    this.routes.splice(index, 1);
                }
            },

            simpanFasilitas() {
                if (!this.newFasilitas.nama.trim()) {
                    alert('Nama fasilitas harus diisi.');
                    return;
                }
                this.fasilitas.push({
                    id: this.nextFasilitasId++,
                    nama: this.newFasilitas.nama
                });
                this.batalFasilitas();
            },
            batalFasilitas() {
                this.showFasilitasForm = false;
                this.newFasilitas = { nama: '' };
            },
            hapusFasilitas(id) {
                if (confirm('Hapus fasilitas ini?')) {
                    this.fasilitas = this.fasilitas.filter(f => f.id !== id);
                }
            },

            syncNow() {
                alert('Sinkronisasi data sedang berjalan... (simulasi)');
            },
            publishAll() {
                if (confirm('Publikasikan semua perubahan ke landing page?')) {
                    this.lastPublished = new Date().toLocaleString('id-ID', {
                        day: '2-digit',
                        month: 'short',
                        year: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                    alert('Semua perubahan berhasil dipublikasikan!');
                }
            }
        };
    }
</script>
@endsection