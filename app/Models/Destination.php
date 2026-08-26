<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $fillable = [
        'name', 
        'description', 
        'route', 
        'image_path', 
        'sort_order', 
        'is_active'
    ];

    protected function casts(): array { 
        return [
            'sort_order' => 'integer', 
            'is_active' => 'boolean'
        ]; 
    }
}
