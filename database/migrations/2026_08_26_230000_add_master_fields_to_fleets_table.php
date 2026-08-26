<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('fleets', 'unit_count')) {
            Schema::table('fleets', function (Blueprint $table) {
                $table->unsignedInteger('unit_count')->default(1)->after('facilities');
            });
        }

        if (! Schema::hasColumn('fleets', 'daily_price')) {
            Schema::table('fleets', function (Blueprint $table) {
                $table->unsignedBigInteger('daily_price')->nullable()->after('unit_count');
            });
        }
    }

    public function down(): void
    {
        $columns = [];
        if (Schema::hasColumn('fleets', 'unit_count')) {
            $columns[] = 'unit_count';
        }
        if (Schema::hasColumn('fleets', 'daily_price')) {
            $columns[] = 'daily_price';
        }

        if ($columns !== []) {
            Schema::table('fleets', function (Blueprint $table) use ($columns) {
                $table->dropColumn($columns);
            });
        }
    }
};
