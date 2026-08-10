<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $data = [
        'totalArmada' => 24,
        'totalDestinasi' => 18,
        'totalPemesanan' => 342,
        'totalPendapatan' => 'Rp 89,6 jt',
    ];
    return view('admin.dashboard', $data);
})->name('dashboard');