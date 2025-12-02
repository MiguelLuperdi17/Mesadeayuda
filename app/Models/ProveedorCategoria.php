<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProveedorCategoria extends Model
{
    protected $connection = 'mysql';
    protected $table = "proveedor_categoria";
    public $timestamps = false;
    protected $fillable = ['id', 'id_proveedores', 'categoria', 'sla'];

    public static function getLista()
    {
        return static::select('*')
            ->orderBy('id', 'desc')
            ->get();
    }
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }
}
