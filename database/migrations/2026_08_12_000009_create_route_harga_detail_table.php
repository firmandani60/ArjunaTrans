<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Catatan: nama tabel asli 'route & harga detail' diubah menjadi
     * 'route_harga_detail', dan kolom 'titik Drop-off' diubah menjadi
     * 'titik_drop_off' agar sesuai konvensi penamaan Laravel.
     */
    public function up(): void
    {
        Schema::create('route_harga_detail', function (Blueprint $table) {
            $table->increments('id_route');
            $table->string('nama_route', 250);
            $table->string('titik_drop_off', 250);
            $table->string('harga', 250);
            $table->string('pilih_destinasi', 250);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('route_harga_detail');
    }
};
