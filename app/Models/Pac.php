<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pac extends Model
{
    use HasFactory;

    protected $fillable = ['año', 'partida', 'cpc', 'tip_comp', 'descripcion',
                            'cantidad', 'unidad', 'precio', 'pc', 'sc', 'tc', 'normalizado',
                        'catalogo', 'id_proceso','fondo', 'regimen', 'tipo_presupuesto',
                    'id_dpto', 'nro_reforma'];

    public function proceso()
    {
        return $this->belongsTo(Proceso::class, 'id_proceso');
    }

    public function depar()
    {
        return $this->belongsTo(Depar::class, 'id_dpto');
    }
}
