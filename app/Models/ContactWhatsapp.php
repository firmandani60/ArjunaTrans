<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ContactSetting;

class ContactWhatsapp extends Model
{
    protected $fillable = [
        'contact_setting_id',
        'phone_number',
        'sort_order',
    ];

    public function contactSetting()
    {
        return $this->belongsTo(ContactSetting::class);
    }
}