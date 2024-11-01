<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use SoftDeletes;

    protected $table = 'productos';

    protected $fillable = [
        'codigo', 'codigo_de_barras', 'nombre', 'descripcion', 'imagen', 'costo',
        'precioMayorista', 'precioMinorista', 'precioConInstalacion', 'cantidad',
        'categoria_id', 'marca_id'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id')->withTrashed();
    }

    public function marca()
    {
        return $this->belongsTo(Marca::class, 'marca_id')->withTrashed();
    }

    public function stock()
    {
        return $this->hasMany(Stock::class, 'producto_id')->withTrashed();
    }

    public function inventarios()
{
    return $this->hasMany(InventarioAlmacenes::class, 'producto_id');
}

}