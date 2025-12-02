<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solucion extends Model
{
    protected $connection = 'mysql';
    protected $table = "soluciones";
    public $timestamps = false;
    protected $fillable = ['id', 'titulo', 'descripcion','atencion_id', 'fecha_creacion', 'fecha_actualizacion','estado'];

    public static function getLista()
    {
        return static::select('*')
            ->orderBy('id', 'desc')
            ->get();
    }
}
