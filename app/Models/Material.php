<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $connection = 'mysql';
    protected $table = "materiales";
    public $timestamps = false;
    protected $fillable = ['id', 'titulo', 'detalle', 'fecha_registro', 'tipo', 'archivo'];

    public static function getLista()
    {
        return static::select('*')
            ->orderBy('id', 'desc')
            ->get();
    }
}
