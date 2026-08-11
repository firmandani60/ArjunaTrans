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

Route::get('/admin/data-master', function () {
    return view('admin.data-master');
})->name('admin.data-master');

Route::get('/admin/hero', function () {
    return view('admin.hero');
})->name('admin.hero');

Route::get('/admin/keunggulan', function () {
    return view('admin.keunggulan');
})->name('admin.keunggulan');

Route::get('/admin/layanan', function () {
    return view('admin.layanan');
})->name('admin.layanan');

Route::get('/admin/tentang-kami', function () {
    return view('admin.tentang-kami');
})->name('admin.tentang-kami');

Route::get('/admin/armada', function () {
    return view('admin.armada');
})->name('admin.armada');

Route::get('/admin/destinasi', function () {
    return view('admin.destinasi');
})->name('admin.destinasi');

Route::get('/admin/rute-harga', function () {
    return view('admin.rute-harga');
})->name('admin.rute-harga');

Route::get('/admin/cara-pesan', function () {
    return view('admin.cara-pesan');
})->name('admin.cara-pesan');

Route::get('/admin/kontak', function () {
    return view('admin.kontak');
})->name('admin.kontak');