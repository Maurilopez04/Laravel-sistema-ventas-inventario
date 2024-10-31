<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComprasDetalle extends Model
{
    use SoftDeletes;
    protected $table = 'compras_detalles';

    protected $fillable = ['compra_id', 'producto_id', 'cantidad', 'precio'];

    public function compra()
    {
        return $this->belongsTo(Compra::class, 'compra_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}
