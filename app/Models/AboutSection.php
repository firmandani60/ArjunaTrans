<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AboutSection extends Model
{
    protected $fillable = [
        'eyebrow', 
        'title', 
        'description', 
        'vision', 
        'mission'
    ];

    public function galleryImages(): HasMany
    {
        return $this->hasMany(
            AboutGalleryImage::class
        )->orderBy(
            'sort_order'
        );
    }
}
