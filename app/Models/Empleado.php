<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empleado extends Model
{
    use SoftDeletes;

    protected $table = 'empleados';

    protected $fillable = [
        'cedula', 'nombre', 'sueldo', 'puesto', 'numero', 'correo', 'fecha_contratacion',
        'casado', 'hijos', 'ubicacion'
    ];

    public function transacciones()
    {
        return $this->hasMany(TransaccionesEmpleado::class, 'empleado_id');
    }
}