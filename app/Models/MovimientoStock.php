<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MovimientoStock extends Model
{
    use SoftDeletes;

    protected $table = 'movimiento_stocks';

    protected $fillable = ['producto_id', 'tipo', 'cantidad'];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}