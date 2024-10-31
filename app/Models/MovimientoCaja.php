<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MovimientoCaja extends Model
{
    use SoftDeletes;

    protected $table = 'movimiento_cajas';

    protected $fillable = [
        'caja_id', 'tipo', 'monto', 'descripcion', 'compra_id', 'venta_id', 'transaccion_empleado_id'
    ];

    public function caja()
    {
        return $this->belongsTo(Caja::class, 'caja_id');
    }

    public function compra()
    {
        return $this->belongsTo(Compra::class, 'compra_id');
    }

    public function venta()
    {
        return $this->belongsTo(Venta::class, 'venta_id');
    }

    public function transaccionEmpleado()
    {
        return $this->belongsTo(TransaccionesEmpleado::class, 'transaccion_empleado_id');
    }
}
