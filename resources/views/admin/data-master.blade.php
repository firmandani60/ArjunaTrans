@extends('layout.admin')
@section('title', 'Data Master Arjuna Trans')
@section('content')

<div x-data="dataMasterPage()" x-cloak class="space-y-6">
    <div x-show="toast.show" x-transition
         class="fixed right-6 top-6 z-[100] max-w-sm rounded-xl px-4 py-3 text-sm font-bold text-white shadow-xl"
         :class="toast.type === 'error' ? 'bg-rose-600' : 'bg-emerald-600'">
        <span x-text="toast.message"></span>
    </div>

    <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="flex flex-wrap gap-2 border-b border-slate-100 p-4">
            <template x-for="item in tabs" :key="item.key">
                <button type="button" @click="tab = item.key"
                        class="rounded-xl px-4 py-2.5 text-sm font-bold transition"
                        :class="tab === item.key ? 'bg-[#2F2F2F] text-orange-300' : 'bg-slate-50 text-slate-600 hover:bg-orange-50 hover:text-orange-600'">
                    <span x-text="item.label"></span>
                </button>
            </template>
        </div>

        <div class="p-5 md:p-6">
            {{-- ==================== ARMADA ==================== --}}
            <div x-show="tab === 'armada'" class="space-y-5">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h2 class="text-lg font-black text-slate-900">Master Armada</h2>
                        <p class="text-sm text-slate-500">Kelola jenis armada, fasilitas, harga sewa, dan foto kendaraan.</p>
                    </div>
                    <button type="button" @click="openFleetForm()"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-orange-500 px-4 py-2.5 text-sm font-bold text-white hover:bg-orange-600">
                        <i data-lucide="plus" class="h-4 w-4"></i> Tambah Armada
                    </button>
                </div>

                <form x-show="fleetFormOpen" x-transition @submit.prevent="saveFleet()"
                      class="rounded-2xl border border-orange-200 bg-orange-50/60 p-5 md:p-6">
                    <div class="mb-5 flex items-start justify-between gap-4">
                        <div>
                            <h3 class="text-xl font-black text-slate-900" x-text="fleetEditingId ? 'Edit Armada' : 'Tambah Armada'"></h3>
                            <p class="mt-1 text-sm text-slate-500">Ukuran input dibuat sedang agar nyaman diisi tanpa memenuhi layar.</p>
                        </div>
                        <button type="button" @click="closeFleetForm()" class="grid h-10 w-10 shrink-0 place-items-center rounded-xl border border-slate-200 bg-white text-slate-400 hover:text-slate-700">
                            <i data-lucide="x" class="h-5 w-5"></i>
                        </button>
                    </div>

                    <div class="grid gap-4 md:grid-cols-2">
                        <div class="space-y-1.5">
                            <label class="text-sm font-bold text-slate-700">Nama Armada <span class="text-rose-500">*</span></label>
                            <input x-model="fleetForm.name" required type="text" placeholder="Contoh: Elf Long Premium"
                                   class="h-12 w-full rounded-xl border border-slate-300 bg-white px-4 text-sm focus:border-orange-400 focus:ring-orange-400">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-sm font-bold text-slate-700">Kategori Armada</label>
                            <input x-model="fleetForm.category" type="text" placeholder="Contoh: Elf, Hiace, Medium Bus"
                                   class="h-12 w-full rounded-xl border border-slate-300 bg-white px-4 text-sm focus:border-orange-400 focus:ring-orange-400">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-sm font-bold text-slate-700">Kapasitas</label>
                            <input x-model="fleetForm.capacity" type="text" placeholder="Contoh: 19 Seat"
                                   class="h-12 w-full rounded-xl border border-slate-300 bg-white px-4 text-sm focus:border-orange-400 focus:ring-orange-400">
                        </div>
                        <div class="grid gap-4 sm:grid-cols-2">
                            <div class="space-y-1.5">
                                <label class="text-sm font-bold text-slate-700">Jumlah Unit</label>
                                <input x-model.number="fleetForm.unit_count" min="0" type="number" placeholder="1"
                                       class="h-12 w-full rounded-xl border border-slate-300 bg-white px-4 text-sm focus:border-orange-400 focus:ring-orange-400">
                            </div>
                            <div class="space-y-1.5">
                                <label class="text-sm font-bold text-slate-700">Harga / Hari</label>
                                <input x-model.number="fleetForm.daily_price" min="0" type="number" placeholder="850000"
                                       class="h-12 w-full rounded-xl border border-slate-300 bg-white px-4 text-sm focus:border-orange-400 focus:ring-orange-400">
                            </div>
                        </div>

                        <div class="space-y-2 md:col-span-2">
                            <div>
                                <label class="text-sm font-bold text-slate-700">Fasilitas Armada</label>
                                <p class="mt-1 text-xs text-slate-500">Tambah fasilitas satu per satu, misalnya AC, Bagasi Lebar, Bantal, TV, Reclining Seat.</p>
                            </div>
                            <div class="rounded-2xl border border-slate-200 bg-white p-4">
                                <div class="grid gap-3 md:grid-cols-2">
                                    <template x-for="(facility, index) in fleetFacilities" :key="index">
                                        <div class="flex items-center gap-2">
                                            <input x-model="fleetFacilities[index]" type="text" :placeholder="`Fasilitas ${index + 1}`"
                                                   class="h-11 min-w-0 flex-1 rounded-xl border border-slate-300 px-3.5 text-sm focus:border-orange-400 focus:ring-orange-400">
                                            <button type="button" @click="removeFacility(index)" class="grid h-11 w-11 shrink-0 place-items-center rounded-xl border border-rose-200 bg-rose-50 text-rose-500 hover:bg-rose-100">
                                                <i data-lucide="trash-2" class="h-4 w-4"></i>
                                            </button>
                                        </div>
                                    </template>
                                </div>
                                <div class="mt-3 flex flex-wrap gap-2">
                                    <button type="button" @click="addFacility()" class="inline-flex items-center gap-2 rounded-xl bg-[#2F2F2F] px-4 py-2.5 text-sm font-bold text-orange-300">
                                        <i data-lucide="plus" class="h-4 w-4"></i> Tambah Fasilitas
                                    </button>
                                    <button type="button" @click="addSuggestedFacility('AC')" class="rounded-full border border-orange-200 bg-orange-50 px-3 py-2 text-xs font-bold text-orange-700">+ AC</button>
                                    <button type="button" @click="addSuggestedFacility('Bagasi Lebar')" class="rounded-full border border-orange-200 bg-orange-50 px-3 py-2 text-xs font-bold text-orange-700">+ Bagasi Lebar</button>
                                    <button type="button" @click="addSuggestedFacility('Bantal')" class="rounded-full border border-orange-200 bg-orange-50 px-3 py-2 text-xs font-bold text-orange-700">+ Bantal</button>
                                    <button type="button" @click="addSuggestedFacility('Reclining Seat')" class="rounded-full border border-orange-200 bg-orange-50 px-3 py-2 text-xs font-bold text-orange-700">+ Reclining Seat</button>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-1.5 md:col-span-2">
                            <label class="text-sm font-bold text-slate-700">Deskripsi Armada</label>
                            <textarea x-model="fleetForm.description" rows="3" placeholder="Deskripsi singkat armada"
                                      class="min-h-24 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm focus:border-orange-400 focus:ring-orange-400"></textarea>
                        </div>

                        <div class="space-y-2 md:col-span-2">
                            <label class="text-sm font-bold text-slate-700">Foto Armada</label>
                            <div class="flex flex-col gap-4 rounded-2xl border border-dashed border-slate-300 bg-white p-4 sm:flex-row sm:items-center">
                                <div class="h-28 w-full overflow-hidden rounded-xl bg-slate-100 sm:w-44">
                                    <img x-show="fleetImagePreview || fleetForm.image_path" :src="fleetImagePreview || imageUrl(fleetForm.image_path)" class="h-full w-full object-cover">
                                    <div x-show="!fleetImagePreview && !fleetForm.image_path" class="grid h-full w-full place-items-center text-xs font-bold text-slate-400">Belum ada foto</div>
                                </div>
                                <div class="flex-1">
                                    <input x-ref="fleetImageInput" type="file" accept="image/jpeg,image/png,image/webp" @change="handleImage($event, 'fleet')" class="block w-full text-sm text-slate-600 file:mr-3 file:rounded-lg file:border-0 file:bg-orange-100 file:px-4 file:py-2.5 file:font-bold file:text-orange-700 hover:file:bg-orange-200">
                                    <p class="mt-2 text-xs text-slate-400">JPG, PNG, WEBP. Maksimal 5 MB.</p>
                                    <button x-show="fleetImagePreview || fleetForm.image_path" type="button" @click="clearImage('fleet')" class="mt-2 text-xs font-bold text-rose-500">Hapus foto</button>
                                </div>
                            </div>
                        </div>

                        <label class="flex h-12 items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 text-sm font-bold text-slate-600">
                            <input x-model="fleetForm.is_active" type="checkbox" class="rounded border-slate-300 text-orange-500 focus:ring-orange-400"> Aktif di landing page
                        </label>
                        <div class="flex items-center justify-end gap-2">
                            <button type="button" @click="closeFleetForm()" class="rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-bold text-slate-600">Batal</button>
                            <button type="submit" :disabled="saving" class="rounded-xl bg-orange-500 px-6 py-2.5 text-sm font-bold text-white hover:bg-orange-600 disabled:opacity-50" x-text="saving ? 'Menyimpan...' : 'Simpan'"></button>
                        </div>
                    </div>
                </form>

                <div class="overflow-x-auto rounded-2xl border border-slate-200">
                    <table class="min-w-full divide-y divide-slate-200 text-sm">
                        <thead class="bg-slate-50 text-left text-xs font-black uppercase tracking-wider text-slate-500">
                            <tr><th class="px-4 py-3">Armada</th><th class="px-4 py-3">Kapasitas</th><th class="px-4 py-3">Unit</th><th class="px-4 py-3">Harga/Hari</th><th class="px-4 py-3">Status</th><th class="px-4 py-3 text-right">Aksi</th></tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            <template x-for="item in armada" :key="item.id">
                                <tr>
                                    <td class="px-4 py-3"><div class="flex items-center gap-3"><img x-show="item.image_path" :src="imageUrl(item.image_path)" class="h-11 w-16 rounded-lg object-cover"><div><p class="font-bold text-slate-900" x-text="item.name"></p><p class="text-xs text-slate-500" x-text="item.category || '-'"></p></div></div></td>
                                    <td class="px-4 py-3 text-slate-600" x-text="item.capacity || '-'"></td>
                                    <td class="px-4 py-3 font-bold text-slate-700" x-text="item.unit_count"></td>
                                    <td class="px-4 py-3 font-bold text-orange-600" x-text="rupiah(item.daily_price)"></td>
                                    <td class="px-4 py-3"><span class="rounded-full px-2.5 py-1 text-xs font-bold" :class="item.is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-500'" x-text="item.is_active ? 'Aktif' : 'Draft'"></span></td>
                                    <td class="px-4 py-3"><div class="flex justify-end gap-1"><button @click="editFleet(item)" class="rounded-lg p-2 text-orange-500 hover:bg-orange-50"><i data-lucide="pencil" class="h-4 w-4"></i></button><button @click="deleteFleet(item)" class="rounded-lg p-2 text-rose-500 hover:bg-rose-50"><i data-lucide="trash-2" class="h-4 w-4"></i></button></div></td>
                                </tr>
                            </template>
                            <tr x-show="armada.length === 0"><td colspan="6" class="px-4 py-10 text-center text-slate-400">Belum ada data armada.</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- ==================== DESTINASI ==================== --}}
            <div x-show="tab === 'destinasi'" class="space-y-5">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <div><h2 class="text-lg font-black text-slate-900">Master Destinasi</h2><p class="text-sm text-slate-500">Kelola tujuan wisata dan foto yang tampil pada landing page.</p></div>
                    <button type="button" @click="openDestinationForm()" class="inline-flex items-center justify-center gap-2 rounded-xl bg-orange-500 px-4 py-2.5 text-sm font-bold text-white hover:bg-orange-600"><i data-lucide="plus" class="h-4 w-4"></i> Tambah Destinasi</button>
                </div>

                <form x-show="destinationFormOpen" x-transition @submit.prevent="saveDestination()" class="rounded-2xl border border-orange-200 bg-orange-50/60 p-5 md:p-6">
                    <div class="mb-5 flex items-start justify-between gap-4">
                        <div><h3 class="text-xl font-black text-slate-900" x-text="destinationEditingId ? 'Edit Destinasi' : 'Tambah Destinasi'"></h3><p class="mt-1 text-sm text-slate-500">Isi informasi tujuan dan pilih foto langsung dari perangkat.</p></div>
                        <button type="button" @click="closeDestinationForm()" class="grid h-10 w-10 place-items-center rounded-xl border border-slate-200 bg-white text-slate-400"><i data-lucide="x" class="h-5 w-5"></i></button>
                    </div>

                    <div class="grid gap-4 md:grid-cols-2">
                        <div class="space-y-1.5"><label class="text-sm font-bold text-slate-700">Nama Destinasi <span class="text-rose-500">*</span></label><input x-model="destinationForm.name" required type="text" placeholder="Contoh: Bromo" class="h-12 w-full rounded-xl border border-slate-300 bg-white px-4 text-sm focus:border-orange-400 focus:ring-orange-400"></div>
                        <div class="space-y-1.5"><label class="text-sm font-bold text-slate-700">Rute / Area</label><input x-model="destinationForm.route" type="text" placeholder="Contoh: Mojokerto - Bromo" class="h-12 w-full rounded-xl border border-slate-300 bg-white px-4 text-sm focus:border-orange-400 focus:ring-orange-400"></div>
                        <div class="space-y-1.5 md:col-span-2"><label class="text-sm font-bold text-slate-700">Deskripsi Destinasi</label><textarea x-model="destinationForm.description" rows="3" placeholder="Deskripsi singkat destinasi" class="min-h-24 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm focus:border-orange-400 focus:ring-orange-400"></textarea></div>
                        <div class="space-y-2 md:col-span-2">
                            <label class="text-sm font-bold text-slate-700">Foto Destinasi</label>
                            <div class="flex flex-col gap-4 rounded-2xl border border-dashed border-slate-300 bg-white p-4 sm:flex-row sm:items-center">
                                <div class="h-28 w-full overflow-hidden rounded-xl bg-slate-100 sm:w-44"><img x-show="destinationImagePreview || destinationForm.image_path" :src="destinationImagePreview || imageUrl(destinationForm.image_path)" class="h-full w-full object-cover"><div x-show="!destinationImagePreview && !destinationForm.image_path" class="grid h-full w-full place-items-center text-xs font-bold text-slate-400">Belum ada foto</div></div>
                                <div class="flex-1"><input x-ref="destinationImageInput" type="file" accept="image/jpeg,image/png,image/webp" @change="handleImage($event, 'destination')" class="block w-full text-sm text-slate-600 file:mr-3 file:rounded-lg file:border-0 file:bg-orange-100 file:px-4 file:py-2.5 file:font-bold file:text-orange-700 hover:file:bg-orange-200"><p class="mt-2 text-xs text-slate-400">JPG, PNG, WEBP. Maksimal 5 MB.</p><button x-show="destinationImagePreview || destinationForm.image_path" type="button" @click="clearImage('destination')" class="mt-2 text-xs font-bold text-rose-500">Hapus foto</button></div>
                            </div>
                        </div>
                        <label class="flex h-12 items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 text-sm font-bold text-slate-600"><input x-model="destinationForm.is_active" type="checkbox" class="rounded border-slate-300 text-orange-500 focus:ring-orange-400"> Aktif di landing page</label>
                        <div class="flex items-center justify-end gap-2"><button type="button" @click="closeDestinationForm()" class="rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-bold text-slate-600">Batal</button><button type="submit" :disabled="saving" class="rounded-xl bg-orange-500 px-6 py-2.5 text-sm font-bold text-white hover:bg-orange-600 disabled:opacity-50" x-text="saving ? 'Menyimpan...' : 'Simpan'"></button></div>
                    </div>
                </form>

                <div class="overflow-x-auto rounded-2xl border border-slate-200">
                    <table class="min-w-full divide-y divide-slate-200 text-sm">
                        <thead class="bg-slate-50 text-left text-xs font-black uppercase tracking-wider text-slate-500"><tr><th class="px-4 py-3">Destinasi</th><th class="px-4 py-3">Rute / Area</th><th class="px-4 py-3">Status</th><th class="px-4 py-3 text-right">Aksi</th></tr></thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            <template x-for="item in destinasi" :key="item.id"><tr><td class="px-4 py-3"><div class="flex items-center gap-3"><img x-show="item.image_path" :src="imageUrl(item.image_path)" class="h-11 w-16 rounded-lg object-cover"><div><p class="font-bold text-slate-900" x-text="item.name"></p><p class="max-w-md truncate text-xs text-slate-500" x-text="item.description || '-'"></p></div></div></td><td class="px-4 py-3 text-slate-600" x-text="item.route || '-'"></td><td class="px-4 py-3"><span class="rounded-full px-2.5 py-1 text-xs font-bold" :class="item.is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-500'" x-text="item.is_active ? 'Aktif' : 'Draft'"></span></td><td class="px-4 py-3"><div class="flex justify-end gap-1"><button @click="editDestination(item)" class="rounded-lg p-2 text-orange-500 hover:bg-orange-50"><i data-lucide="pencil" class="h-4 w-4"></i></button><button @click="deleteDestination(item)" class="rounded-lg p-2 text-rose-500 hover:bg-rose-50"><i data-lucide="trash-2" class="h-4 w-4"></i></button></div></td></tr></template>
                            <tr x-show="destinasi.length === 0"><td colspan="4" class="px-4 py-10 text-center text-slate-400">Belum ada data destinasi.</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- ==================== RUTE & HARGA ==================== --}}
            <div x-show="tab === 'rute'" class="space-y-5">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <div><h2 class="text-lg font-black text-slate-900">Master Rute & Harga</h2><p class="text-sm text-slate-500">Pilih tujuan dan jenis armada yang sudah dibuat sebelumnya, lalu tentukan harga sewanya.</p></div>
                    <button type="button" @click="openRouteForm()" class="inline-flex items-center justify-center gap-2 rounded-xl bg-orange-500 px-4 py-2.5 text-sm font-bold text-white hover:bg-orange-600"><i data-lucide="plus" class="h-4 w-4"></i> Tambah Rute & Harga</button>
                </div>

                <div x-show="destinasi.length === 0 || armada.length === 0" class="rounded-2xl border border-amber-200 bg-amber-50 p-4 text-sm text-amber-800">
                    Tambahkan minimal satu <strong>Destinasi</strong> dan satu <strong>Armada</strong> terlebih dahulu sebelum membuat Rute & Harga.
                </div>

                <form x-show="routeFormOpen" x-transition @submit.prevent="saveRoute()" class="rounded-2xl border border-orange-200 bg-orange-50/60 p-5 md:p-6">
                    <div class="mb-5 flex items-start justify-between gap-4">
                        <div><h3 class="text-xl font-black text-slate-900" x-text="routeEditingId ? 'Edit Rute & Harga' : 'Tambah Rute & Harga'"></h3><p class="mt-1 text-sm text-slate-500">Satu baris rute mewakili satu tujuan, satu jenis armada, dan satu harga.</p></div>
                        <button type="button" @click="closeRouteForm()" class="grid h-10 w-10 place-items-center rounded-xl border border-slate-200 bg-white text-slate-400"><i data-lucide="x" class="h-5 w-5"></i></button>
                    </div>

                    <div class="grid gap-4 md:grid-cols-2">
                        <div class="space-y-1.5">
                            <label class="text-sm font-bold text-slate-700">Nama Tujuan <span class="text-rose-500">*</span></label>
                            <select x-model.number="routeForm.destination_id" required @change="useDestinationImageIfEmpty()" class="h-12 w-full rounded-xl border border-slate-300 bg-white px-4 text-sm focus:border-orange-400 focus:ring-orange-400">
                                <option value="">Pilih destinasi</option>
                                <template x-for="item in destinasi" :key="item.id"><option :value="item.id" x-text="item.name"></option></template>
                            </select>
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-sm font-bold text-slate-700">Jenis Armada <span class="text-rose-500">*</span></label>
                            <select x-model.number="routeForm.fleet_id" required class="h-12 w-full rounded-xl border border-slate-300 bg-white px-4 text-sm focus:border-orange-400 focus:ring-orange-400">
                                <option value="">Pilih armada dari Master Armada</option>
                                <template x-for="item in armada" :key="item.id"><option :value="item.id" x-text="item.category ? `${item.name} · ${item.category}` : item.name"></option></template>
                            </select>
                        </div>
                        <div class="space-y-1.5 md:col-span-2"><label class="text-sm font-bold text-slate-700">Deskripsi Rute</label><textarea x-model="routeForm.route_description" rows="3" placeholder="Contoh: Berangkat dari Mojokerto, perjalanan menuju Bromo melalui Pasuruan" class="min-h-24 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm focus:border-orange-400 focus:ring-orange-400"></textarea></div>
                        <div class="space-y-1.5"><label class="text-sm font-bold text-slate-700">Harga Sewa <span class="text-rose-500">*</span></label><input x-model.number="routeForm.price" required min="0" type="number" placeholder="Contoh: 1800000" class="h-12 w-full rounded-xl border border-slate-300 bg-white px-4 text-sm focus:border-orange-400 focus:ring-orange-400"><p class="text-xs text-slate-400">Harga berlaku untuk armada yang dipilih pada tujuan tersebut.</p></div>
                        <div class="space-y-1.5"><label class="text-sm font-bold text-slate-700">Status</label><label class="flex h-12 items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 text-sm font-bold text-slate-600"><input x-model="routeForm.is_active" type="checkbox" class="rounded border-slate-300 text-orange-500 focus:ring-orange-400"> Aktif di landing page</label></div>

                        <div class="space-y-2 md:col-span-2">
                            <div class="flex flex-wrap items-center justify-between gap-2"><label class="text-sm font-bold text-slate-700">Gambar Tujuan</label><button type="button" @click="copySelectedDestinationImage()" class="text-xs font-bold text-orange-600 hover:text-orange-700">Gunakan foto dari Master Destinasi</button></div>
                            <div class="flex flex-col gap-4 rounded-2xl border border-dashed border-slate-300 bg-white p-4 sm:flex-row sm:items-center">
                                <div class="h-28 w-full overflow-hidden rounded-xl bg-slate-100 sm:w-44"><img x-show="routeImagePreview || routeForm.image_path" :src="routeImagePreview || imageUrl(routeForm.image_path)" class="h-full w-full object-cover"><div x-show="!routeImagePreview && !routeForm.image_path" class="grid h-full w-full place-items-center text-xs font-bold text-slate-400">Belum ada foto</div></div>
                                <div class="flex-1"><input x-ref="routeImageInput" type="file" accept="image/jpeg,image/png,image/webp" @change="handleImage($event, 'route')" class="block w-full text-sm text-slate-600 file:mr-3 file:rounded-lg file:border-0 file:bg-orange-100 file:px-4 file:py-2.5 file:font-bold file:text-orange-700 hover:file:bg-orange-200"><p class="mt-2 text-xs text-slate-400">Bisa memakai foto destinasi atau memilih foto lain dari file.</p><button x-show="routeImagePreview || routeForm.image_path" type="button" @click="clearImage('route')" class="mt-2 text-xs font-bold text-rose-500">Hapus foto</button></div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-2 md:col-span-2"><button type="button" @click="closeRouteForm()" class="rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-bold text-slate-600">Batal</button><button type="submit" :disabled="saving || !routeForm.destination_id || !routeForm.fleet_id" class="rounded-xl bg-orange-500 px-6 py-2.5 text-sm font-bold text-white hover:bg-orange-600 disabled:cursor-not-allowed disabled:opacity-50" x-text="saving ? 'Menyimpan...' : 'Simpan'"></button></div>
                    </div>
                </form>

                <div class="overflow-x-auto rounded-2xl border border-slate-200">
                    <table class="min-w-full divide-y divide-slate-200 text-sm">
                        <thead class="bg-slate-50 text-left text-xs font-black uppercase tracking-wider text-slate-500"><tr><th class="px-4 py-3">Tujuan</th><th class="px-4 py-3">Jenis Armada</th><th class="px-4 py-3">Deskripsi Rute</th><th class="px-4 py-3">Harga</th><th class="px-4 py-3">Status</th><th class="px-4 py-3 text-right">Aksi</th></tr></thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            <template x-for="item in rute" :key="item.id"><tr><td class="px-4 py-3"><div class="flex items-center gap-3"><img x-show="item.image_path" :src="imageUrl(item.image_path)" class="h-11 w-16 rounded-lg object-cover"><p class="font-bold text-slate-900" x-text="item.destination_name || '-'"></p></div></td><td class="px-4 py-3 font-semibold text-slate-700" x-text="item.fleet_name || '-'"></td><td class="max-w-xs px-4 py-3 text-slate-500"><p class="line-clamp-2" x-text="item.route_description || '-'"></p></td><td class="px-4 py-3 font-black text-orange-600" x-text="rupiah(item.price)"></td><td class="px-4 py-3"><span class="rounded-full px-2.5 py-1 text-xs font-bold" :class="item.is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-500'" x-text="item.is_active ? 'Aktif' : 'Draft'"></span></td><td class="px-4 py-3"><div class="flex justify-end gap-1"><button @click="editRoute(item)" class="rounded-lg p-2 text-orange-500 hover:bg-orange-50"><i data-lucide="pencil" class="h-4 w-4"></i></button><button @click="deleteRoute(item)" class="rounded-lg p-2 text-rose-500 hover:bg-rose-50"><i data-lucide="trash-2" class="h-4 w-4"></i></button></div></td></tr></template>
                            <tr x-show="rute.length === 0"><td colspan="6" class="px-4 py-10 text-center text-slate-400">Belum ada data rute & harga.</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

@push('scripts')
<script>
function dataMasterPage() {
    return {
        tab: new URLSearchParams(window.location.search).get('tab') || 'armada',
        tabs: [
            { key: 'armada', label: 'Armada' },
            { key: 'destinasi', label: 'Destinasi' },
            { key: 'rute', label: 'Rute & Harga' },
        ],
        armada: @js($armada),
        destinasi: @js($destinasi),
        rute: @js($rute),
        saving: false,
        toast: { show: false, message: '', type: 'success' },

        fleetFormOpen: false,
        fleetEditingId: null,
        fleetForm: {},
        fleetFacilities: [],
        fleetImageFile: null,
        fleetImagePreview: '',

        destinationFormOpen: false,
        destinationEditingId: null,
        destinationForm: {},
        destinationImageFile: null,
        destinationImagePreview: '',

        routeFormOpen: false,
        routeEditingId: null,
        routeForm: {},
        routeImageFile: null,
        routeImagePreview: '',

        init() {
            if (!['armada', 'destinasi', 'rute'].includes(this.tab)) this.tab = 'armada';
            this.resetFleetForm();
            this.resetDestinationForm();
            this.resetRouteForm();
            this.$nextTick(() => window.lucide && lucide.createIcons());
        },

        notify(message, type = 'success') {
            this.toast = { show: true, message, type };
            setTimeout(() => this.toast.show = false, 3000);
        },
        rupiah(value) {
            if (value === null || value === undefined || value === '') return '-';
            return 'Rp ' + Number(value).toLocaleString('id-ID');
        },
        imageUrl(path) {
            if (!path) return '';
            if (/^(https?:)?\/\//i.test(path) || path.startsWith('data:') || path.startsWith('blob:')) return path;
            const clean = String(path).replace(/^\/+/, '').replace(/^storage\//, '');
            return @js(asset('storage')) + '/' + clean;
        },
        replaceItem(list, item) {
            const index = list.findIndex(row => Number(row.id) === Number(item.id));
            if (index >= 0) list.splice(index, 1, item); else list.push(item);
            this.$nextTick(() => window.lucide && lucide.createIcons());
        },
        validateImage(file) {
            if (!file) return false;
            if (!['image/jpeg', 'image/png', 'image/webp'].includes(file.type)) {
                this.notify('Format gambar harus JPG, PNG, atau WEBP.', 'error');
                return false;
            }
            if (file.size > 5 * 1024 * 1024) {
                this.notify('Ukuran gambar maksimal 5 MB.', 'error');
                return false;
            }
            return true;
        },
        handleImage(event, type) {
            const file = event.target.files?.[0];
            if (!this.validateImage(file)) { event.target.value = ''; return; }
            const fileKey = `${type}ImageFile`;
            const previewKey = `${type}ImagePreview`;
            if (this[previewKey]?.startsWith('blob:')) URL.revokeObjectURL(this[previewKey]);
            this[fileKey] = file;
            this[previewKey] = URL.createObjectURL(file);
        },
        clearImage(type) {
            const formKey = `${type}Form`;
            const fileKey = `${type}ImageFile`;
            const previewKey = `${type}ImagePreview`;
            const refName = `${type}ImageInput`;
            if (this[previewKey]?.startsWith('blob:')) URL.revokeObjectURL(this[previewKey]);
            this[fileKey] = null;
            this[previewKey] = '';
            this[formKey].image_path = '';
            if (this.$refs?.[refName]) this.$refs[refName].value = '';
        },
        async uploadImageIfNeeded(type, currentPath = '') {
            const file = this[`${type}ImageFile`];
            if (!file) return currentPath || '';
            const uploaded = await window.arjunaUploadImage(file);
            return uploaded.path;
        },

        // ARMADA
        resetFleetForm() {
            this.fleetForm = { name: '', category: '', description: '', capacity: '', facilities: '', unit_count: 1, daily_price: null, image_path: '', is_active: true };
            this.fleetFacilities = [''];
            this.fleetImageFile = null;
            this.fleetImagePreview = '';
        },
        openFleetForm() { this.fleetEditingId = null; this.resetFleetForm(); this.fleetFormOpen = true; this.$nextTick(() => window.lucide && lucide.createIcons()); },
        editFleet(item) {
            this.fleetEditingId = item.id;
            this.fleetForm = { ...item };
            const facilities = String(item.facilities || '').split(/\s*[|,]\s*/).map(v => v.trim()).filter(Boolean);
            this.fleetFacilities = facilities.length ? facilities : [''];
            this.fleetImageFile = null; this.fleetImagePreview = ''; this.fleetFormOpen = true;
            window.scrollTo({ top: 0, behavior: 'smooth' });
        },
        closeFleetForm() { this.fleetFormOpen = false; this.fleetEditingId = null; this.resetFleetForm(); },
        addFacility() { this.fleetFacilities.push(''); this.$nextTick(() => window.lucide && lucide.createIcons()); },
        addSuggestedFacility(value) {
            const clean = String(value || '').trim();
            const current = this.fleetFacilities.map(v => String(v || '').trim()).filter(Boolean);
            if (clean && !current.some(v => v.toLowerCase() === clean.toLowerCase())) current.push(clean);
            this.fleetFacilities = current.length ? current : [''];
        },
        removeFacility(index) { this.fleetFacilities.splice(index, 1); if (!this.fleetFacilities.length) this.fleetFacilities = ['']; },
        async saveFleet() {
            this.saving = true;
            try {
                const imagePath = await this.uploadImageIfNeeded('fleet', this.fleetForm.image_path);
                const facilities = this.fleetFacilities.map(v => String(v || '').trim()).filter(Boolean);
                const payload = { ...this.fleetForm, facilities: facilities.join(' | '), image_path: imagePath, unit_count: Number(this.fleetForm.unit_count || 0), daily_price: this.fleetForm.daily_price === '' || this.fleetForm.daily_price === null ? null : Number(this.fleetForm.daily_price), is_active: Boolean(this.fleetForm.is_active) };
                const base = @js(url('/admin/data-master/armada'));
                const response = await window.arjunaRequest(this.fleetEditingId ? `${base}/${this.fleetEditingId}` : base, { method: this.fleetEditingId ? 'PATCH' : 'POST', body: JSON.stringify(payload) });
                this.replaceItem(this.armada, response.data); this.notify(response.message); this.closeFleetForm();
                // Nama armada pada daftar rute ikut tersinkron dari server setelah reload. Untuk tampilan saat ini, perbarui juga bila perlu.
                this.rute.forEach(route => { if (Number(route.fleet_id) === Number(response.data.id)) route.fleet_name = response.data.name; });
            } catch (error) { this.notify(error.message, 'error'); } finally { this.saving = false; }
        },
        async deleteFleet(item) {
            if (!confirm(`Hapus armada “${item.name}”?`)) return;
            try { const base = @js(url('/admin/data-master/armada')); const response = await window.arjunaRequest(`${base}/${item.id}`, { method: 'DELETE' }); this.armada = this.armada.filter(row => Number(row.id) !== Number(item.id)); this.notify(response.message); } catch (error) { this.notify(error.message, 'error'); }
        },

        // DESTINASI
        resetDestinationForm() { this.destinationForm = { name: '', route: '', description: '', image_path: '', is_active: true }; this.destinationImageFile = null; this.destinationImagePreview = ''; },
        openDestinationForm() { this.destinationEditingId = null; this.resetDestinationForm(); this.destinationFormOpen = true; },
        editDestination(item) { this.destinationEditingId = item.id; this.destinationForm = { ...item }; this.destinationImageFile = null; this.destinationImagePreview = ''; this.destinationFormOpen = true; window.scrollTo({ top: 0, behavior: 'smooth' }); },
        closeDestinationForm() { this.destinationFormOpen = false; this.destinationEditingId = null; this.resetDestinationForm(); },
        async saveDestination() {
            this.saving = true;
            try {
                const imagePath = await this.uploadImageIfNeeded('destination', this.destinationForm.image_path);
                const payload = { ...this.destinationForm, image_path: imagePath, is_active: Boolean(this.destinationForm.is_active) };
                const base = @js(url('/admin/data-master/destinasi'));
                const response = await window.arjunaRequest(this.destinationEditingId ? `${base}/${this.destinationEditingId}` : base, { method: this.destinationEditingId ? 'PATCH' : 'POST', body: JSON.stringify(payload) });
                this.replaceItem(this.destinasi, response.data); this.notify(response.message); this.closeDestinationForm();
                this.rute.forEach(route => { if (Number(route.destination_id) === Number(response.data.id)) route.destination_name = response.data.name; });
            } catch (error) { this.notify(error.message, 'error'); } finally { this.saving = false; }
        },
        async deleteDestination(item) {
            if (!confirm(`Hapus destinasi “${item.name}”?`)) return;
            try { const base = @js(url('/admin/data-master/destinasi')); const response = await window.arjunaRequest(`${base}/${item.id}`, { method: 'DELETE' }); this.destinasi = this.destinasi.filter(row => Number(row.id) !== Number(item.id)); this.notify(response.message); } catch (error) { this.notify(error.message, 'error'); }
        },

        // RUTE & HARGA
        resetRouteForm() { this.routeForm = { destination_id: '', fleet_id: '', route_description: '', price: null, image_path: '', is_active: true }; this.routeImageFile = null; this.routeImagePreview = ''; },
        openRouteForm() {
            if (!this.destinasi.length || !this.armada.length) { this.notify('Tambahkan Destinasi dan Armada terlebih dahulu.', 'error'); return; }
            this.routeEditingId = null; this.resetRouteForm(); this.routeFormOpen = true;
        },
        editRoute(item) { this.routeEditingId = item.id; this.routeForm = { ...item, destination_id: item.destination_id || '', fleet_id: item.fleet_id || '' }; this.routeImageFile = null; this.routeImagePreview = ''; this.routeFormOpen = true; window.scrollTo({ top: 0, behavior: 'smooth' }); },
        closeRouteForm() { this.routeFormOpen = false; this.routeEditingId = null; this.resetRouteForm(); },
        selectedDestination() { return this.destinasi.find(item => Number(item.id) === Number(this.routeForm.destination_id)); },
        useDestinationImageIfEmpty() { if (!this.routeForm.image_path && !this.routeImageFile) this.copySelectedDestinationImage(); },
        copySelectedDestinationImage() { const destination = this.selectedDestination(); if (destination?.image_path) { this.clearImage('route'); this.routeForm.image_path = destination.image_path; } else this.notify('Destinasi yang dipilih belum memiliki foto.', 'error'); },
        async saveRoute() {
            this.saving = true;
            try {
                let imagePath = await this.uploadImageIfNeeded('route', this.routeForm.image_path);
                if (!imagePath) imagePath = this.selectedDestination()?.image_path || '';
                const payload = { destination_id: Number(this.routeForm.destination_id), fleet_id: Number(this.routeForm.fleet_id), route_description: this.routeForm.route_description || '', price: Number(this.routeForm.price || 0), image_path: imagePath, is_active: Boolean(this.routeForm.is_active) };
                const base = @js(url('/admin/data-master/rute'));
                const response = await window.arjunaRequest(this.routeEditingId ? `${base}/${this.routeEditingId}` : base, { method: this.routeEditingId ? 'PATCH' : 'POST', body: JSON.stringify(payload) });
                this.replaceItem(this.rute, response.data); this.notify(response.message); this.closeRouteForm();
            } catch (error) { this.notify(error.message, 'error'); } finally { this.saving = false; }
        },
        async deleteRoute(item) {
            if (!confirm(`Hapus rute “${item.destination_name} - ${item.fleet_name || 'Armada'}”?`)) return;
            try { const base = @js(url('/admin/data-master/rute')); const response = await window.arjunaRequest(`${base}/${item.id}`, { method: 'DELETE' }); this.rute = this.rute.filter(row => Number(row.id) !== Number(item.id)); this.notify(response.message); } catch (error) { this.notify(error.message, 'error'); }
        },
    };
}
</script>
@endpush
@endsection
