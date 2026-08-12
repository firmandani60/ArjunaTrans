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
        Schema::create('armada', function (Blueprint $table) {
            $table->increments('id_armada');
            $table->string('nama_armada', 250);
            $table->string('jenis_armada', 250);
            $table->string('vasilitas', 250);
            $table->string('kapasitas', 250);
            $table->string('jumlah', 250);
            $table->string('status', 250);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('armada');
    }
};
