<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ContactWhatsapp;

class ContactSetting extends Model
{
    protected $fillable = [
    'description',
    'address',
    'maps_link',
    'email',
    'instagram',
    'facebook',
    'youtube',
    'tiktok',
];

    public function whatsapps()
    {
        return $this->hasMany(ContactWhatsapp::class);
    }
}