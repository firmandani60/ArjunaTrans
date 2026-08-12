<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Armada extends Model
{
    use HasFactory;

    protected $table = 'armada';
    protected $primaryKey = 'id_armada';
    public $timestamps = false;

    protected $fillable = [
        'nama_armada',
        'jenis_armada',
        'vasilitas',
        'kapasitas',
        'jumlah',
        'status',
    ];

    public function destinasi()
    {
        return $this->hasMany(Destinasi::class, 'armada_id', 'id_armada');
    }
}
