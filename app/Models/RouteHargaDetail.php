<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RouteHargaDetail extends Model
{
    use HasFactory;

    protected $table = 'route_harga_detail';
    protected $primaryKey = 'id_route';
    public $timestamps = false;

    protected $fillable = [
        'nama_route',
        'titik_drop_off',
        'harga',
        'pilih_destinasi',
    ];
}
