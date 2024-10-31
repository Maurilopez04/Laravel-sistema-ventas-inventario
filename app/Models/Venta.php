<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Venta extends Model
{
    use SoftDeletes;

    protected $table = 'ventas';

    protected $fillable = ['cliente_id', 'total'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id')->withTrashed();
    }
}