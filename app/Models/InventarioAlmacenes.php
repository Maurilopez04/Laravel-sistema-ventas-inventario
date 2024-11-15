<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventarioAlmacenes extends Model
{
    use HasFactory;

    protected $table = 'inventario_almacenes';
    public $timestamps = false;
    public $incrementing = false; // No incrementable ya que no hay 'id'

    protected $fillable = ['almacen_id', 'producto_id', 'cantidad'];

    public function almacen()
    {
        return $this->belongsTo(Almacen::class, 'almacen_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }

    /**
     * Método para encontrar el inventario usando una clave compuesta.
     */
    public static function findCompositeKey($almacen_id, $producto_id)
    {
        return self::where('almacen_id', $almacen_id)
                   ->where('producto_id', $producto_id)
                   ->first();
    }

    /**
     * Método para eliminar un registro de inventario.
     */
    public static function deleteInventory($almacen_id, $producto_id)
    {
        $inventario = self::findCompositeKey($almacen_id, $producto_id);

        if ($inventario) {
            $inventario->delete();
        }
    }
}

