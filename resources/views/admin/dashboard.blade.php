@extends('layout.admin')
@section('title', 'Dashboard Admin')
@section('content')

<div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
    <div class="rounded-2xl border border-sky-100 bg-white p-5 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Total Armada</p>
                <p class="mt-1 text-3xl font-bold text-slate-900">{{ $totalArmada ?? 24 }}</p>
                <p class="mt-1 text-xs text-slate-500">+2 dari bulan lalu</p>
            </div>
            <div class="grid h-12 w-12 place-items-center rounded-full bg-sky-100 text-sky-600">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                </svg>
            </div>
        </div>
    </div>

    <div class="rounded-2xl border border-sky-100 bg-white p-5 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Total Destinasi</p>
                <p class="mt-1 text-3xl font-bold text-slate-900">{{ $totalDestinasi ?? 18 }}</p>
                <p class="mt-1 text-xs text-slate-500">3 destinasi baru</p>
            </div>
            <div class="grid h-12 w-12 place-items-center rounded-full bg-emerald-100 text-emerald-600">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
        </div>
    </div>

    <div class="rounded-2xl border border-sky-100 bg-white p-5 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Total Pemesanan</p>
                <p class="mt-1 text-3xl font-bold text-slate-900">{{ $totalPemesanan ?? 342 }}</p>
                <p class="mt-1 text-xs text-slate-500">+12% dari bulan lalu</p>
            </div>
            <div class="grid h-12 w-12 place-items-center rounded-full bg-amber-100 text-amber-600">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                </svg>
            </div>
        </div>
    </div>

    <div class="rounded-2xl border border-sky-100 bg-white p-5 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Total Pendapatan</p>
                <p class="mt-1 text-3xl font-bold text-slate-900">{{ $totalPendapatan ?? 'Rp 89,6 jt' }}</p>
                <p class="mt-1 text-xs text-slate-500">+8% dari bulan lalu</p>
            </div>
            <div class="grid h-12 w-12 place-items-center rounded-full bg-purple-100 text-purple-600">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
    </div>
</div>

<div class="mt-6">
    <div class="overflow-hidden rounded-3xl border border-sky-100/90 bg-white/95 p-6 shadow-[0_20px_50px_rgba(15,52,94,0.09)] backdrop-blur">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-lg font-bold text-slate-950">Armada Disewa vs Tersedia</h2>
                <p class="mt-0.5 text-sm text-slate-500">Perkembangan per bulan dalam 6 bulan terakhir</p>
            </div>
            <span class="rounded-full bg-sky-50 px-3 py-1 text-xs font-bold text-sky-700 ring-1 ring-sky-100">6 Bulan</span>
        </div>
        <div class="mt-4">
            <canvas id="armadaLineChart" height="80"></canvas>
        </div>
    </div>
</div>

<div class="mt-6 grid grid-cols-1 gap-5 md:grid-cols-3">
    <div class="overflow-hidden rounded-3xl border border-sky-100/90 bg-white/95 p-6 shadow-[0_20px_50px_rgba(15,52,94,0.09)] backdrop-blur">
        <div class="flex items-center justify-between">
            <h3 class="text-base font-bold text-slate-950">Bus</h3>
            <span class="rounded-full bg-sky-50 px-3 py-1 text-xs font-bold text-sky-700 ring-1 ring-sky-100">12 unit</span>
        </div>
        <div class="mt-2 flex items-center justify-center">
            <canvas id="busDonutChart" height="160" width="160"></canvas>
        </div>
        <div class="mt-3 flex justify-center gap-4 text-xs">
            <span class="flex items-center gap-1"><span class="inline-block h-2 w-2 rounded-full bg-emerald-500"></span> Tersewa (8)</span>
            <span class="flex items-center gap-1"><span class="inline-block h-2 w-2 rounded-full bg-slate-300"></span> Tersedia (4)</span>
        </div>
    </div>

    <div class="overflow-hidden rounded-3xl border border-sky-100/90 bg-white/95 p-6 shadow-[0_20px_50px_rgba(15,52,94,0.09)] backdrop-blur">
        <div class="flex items-center justify-between">
            <h3 class="text-base font-bold text-slate-950">Elf</h3>
            <span class="rounded-full bg-sky-50 px-3 py-1 text-xs font-bold text-sky-700 ring-1 ring-sky-100">8 unit</span>
        </div>
        <div class="mt-2 flex items-center justify-center">
            <canvas id="elfDonutChart" height="160" width="160"></canvas>
        </div>
        <div class="mt-3 flex justify-center gap-4 text-xs">
            <span class="flex items-center gap-1"><span class="inline-block h-2 w-2 rounded-full bg-emerald-500"></span> Tersewa (5)</span>
            <span class="flex items-center gap-1"><span class="inline-block h-2 w-2 rounded-full bg-slate-300"></span> Tersedia (3)</span>
        </div>
    </div>

    <div class="overflow-hidden rounded-3xl border border-sky-100/90 bg-white/95 p-6 shadow-[0_20px_50px_rgba(15,52,94,0.09)] backdrop-blur">
        <div class="flex items-center justify-between">
            <h3 class="text-base font-bold text-slate-950">Hiace</h3>
            <span class="rounded-full bg-sky-50 px-3 py-1 text-xs font-bold text-sky-700 ring-1 ring-sky-100">6 unit</span>
        </div>
        <div class="mt-2 flex items-center justify-center">
            <canvas id="hiaceDonutChart" height="160" width="160"></canvas>
        </div>
        <div class="mt-3 flex justify-center gap-4 text-xs">
            <span class="flex items-center gap-1"><span class="inline-block h-2 w-2 rounded-full bg-emerald-500"></span> Tersewa (2)</span>
            <span class="flex items-center gap-1"><span class="inline-block h-2 w-2 rounded-full bg-slate-300"></span> Tersedia (4)</span>
        </div>
    </div>
</div>

<div class="mt-6 grid grid-cols-1 gap-5 lg:grid-cols-2">
    <div class="overflow-hidden rounded-3xl border border-sky-100/90 bg-white/95 p-6 shadow-[0_20px_50px_rgba(15,52,94,0.09)] backdrop-blur">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-lg font-bold text-slate-950">Destinasi Favorit</h2>
                <p class="mt-0.5 text-sm text-slate-500">Persentase pemesanan per kategori</p>
            </div>
            <span class="rounded-full bg-sky-50 px-3 py-1 text-xs font-bold text-sky-700 ring-1 ring-sky-100">Bulan Ini</span>
        </div>
        <div class="mt-4 flex items-center justify-center">
            <canvas id="destinasiDoughnutChart" height="180" width="180"></canvas>
        </div>
        <div class="mt-4 flex flex-wrap justify-center gap-4 text-xs">
            <span class="flex items-center gap-1"><span class="inline-block h-2 w-2 rounded-full bg-blue-500"></span> Pantai (70%)</span>
            <span class="flex items-center gap-1"><span class="inline-block h-2 w-2 rounded-full bg-amber-500"></span> Ziarah (20%)</span>
            <span class="flex items-center gap-1"><span class="inline-block h-2 w-2 rounded-full bg-emerald-500"></span> Taman (10%)</span>
        </div>
    </div>

    <div class="overflow-hidden rounded-3xl border border-sky-100/90 bg-white/95 p-6 shadow-[0_20px_50px_rgba(15,52,94,0.09)] backdrop-blur">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-lg font-bold text-slate-950">Rute Terbaik</h2>
                <p class="mt-0.5 text-sm text-slate-500">Rute dengan pemesanan terbanyak</p>
            </div>
            <span class="rounded-full bg-amber-50 px-3 py-1 text-xs font-bold text-amber-700 ring-1 ring-amber-100">Popular</span>
        </div>
        <div class="mt-4 space-y-4">
            <div class="flex items-center justify-between rounded-xl border border-slate-100 bg-slate-50/70 px-4 py-3">
                <div class="flex items-center gap-3">
                    <span class="grid h-9 w-9 place-items-center rounded-full bg-emerald-100 text-sm font-extrabold text-emerald-700">1</span>
                    <div>
                        <p class="text-sm font-bold text-slate-900">Pantai Selatan - City Tour</p>
                        <p class="text-xs text-slate-500">48 pemesanan</p>
                    </div>
                </div>
                <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-bold text-emerald-700">+24%</span>
            </div>
            <div class="flex items-center justify-between rounded-xl border border-slate-100 bg-slate-50/70 px-4 py-3">
                <div class="flex items-center gap-3">
                    <span class="grid h-9 w-9 place-items-center rounded-full bg-sky-100 text-sm font-extrabold text-sky-700">2</span>
                    <div>
                        <p class="text-sm font-bold text-slate-900">Ziarah Wali 9 - Heritage</p>
                        <p class="text-xs text-slate-500">32 pemesanan</p>
                    </div>
                </div>
                <span class="rounded-full bg-sky-50 px-3 py-1 text-xs font-bold text-sky-700">+12%</span>
            </div>
            <div class="flex items-center justify-between rounded-xl border border-slate-100 bg-slate-50/70 px-4 py-3">
                <div class="flex items-center gap-3">
                    <span class="grid h-9 w-9 place-items-center rounded-full bg-amber-100 text-sm font-extrabold text-amber-700">3</span>
                    <div>
                        <p class="text-sm font-bold text-slate-900">Taman Nasional - Edukasi</p>
                        <p class="text-xs text-slate-500">21 pemesanan</p>
                    </div>
                </div>
                <span class="rounded-full bg-amber-50 px-3 py-1 text-xs font-bold text-amber-700">+8%</span>
            </div>
            <div class="flex items-center justify-between rounded-xl border border-slate-100 bg-slate-50/70 px-4 py-3">
                <div class="flex items-center gap-3">
                    <span class="grid h-9 w-9 place-items-center rounded-full bg-purple-100 text-sm font-extrabold text-purple-700">4</span>
                    <div>
                        <p class="text-sm font-bold text-slate-900">Gunung Bromo - Sunrise</p>
                        <p class="text-xs text-slate-500">18 pemesanan</p>
                    </div>
                </div>
                <span class="rounded-full bg-purple-50 px-3 py-1 text-xs font-bold text-purple-700">+5%</span>
            </div>
            <div class="flex items-center justify-between rounded-xl border border-slate-100 bg-slate-50/70 px-4 py-3">
                <div class="flex items-center gap-3">
                    <span class="grid h-9 w-9 place-items-center rounded-full bg-rose-100 text-sm font-extrabold text-rose-700">5</span>
                    <div>
                        <p class="text-sm font-bold text-slate-900">Kota Tua - Sejarah</p>
                        <p class="text-xs text-slate-500">14 pemesanan</p>
                    </div>
                </div>
                <span class="rounded-full bg-rose-50 px-3 py-1 text-xs font-bold text-rose-700">+2%</span>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    @vite('resources/js/dashboard-chart.js')
@endpush