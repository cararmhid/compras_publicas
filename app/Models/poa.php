<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poa extends Model
{
    use HasFactory;

    protected $fillable = ['meta', 'nro_sec','id_direcc', 'id_dpto', 'fecha_ini', 'fecha_fin', 'valor'];

    public function direccion()
    {
        return $this->belongsTo(Direccion::class, 'id_direcc');
    }

    public function depar()
    {
        return $this->belongsTo(Depar::class, 'id_dpto');
    }
}
