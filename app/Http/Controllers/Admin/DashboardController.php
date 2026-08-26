<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Fleet;
use App\Models\RentalRoute;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('admin.dashboard', [
            'totalArmada' => Fleet::count(),
            'totalDestinasi' => Destination::count(),
            'totalPemesanan' => RentalRoute::count(),
            'totalPendapatan' => 'Konten DB aktif',
        ]);
    }
}
