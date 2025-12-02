<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Linea extends Model
{
    protected $connection = 'mysql';
    protected $table = "lineas";
    public $timestamps = false;
    protected $fillable = ['id', 'numero', 'chip', 'plan', 'costo_actual', 'fecha_compra'];
    public static function getLista()
    {
        return static::select('*')
            ->orderBy('id', 'desc')
            ->get();
    }
}
