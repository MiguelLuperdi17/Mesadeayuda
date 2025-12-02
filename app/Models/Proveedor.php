<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $connection = 'mysql';
    protected $table = "proveedores";
    public $timestamps = false;
    protected $fillable = ['id', 'razon_social', 'correo', 'contacto', 'telefono', 'tipo'];

    public static function getLista()
    {
        return static::select('*')
            ->orderBy('id', 'desc')
            ->get();
    }
    public function categoria()
    {
        return $this->belongsTo(ProveedorCategoria::class, 'id_proveedores');
    }
}
