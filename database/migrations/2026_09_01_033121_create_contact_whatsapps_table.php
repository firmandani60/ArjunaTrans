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
       Schema::create('contact_whatsapps', function (Blueprint $table) {
    $table->id();

    $table->foreignId('contact_setting_id')
        ->constrained('contact_settings')
        ->cascadeOnDelete();

    $table->string('phone_number', 50);

    $table->unsignedInteger('sort_order')->default(0);

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_whatsapps');
    }
};
