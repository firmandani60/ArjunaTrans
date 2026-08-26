@extends('layout.admin')
@section('title', 'Dashboard Admin')
@section('content')

<div class="space-y-6">
    <section class="flex flex-col gap-4 rounded-2xl border border-orange-100 bg-white p-5 shadow-sm sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="text-xs font-bold uppercase tracking-[0.18em] text-orange-500">Ringkasan Database</p>
            <h1 class="mt-1 text-2xl font-black text-slate-900">Dashboard Arjuna Trans</h1>
            <p class="mt-2 text-sm text-slate-500">Angka di bawah dibaca langsung dari data master dan database landing page.</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('admin.data-master') }}" class="rounded-xl bg-orange-500 px-4 py-2.5 text-sm font-bold text-white hover:bg-orange-600">Kelola Data Master</a>
            <a href="{{ route('home') }}" target="_blank" class="rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-bold text-slate-700 hover:border-orange-200 hover:text-orange-600">Lihat Landing Page</a>
        </div>
    </section>

    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
        <div class="rounded-2xl border border-orange-100 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div><p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Total Unit Armada</p><p class="mt-1 text-3xl font-black text-slate-900">{{ $totalArmada }}</p><p class="mt-1 text-xs text-slate-500">{{ $totalJenisArmada }} jenis armada tersimpan</p></div>
                <div class="grid h-12 w-12 place-items-center rounded-full bg-orange-100 text-orange-600"><i data-lucide="bus" class="h-6 w-6"></i></div>
            </div>
        </div>
        <div class="rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div><p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Total Destinasi</p><p class="mt-1 text-3xl font-black text-slate-900">{{ $totalDestinasi }}</p><p class="mt-1 text-xs text-slate-500">Terhubung ke landing page</p></div>
                <div class="grid h-12 w-12 place-items-center rounded-full bg-emerald-100 text-emerald-600"><i data-lucide="map-pinned" class="h-6 w-6"></i></div>
            </div>
        </div>
        <div class="rounded-2xl border border-sky-100 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div><p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Rute & Harga</p><p class="mt-1 text-3xl font-black text-slate-900">{{ $totalRute }}</p><p class="mt-1 text-xs text-slate-500">Data tarif yang dikelola</p></div>
                <div class="grid h-12 w-12 place-items-center rounded-full bg-sky-100 text-sky-600"><i data-lucide="route" class="h-6 w-6"></i></div>
            </div>
        </div>
    </div>

    <div class="grid gap-5 lg:grid-cols-[1.3fr_.7fr]">
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between"><div><h2 class="text-lg font-black text-slate-900">Komposisi Armada</h2><p class="mt-1 text-sm text-slate-500">Jumlah unit berdasarkan kategori data master.</p></div><span class="rounded-full bg-orange-50 px-3 py-1 text-xs font-bold text-orange-600">Live DB</span></div>
            <div class="mt-5 h-72"><canvas id="fleetCategoryChart"></canvas></div>
        </div>
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div><h2 class="text-lg font-black text-slate-900">Status Konten Landing</h2><p class="mt-1 text-sm text-slate-500">Aktif dan draft dari data master.</p></div>
            <div class="mx-auto mt-6 h-56 max-w-xs"><canvas id="contentStatusChart"></canvas></div>
            <div class="mt-5 grid grid-cols-2 gap-3 text-center text-sm"><div class="rounded-xl bg-emerald-50 p-3"><p class="text-2xl font-black text-emerald-700">{{ $activeContent }}</p><p class="text-xs font-bold text-emerald-600">Aktif</p></div><div class="rounded-xl bg-slate-100 p-3"><p class="text-2xl font-black text-slate-700">{{ $draftContent }}</p><p class="text-xs font-bold text-slate-500">Draft</p></div></div>
        </div>
    </div>

    <div class="grid gap-5 lg:grid-cols-2">
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between"><div><h2 class="text-lg font-black text-slate-900">Rute Terakhir Diperbarui</h2><p class="mt-1 text-sm text-slate-500">Mengikuti data master rute dan harga.</p></div><a href="{{ route('admin.data-master') }}" class="text-xs font-bold text-orange-600">Kelola →</a></div>
            <div class="mt-5 space-y-3">
                @forelse($latestRoutes as $route)
                    <div class="flex items-center justify-between gap-4 rounded-2xl border border-slate-100 bg-slate-50/70 p-4">
                        <div><p class="font-bold text-slate-900">{{ $route->destination_name }}</p><p class="mt-1 text-xs text-slate-500">{{ $route->route_description ?: 'Tanpa deskripsi rute' }}</p></div>
                        <div class="text-right"><p class="text-xs font-black text-orange-600">Rp {{ number_format($route->price ?? $route->elf_long_price ?? $route->medium_bus_price ?? 0, 0, ',', '.') }}</p><p class="text-[11px] text-slate-400">{{ $route->fleet?->name ?? $route->fleet_name ?? 'Armada' }}</p></div>
                    </div>
                @empty
                    <div class="rounded-2xl border border-dashed border-slate-200 p-8 text-center text-sm text-slate-400">Belum ada data rute.</div>
                @endforelse
            </div>
        </div>
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between"><div><h2 class="text-lg font-black text-slate-900">Destinasi Terakhir Diperbarui</h2><p class="mt-1 text-sm text-slate-500">Status aktif menentukan kemunculan di landing.</p></div><a href="{{ route('admin.data-master') }}" class="text-xs font-bold text-orange-600">Kelola →</a></div>
            <div class="mt-5 space-y-3">
                @forelse($latestDestinations as $destination)
                    <div class="flex items-center justify-between gap-4 rounded-2xl border border-slate-100 bg-slate-50/70 p-4">
                        <div><p class="font-bold text-slate-900">{{ $destination->name }}</p><p class="mt-1 text-xs text-slate-500">{{ $destination->route ?: 'Rute belum diisi' }}</p></div>
                        <span class="rounded-full px-2.5 py-1 text-xs font-bold {{ $destination->is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-200 text-slate-500' }}">{{ $destination->is_active ? 'Aktif' : 'Draft' }}</span>
                    </div>
                @empty
                    <div class="rounded-2xl border border-dashed border-slate-200 p-8 text-center text-sm text-slate-400">Belum ada data destinasi.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
window.arjunaDashboardData = {
    fleetLabels: @js($fleetCategoryLabels),
    fleetValues: @js($fleetCategoryValues),
    contentStatus: [{{ $activeContent }}, {{ $draftContent }}]
};
</script>
@vite('resources/js/dashboard-chart.js')
@endpush
@endsection
