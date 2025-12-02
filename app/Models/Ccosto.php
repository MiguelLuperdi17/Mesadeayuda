<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ccosto extends Model
{
    protected $connection = 'mysql';
    protected $table = "ccostos";
    public $timestamps = false;
    protected $fillable = ['id', 'linea_id', 'voz', 'voz_adicional', 'serv_adicionales', 'distancia_nacional',
        'distancia_internacional', 'roaming', 'seguro', 'total', 'mes','estado', 'registro'];

    public static function getLista()
    {
        return static::select('*')
            ->orderBy('id', 'desc')
            ->get();
    }
    public static function getListaPendiente($periodo)
    {
        return static::select('*')
            ->where('mes',$periodo)
            ->where('estado',2)
            ->orderBy('id', 'desc')
            ->get();
    }
    public function linea()
    {
        return $this->belongsTo(Linea::class, 'linea_id');
    }
}
