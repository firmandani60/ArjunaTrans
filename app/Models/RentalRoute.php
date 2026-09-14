<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RentalRoute extends Model
{
    protected $fillable = [
        'destination_id',
        'destination_name',
        'fleet_id',
        'fleet_name',
        'route_description',
        'price_35',
        'price_41',
        // Kolom lama dipertahankan agar migrasi dari data sebelumnya tetap aman.
        'elf_long_price',
        'medium_bus_price',
        'category',
        'image_path',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'destination_id' => 'integer',
            'fleet_id' => 'integer',
            'price' => 'integer',
            'elf_long_price' => 'integer',
            'medium_bus_price' => 'integer',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function fleet(): BelongsTo
    {
        return $this->belongsTo(Fleet::class);
    }

    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }
}
