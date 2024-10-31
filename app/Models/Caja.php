<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Caja extends Model
{
    use SoftDeletes;

    protected $table = 'cajas';

    protected $fillable = ['nombre', 'saldo_inicial', 'saldo_actual'];
}
