<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes;

    protected $table = 'clientes';

    protected $fillable = ['nombre', 'email', 'telefono', 'direccion', 'ci_ruc', 'fecha_cumple'];

    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }
}