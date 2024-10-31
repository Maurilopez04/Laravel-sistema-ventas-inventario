<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VentasDetalle extends Model
{
    use SoftDeletes;
    protected $table = 'ventas_detalles';

    protected $fillable = ['venta_id', 'producto_id', 'cantidad', 'precio'];

    public function venta()
    {
        return $this->belongsTo(Venta::class, 'venta_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}
