<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hito extends Model
{
    protected $connection = 'mysql';
    protected $table = "hitos";
    public $timestamps = false;
    protected $fillable = ['id', 'nombre', 'fecha_inicio', 'fecha_fin'];
    public static function getLista()
    {
        return static::select('*')
            ->orderBy('id', 'desc')
            ->get();
    }

    public static function getListaProyecto($id)
    {
        return static::select('*')
            ->where('proyecto_id',$id)
            ->orderBy('id', 'desc')
            ->get();
    }

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id');
    }

    public function comentarios()
    {
        return $this->hasMany(ComentarioHito::class, 'proyecto_id');
    }
}
