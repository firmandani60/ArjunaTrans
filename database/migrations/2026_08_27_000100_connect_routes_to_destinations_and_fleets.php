<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rental_routes', function (Blueprint $table) {
            $table->foreignId('destination_id')->nullable()->after('id')->constrained('destinations')->nullOnDelete();
            $table->foreignId('fleet_id')->nullable()->after('destination_name')->constrained('fleets')->nullOnDelete();
            $table->string('fleet_name')->nullable()->after('fleet_id');
            $table->unsignedBigInteger('price')->nullable()->after('route_description');
        });

        // Isi harga baru dari data lama jika tersedia, supaya data lama tidak mendadak kosong.
        DB::table('rental_routes')->orderBy('id')->get()->each(function ($route) {
            $fallbackPrice = $route->elf_long_price ?? $route->medium_bus_price ?? null;
            DB::table('rental_routes')->where('id', $route->id)->update([
                'price' => $fallbackPrice,
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('rental_routes', function (Blueprint $table) {
            $table->dropForeign(['destination_id']);
            $table->dropForeign(['fleet_id']);
            $table->dropColumn(['destination_id', 'fleet_id', 'fleet_name', 'price']);
        });
    }
};
