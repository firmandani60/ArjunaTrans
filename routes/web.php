<?php

use App\Http\Controllers\Admin\AdminContentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DataMasterController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Landing Page
|--------------------------------------------------------------------------
*/
Route::get('/', LandingController::class)->name('home');

/*
|--------------------------------------------------------------------------
| Login Admin
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])
    ->name('login');

Route::post('/login', [LoginController::class, 'login'])
    ->name('login.post');

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
| Autentikasi memakai session sederhana dari LoginController.
*/
Route::middleware('admin.auth')->group(function () {
    Route::get('/dashboard', DashboardController::class)
        ->name('dashboard');

    Route::get('/admin/data-master', [DataMasterController::class, 'index'])
        ->name('admin.data-master');

    Route::post('/admin/data-master/armada', [DataMasterController::class, 'storeFleet'])
        ->name('admin.data-master.armada.store');
    Route::patch('/admin/data-master/armada/{fleet}', [DataMasterController::class, 'updateFleet'])
        ->name('admin.data-master.armada.update');
    Route::delete('/admin/data-master/armada/{fleet}', [DataMasterController::class, 'destroyFleet'])
        ->name('admin.data-master.armada.destroy');

    Route::post('/admin/data-master/destinasi', [DataMasterController::class, 'storeDestination'])
        ->name('admin.data-master.destinasi.store');
    Route::patch('/admin/data-master/destinasi/{destination}', [DataMasterController::class, 'updateDestination'])
        ->name('admin.data-master.destinasi.update');
    Route::delete('/admin/data-master/destinasi/{destination}', [DataMasterController::class, 'destroyDestination'])
        ->name('admin.data-master.destinasi.destroy');

    Route::post('/admin/data-master/rute', [DataMasterController::class, 'storeRoute'])
        ->name('admin.data-master.rute.store');
    Route::patch('/admin/data-master/rute/{rentalRoute}', [DataMasterController::class, 'updateRoute'])
        ->name('admin.data-master.rute.update');
    Route::delete('/admin/data-master/rute/{rentalRoute}', [DataMasterController::class, 'destroyRoute'])
        ->name('admin.data-master.rute.destroy');

    // Upload media digunakan oleh layout admin untuk gambar hero, layanan, armada, dll.
    Route::post('/admin/media', [MediaController::class, 'store'])
        ->name('admin.media.store');

    // Hero
    Route::get('/admin/hero', [AdminContentController::class, 'hero'])
        ->name('admin.hero');
    Route::post('/admin/hero', [AdminContentController::class, 'updateHero'])
        ->name('admin.hero.update');

    // Keunggulan
    Route::get('/admin/keunggulan', [AdminContentController::class, 'advantages'])
        ->name('admin.keunggulan');
    Route::post('/admin/keunggulan', [AdminContentController::class, 'updateAdvantages'])
        ->name('admin.keunggulan.update');

    // Layanan
    Route::get('/admin/layanan', [AdminContentController::class, 'services'])
        ->name('admin.layanan');
    Route::post('/admin/layanan', [AdminContentController::class, 'updateServices'])
        ->name('admin.layanan.update');

    // Tentang Kami
    Route::get('/admin/tentang-kami', [AdminContentController::class, 'about'])
        ->name('admin.tentang-kami');
    Route::post('/admin/tentang-kami', [AdminContentController::class, 'updateAbout'])
        ->name('admin.tentang-kami.update');

    // Armada
    Route::get('/admin/armada', fn () => redirect()->route('admin.data-master', ['tab' => 'armada']))
        ->name('admin.armada');
    Route::post('/admin/armada', [AdminContentController::class, 'updateFleets'])
        ->name('admin.armada.update');

    // Destinasi
    Route::get('/admin/destinasi', fn () => redirect()->route('admin.data-master', ['tab' => 'destinasi']))
        ->name('admin.destinasi');
    Route::post('/admin/destinasi', [AdminContentController::class, 'updateDestinations'])
        ->name('admin.destinasi.update');

    // Rute & Harga
    Route::get('/admin/rute-harga', fn () => redirect()->route('admin.data-master', ['tab' => 'rute']))
        ->name('admin.rute-harga');
    Route::post('/admin/rute-harga', [AdminContentController::class, 'updateRoutes'])
        ->name('admin.rute-harga.update');

    // Cara Pesan
    Route::get('/admin/cara-pesan', [AdminContentController::class, 'orderSteps'])
        ->name('admin.cara-pesan');
    Route::post('/admin/cara-pesan', [AdminContentController::class, 'updateOrderSteps'])
        ->name('admin.cara-pesan.update');

    // Kontak
    Route::get('/admin/kontak', [AdminContentController::class, 'contact'])
        ->name('admin.kontak');
    Route::post('/admin/kontak', [AdminContentController::class, 'updateContact'])
        ->name('admin.kontak.update');
});
