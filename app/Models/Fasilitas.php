<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    use HasFactory;

    protected $table = 'fasilitas';
    public $timestamps = false;

    // Catatan: id_fasilitas ada di tabel tapi TIDAK didaftarkan sebagai
    // PRIMARY KEY di database asli. Dipakai di sini sebagai primary key
    // logis, tapi sebaiknya kamu tambahkan constraint PRIMARY KEY yang
    // sesungguhnya di database supaya integritas datanya terjamin.
    protected $primaryKey = 'id_fasilitas';
    public $incrementing = false;

    protected $fillable = [
        'nama_fasilitas',
        'id_fasilitas',
    ];
}
