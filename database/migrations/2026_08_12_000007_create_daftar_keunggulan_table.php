<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('daftar_keunggulan', function (Blueprint $table) {
            // Catatan: tabel asli di database tidak memiliki primary key.
            $table->string('ikon', 100);
            $table->string('judul', 250);
            $table->string('deskripsi', 250);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_keunggulan');
    }
};
