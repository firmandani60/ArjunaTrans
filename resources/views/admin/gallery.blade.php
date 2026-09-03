@extends('layout.admin')
@section('title', 'Gallery Master Arjuna Trans')
@section('content')

<div x-data="galleryPage()" x-cloak class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-lg font-black text-slate-900">Gallery Armada & Destinasi</h2>
            <p class="text-sm text-slate-500">Kelola kumpulan foto untuk tiap armada dan tujuan wisata.</p>
        </div>
    </div>

    <!-- Layout Dua Kolom (Kiri: Form/Data, Kanan: Preview) -->
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-[1fr_1.1fr]">
        
        <!-- SISI KIRI: PENGATURAN GALERI -->
        <section class="space-y-6">
            <!-- Alert Messages -->
            @if(session('success'))
                <div class="rounded-xl bg-emerald-50 p-4 border border-emerald-200">
                    <p class="text-sm font-bold text-emerald-700">{{ session('success') }}</p>
                </div>
            @endif

            <!-- Form Upload Dinamis -->
            <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" class="rounded-2xl border border-orange-200 bg-orange-50/60 p-5 shadow-sm">
                @csrf
                <div class="mb-4 border-b border-orange-200/60 pb-4">
                    <h3 class="text-base font-black text-slate-900">Upload Gambar Baru</h3>
                </div>

                <div class="space-y-5">
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold uppercase text-slate-500">Pilih Relasi *</label>
                        <select name="entity" required class="h-11 w-full rounded-xl border border-slate-300 bg-white px-3 text-sm focus:border-orange-400 focus:ring-1 focus:ring-orange-400">
                            <option value="">-- Pilih Armada / Destinasi --</option>
                            <optgroup label="Daftar Armada">
                                @foreach($armadas as $armada)
                                    <option value="App\Models\Fleet,{{ $armada->id }}">Armada: {{ $armada->name ?? $armada->nama_armada ?? 'ID '.$armada->id }}</option>
                                @endforeach
                            </optgroup>
                            <optgroup label="Daftar Destinasi">
                                @foreach($destinasis as $destinasi)
                                    <option value="App\Models\Destination,{{ $destinasi->id }}">Destinasi: {{ $destinasi->name ?? $destinasi->nama_destinasi ?? 'ID '.$destinasi->id }}</option>
                                @endforeach
                            </optgroup>
                        </select>
                    </div>

                    <div class="space-y-3">
                        <label class="text-xs font-bold uppercase text-slate-500">Foto (Bisa Ditambah) *</label>
                        <div class="space-y-3">
                            <template x-for="(input, index) in imageInputs" :key="input.id">
                                <div class="flex items-center gap-3 rounded-xl border border-slate-200 bg-white p-3">
                                    <input type="file" name="images[]" accept="image/jpeg,image/png,image/webp" required 
                                           @change="handleFileChange($event, index)"
                                           class="block w-full text-xs text-slate-600 file:mr-3 file:rounded-lg file:border-0 file:bg-orange-100 file:px-3 file:py-1.5 file:font-bold file:text-orange-700">
                                    <button type="button" @click="removeInput(index)" class="rounded-lg p-1.5 text-rose-500 hover:bg-rose-50">
                                        <i data-lucide="trash-2" class="h-4 w-4"></i>
                                    </button>
                                </div>
                            </template>
                        </div>
                        <button type="button" @click="addInput()" class="mt-2 inline-flex items-center gap-1.5 text-xs font-bold text-orange-600 hover:text-orange-700">
                            <i data-lucide="plus" class="h-3.5 w-3.5"></i> Tambah Kolom Foto
                        </button>
                    </div>

                    <div class="pt-3 border-t border-orange-200/60 text-right">
                        <button type="submit" class="rounded-xl bg-gradient-to-r from-orange-500 to-orange-600 px-5 py-2.5 text-sm font-bold text-white shadow-md hover:from-orange-600 hover:to-orange-700">
                            Simpan ke Galeri
                        </button>
                    </div>
                </div>
            </form>

            <!-- Koleksi Terunggah (Hanya List Kiri) -->
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <h3 class="mb-4 text-base font-black text-slate-900 border-b border-slate-100 pb-3">Koleksi Terunggah ({{ $galleries->count() }})</h3>
                <div class="grid grid-cols-2 gap-3 sm:grid-cols-3">
                    @forelse($galleries as $gallery)
                        <div class="group relative overflow-hidden rounded-xl border border-slate-200">
                            <img src="{{ asset('storage/' . $gallery->image_path) }}" class="h-24 w-full object-cover">
                            <form action="{{ route('admin.gallery.destroy', $gallery->id) }}" method="POST" class="absolute right-1 top-1" onsubmit="return confirm('Hapus gambar ini?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="rounded bg-rose-500/90 p-1 text-white backdrop-blur hover:bg-rose-600">
                                    <i data-lucide="x" class="h-3 w-3"></i>
                                </button>
                            </form>
                        </div>
                    @empty
                        <p class="col-span-full text-center text-xs text-slate-400">Belum ada foto.</p>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- SISI KANAN: LIVE PREVIEW -->
        <x-live-preview>
            <div class="rounded-3xl bg-[#fffaf7] p-5 shadow-inner ring-1 ring-black/5">
                <!-- Judul Section Tiruan Landing Page -->
                <div class="text-center">
                    <p class="text-[10px] font-black uppercase tracking-widest text-orange-600">Koleksi Visual</p>
                    <h3 class="mt-1 text-xl font-black text-slate-900">Galeri Arjuna Trans</h3>
                    <div class="mx-auto mt-2 h-1 w-10 rounded-full bg-orange-600"></div>
                </div>

                <!-- Tombol Filter Tiruan -->
                <div class="mt-5 flex flex-wrap justify-center gap-2">
                    <span class="rounded-full bg-orange-600 px-4 py-1.5 text-[10px] font-bold text-white shadow-sm">Semua</span>
                    <span class="rounded-full bg-orange-100 px-4 py-1.5 text-[10px] font-bold text-orange-700">Armada</span>
                    <span class="rounded-full bg-orange-100 px-4 py-1.5 text-[10px] font-bold text-orange-700">Destinasi</span>
                </div>

                <!-- Grid Preview (Gabungan DB + Foto yang sedang dipilih) -->
                <div class="mt-6 grid grid-cols-2 gap-3">
                    
                    <!-- Merender gambar dari database yang sudah tersimpan -->
                    @foreach($galleries->take(6) as $gallery)
                        <div class="overflow-hidden rounded-xl shadow-sm border border-stone-100">
                            <img src="{{ asset('storage/' . $gallery->image_path) }}" class="h-28 w-full object-cover">
                        </div>
                    @endforeach

                    <!-- Merender preview file lokal yang barusan dipilih user via Alpine -->
                    <template x-for="input in imageInputs" :key="input.id">
                        <div x-show="input.preview" class="overflow-hidden rounded-xl border-2 border-dashed border-orange-400 shadow-sm relative">
                            <span class="absolute top-1 left-1 bg-orange-500 text-white text-[9px] font-bold px-1.5 py-0.5 rounded">NEW</span>
                            <img :src="input.preview" class="h-28 w-full object-cover opacity-80">
                        </div>
                    </template>

                </div>
            </div>
        </x-live-preview>
        
    </div>
</div>

@push('scripts')
<script>
function galleryPage() {
    return {
        imageInputs: [{ id: Date.now(), preview: null }],
        
        init() {
            this.$nextTick(() => window.lucide && lucide.createIcons());
        },
        addInput() {
            this.imageInputs.push({ id: Date.now(), preview: null });
            this.$nextTick(() => window.lucide && lucide.createIcons());
        },
        removeInput(index) {
            if (this.imageInputs.length > 1) {
                this.imageInputs.splice(index, 1);
            } else {
                this.imageInputs = [{ id: Date.now(), preview: null }];
            }
            this.$nextTick(() => window.lucide && lucide.createIcons());
        },
        handleFileChange(event, index) {
            const file = event.target.files[0];
            if (!file) {
                this.imageInputs[index].preview = null;
                return;
            }
            if (!['image/jpeg', 'image/png', 'image/webp'].includes(file.type) || file.size > 2 * 1024 * 1024) {
                alert('File harus gambar (JPG/PNG/WEBP) maksimal 2MB.');
                event.target.value = '';
                this.imageInputs[index].preview = null;
                return;
            }
            this.imageInputs[index].preview = URL.createObjectURL(file);
        }
    }
}
</script>
@endpush
@endsection