<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destinasi extends Model
{
    use HasFactory;

    protected $table = 'destinasi';
    protected $primaryKey = 'id_destinasi';
    public $timestamps = false;

    protected $fillable = [
        'nama_destinasi',
        'rute_id',
        'harga',
        'armada_id',
    ];

    public function rute()
    {
        return $this->belongsTo(Rute::class, 'rute_id', 'id_rute');
    }

    public function armada()
    {
        return $this->belongsTo(Armada::class, 'armada_id', 'id_armada');
    }
}
