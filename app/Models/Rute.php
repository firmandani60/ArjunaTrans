<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rute extends Model
{
    use HasFactory;

    protected $table = 'rute';
    protected $primaryKey = 'id_rute';
    public $timestamps = false;

    protected $fillable = [
        'jenis_rute',
    ];

    public function destinasi()
    {
        return $this->hasMany(Destinasi::class, 'rute_id', 'id_rute');
    }
}
