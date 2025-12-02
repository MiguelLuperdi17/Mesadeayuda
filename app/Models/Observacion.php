<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Observacion extends Model
{
    protected $connection = 'mysql';
    protected $table = "observaciones";
    public $timestamps = false;
    protected $fillable = ['id', 'mes', 'tipo', 'detalle', 'registro'];

    public static function getLista()
    {
        return static::select('*')
            ->orderBy('id', 'desc')
            ->get();
    }
}
