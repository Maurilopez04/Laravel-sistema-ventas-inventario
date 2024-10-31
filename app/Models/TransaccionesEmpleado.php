<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransaccionesEmpleado extends Model
{
    use SoftDeletes;

    protected $table = 'transacciones_empleados';

    protected $fillable = ['empleado_id', 'monto', 'tipo', 'descripcion'];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id')->withTrashed();
    }
}
