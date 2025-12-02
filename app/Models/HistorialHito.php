<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialHito extends Model
{
    protected $connection = 'mysql';
    protected $table = "historial_hitos";
    public $timestamps = false;
    protected $fillable = ['id', 'hito_id', 'fecha_inicio', 'fecha_fin', 'cambio', 'user_id', 'comentario','proyecto_id'];
    public static function getLista()
    {
        return static::select('*')
            ->orderBy('id', 'desc')
            ->get();
    }
    public static function getProyectos_id()
    {
        return static::select('proyecto_id')
            ->orderBy('id', 'desc')
            ->distinct('proyecto_id')
            ->get();
    }

    public function hito()
    {
        return $this->belongsTo(Hito::class, 'hito_id');
    }
}