<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('rental_routes', function (Blueprint $table) {
            $table->integer('price_35')->nullable()->after('route_description');
            $table->integer('price_41')->nullable()->after('price_35');
            // $table->dropColumn('price'); // Bisa didrop jika harga lama tidak dipakai lagi
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rental_routes', function (Blueprint $table) {
            //
        });
    }
};
