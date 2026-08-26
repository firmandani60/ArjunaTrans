<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'icon', 
        'title', 
        'description', 
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
