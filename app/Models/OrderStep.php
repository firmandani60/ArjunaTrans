<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class OrderStep extends Model
{
    protected $fillable = [
        'title', 
        'description', 
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
