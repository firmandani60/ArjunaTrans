<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Fleet;
use App\Models\RentalRoute;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $hasUnitCount = Schema::hasColumn('fleets', 'unit_count');
        $fleets = Fleet::orderBy('category')->orderBy('name')->get();

        $totalArmada = $hasUnitCount
            ? (int) $fleets->sum(fn (Fleet $fleet) => (int) ($fleet->unit_count ?? 0))
            : $fleets->count();

        $fleetGroups = $fleets
            ->groupBy(fn (Fleet $fleet) => trim((string) $fleet->category) ?: 'Lainnya')
            ->map(fn ($items) => $hasUnitCount
                ? (int) $items->sum(fn (Fleet $fleet) => (int) ($fleet->unit_count ?? 0))
                : $items->count())
            ->sortDesc();

        $totalDestinasi = Destination::count();
        $totalRute = RentalRoute::count();

        // Status dashboard difokuskan pada tiga kelompok Data Master.
        $activeContent = Fleet::where('is_active', true)->count()
            + Destination::where('is_active', true)->count()
            + RentalRoute::where('is_active', true)->count();

        $draftContent = Fleet::where('is_active', false)->count()
            + Destination::where('is_active', false)->count()
            + RentalRoute::where('is_active', false)->count();

        return view('admin.dashboard', [
            'totalArmada' => $totalArmada,
            'totalJenisArmada' => $fleets->count(),
            'totalDestinasi' => $totalDestinasi,
            'totalRute' => $totalRute,
            'activeContent' => $activeContent,
            'draftContent' => $draftContent,
            'fleetCategoryLabels' => $fleetGroups->keys()->values(),
            'fleetCategoryValues' => $fleetGroups->values(),
            'latestRoutes' => RentalRoute::with(['fleet', 'destination'])->latest('updated_at')->take(5)->get(),
            'latestDestinations' => Destination::latest('updated_at')->take(5)->get(),
        ]);
    }
}
