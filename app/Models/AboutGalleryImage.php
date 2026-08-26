<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AboutGalleryImage extends Model
{
    protected $fillable = [
        'about_section_id', 
        'image_path', 
        'alt_text', 
        'sort_order'
    ];

    public function aboutSection(): BelongsTo
    {
        return $this->belongsTo(AboutSection::class);
    }
}
