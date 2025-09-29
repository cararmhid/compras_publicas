<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    use HasFactory;

    protected $table = 'direccions'; // Especifica el nombre de la tabla

    protected $fillable = ['direcc', 'nro_sec', 'iniciales', 'responsable', 'id_user', 'cargo'];

    public function poas()
    {
        return $this->hasMany(Poa::class, 'id_direcc');
    }
}
