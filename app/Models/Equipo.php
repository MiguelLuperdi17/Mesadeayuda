<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    protected $connection = 'mysql';
    protected $table = "equipos";
    public $timestamps = false;
    protected $fillable = ['id', 'nombre_equipo', 'serial', 'tipo', 'modelo', 'marca', 'usuario', 'fecha_creacion', 'fecha_actualizacion', 'fecha_registro', 'id_link'];
    public static function getLista()
    {
        return static::select('*')
            ->orderBy('id', 'desc')
            ->get();
    }

    public function hito()
    {
        return $this->belongsTo(Hito::class, 'hito_id');
    }

}
