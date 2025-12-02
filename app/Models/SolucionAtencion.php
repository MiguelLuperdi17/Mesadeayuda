<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolucionAtencion extends Model
{
    protected $connection = 'mysql';
    protected $table = "solucion_atencion";
    public $timestamps = false;
    protected $fillable = ['id', 'ticket_id', 'solucion_id','equipo_id'];

    public static function getLista()
    {
        return static::select('*')
            ->orderBy('id', 'desc')
            ->get();
    }
}
