<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'ubicacion'];

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    public function inventarios()
{
    return $this->hasMany(InventarioAlmacenes::class, 'almacen_id');
}

}
