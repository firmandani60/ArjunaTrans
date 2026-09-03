<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    protected $guarded = [];

    // Menandakan model ini bisa dimiliki oleh model lain
    public function imageable()
    {
        return $this->morphTo();
    }
}