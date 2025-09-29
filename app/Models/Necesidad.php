<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Necesidad extends Model
{
    use HasFactory;

    protected $fillable = ['nro_nec', 'nro_nec1', 'inic_direcc', 'sec_direcc', 'responsable', 'direccion', 
    'dpto', 'fecha_nec', 'cargo', 'cuatrimestre', 'normalizado', 'id_user', 'precio_pac',
    'tip_proc', 'justific', 'tip_comp', 'cpc', 'descripcion', 'unidad', 'cantidad', 'dir_area', 'dir_adm',
     'Gerente', 'tipo_flujo', 'status', 'cod_user', 'precio_eje', 'nro_cert_poa', 'id_poa'];

     public $nro_necn=0;

    public function Poa()
    {
        return $this->belongsTo(Poa::class, 'id_poa');
    }

}
