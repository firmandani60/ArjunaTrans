<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class HeroSection extends Model
{
    protected $fillable = [
        'badge', 
        'title', 
        'description', 
        'primary_button_label', 
        'primary_button_url',
        'secondary_button_label', 
        'secondary_button_url', 
        'image_path', 
        'image_alt',
    ];
}
