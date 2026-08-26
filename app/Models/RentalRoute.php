<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class RentalRoute extends Model
{
    protected $fillable = [
        'destination_name', 
        'route_description', 
        'elf_long_price', 
        'medium_bus_price', 
        'category', 
        'image_path', 
        'sort_order', 
        'is_active'
    ];

    protected function casts(): array
    {
        return [
            'elf_long_price' => 'integer', 
            'medium_bus_price' => 'integer', 
            'sort_order' => 'integer', 
            'is_active' => 'boolean'
        ];
    }
}
