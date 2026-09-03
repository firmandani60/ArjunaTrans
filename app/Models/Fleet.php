<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Fleet extends Model
{
    protected $fillable = [
        'name', 
        'category', 
        'description', 
        'capacity', 
        'facilities', 
        'unit_count',
        'daily_price',
        'image_path', 
        'sort_order', 
        'is_active'
    ];

    protected function casts(): array { 
        return [
            'unit_count' => 'integer',
            'daily_price' => 'integer',
            'sort_order' => 'integer', 
            'is_active' => 'boolean'
        ]; 
    }

    public function galleries()
    {
        return $this->morphMany(GalleryImage::class, 'imageable');
    }
}
