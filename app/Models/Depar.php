<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depar extends Model
{
    use HasFactory;

    protected $fillable = ['dpto'];

    public function poas()
    {
        return $this->hasMany(Poa::class, 'id_dpto');
    }
}
