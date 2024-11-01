<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventarioAlmacenes extends Model
{
    use HasFactory;

    protected $table = 'inventario_almacenes';
    public $incrementing = false;
    protected $fillable = ['almacen_id', 'producto_id', 'cantidad'];

    public function almacen()
    {
        return $this->belongsTo(Almacen::class, 'almacen_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}

