<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $connection = 'mysql';
    protected $table = "proyectos";
    public $timestamps = false;
    protected $fillable = ['id', 'titulo', 'id_categoria', 'id_responsable', 'descripcion', 'fecha_creacion'];
    public static function getLista()
    {
        return static::select('*')
            ->orderBy('id', 'desc')
            ->get();
    }
    public static function getCantidad()
    {
        $currentYear = Carbon::now()->year;
        return static::select('id')
        ->whereYear('fecha_creacion', $currentYear)
        ->count();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_responsable');
    }

    public function hitos()
    {
        return $this->hasMany(Hito::class, 'proyecto_id', 'id');
    }
    public function adjuntos()
    {
        return $this->hasMany(AdjuntoHito::class, 'proyecto_id');
    }

    public function responsable()
    {
        return $this->belongsTo(User::class, 'id_responsable');
    }
    public function ext()
    {
        return $this->hasMany(HistorialHito::class, 'proyecto_id');
    }
}
