<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Compra extends Model
{
    use SoftDeletes;

    protected $table = 'compras';

    protected $fillable = ['proveedor_id', 'total'];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id')->withTrashed();
    }

    public function detalles()
    {
        return $this->hasMany(ComprasDetalle::class, 'compra_id');
    }
}
