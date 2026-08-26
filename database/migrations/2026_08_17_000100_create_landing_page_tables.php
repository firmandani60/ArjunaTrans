<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hero_sections', function (Blueprint $table) {
            $table->id();
            $table->string('badge')->nullable();
            $table->string('title', 160);
            $table->text('description')->nullable();
            $table->string('primary_button_label')->nullable();
            $table->string('primary_button_url')->nullable();
            $table->string('secondary_button_label')->nullable();
            $table->string('secondary_button_url')->nullable();
            $table->text('image_path')->nullable();
            $table->string('image_alt')->nullable();
            $table->timestamps();
        });

        Schema::create('advantages', function (Blueprint $table) {
            $table->id();
            $table->string('icon')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('icon')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('image_path')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('about_sections', function (Blueprint $table) {
            $table->id();
            $table->string('eyebrow')->default('Tentang Kami');
            $table->string('title')->default('Mendefinisikan Ulang Perjalanan Wisata Anda');
            $table->text('description')->nullable();
            $table->text('vision')->nullable();
            $table->text('mission')->nullable();
            $table->timestamps();
        });

        Schema::create('about_gallery_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('about_section_id')->constrained()->cascadeOnDelete();
            $table->text('image_path');
            $table->string('alt_text')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('fleets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category')->nullable();
            $table->text('description')->nullable();
            $table->string('capacity')->nullable();
            $table->string('facilities')->nullable();
            $table->text('image_path')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('route')->nullable();
            $table->text('image_path')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('rental_routes', function (Blueprint $table) {
            $table->id();
            $table->string('destination_name');
            $table->string('route_description')->nullable();
            $table->unsignedBigInteger('elf_long_price')->nullable();
            $table->unsignedBigInteger('medium_bus_price')->nullable();
            $table->string('category')->nullable();
            $table->text('image_path')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('order_steps', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('contact_settings', function (Blueprint $table) {
            $table->id();
            $table->text('description')->nullable();
            $table->text('address')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('email')->nullable();
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('youtube')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_settings');
        Schema::dropIfExists('order_steps');
        Schema::dropIfExists('rental_routes');
        Schema::dropIfExists('destinations');
        Schema::dropIfExists('fleets');
        Schema::dropIfExists('about_gallery_images');
        Schema::dropIfExists('about_sections');
        Schema::dropIfExists('services');
        Schema::dropIfExists('advantages');
        Schema::dropIfExists('hero_sections');
    }
};
