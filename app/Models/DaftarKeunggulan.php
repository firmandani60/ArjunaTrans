<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarKeunggulan extends Model
{
    use HasFactory;

    protected $table = 'daftar_keunggulan';
    public $timestamps = false;

    // PERHATIAN: tabel ini tidak punya primary key di database.
    // Ini menonaktifkan auto-increment key milik Eloquent, tapi
    // update()/delete() pada model ini TIDAK akan berfungsi andal
    // sampai kolom id ditambahkan ke tabel.
    protected $primaryKey = null;
    public $incrementing = false;

    protected $fillable = [
        'ikon',
        'judul',
        'deskripsi',
    ];
}
