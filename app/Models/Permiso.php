<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    protected $connection = 'mysql';
    protected $table = "permiso";
    public $timestamps = false;
    protected $fillable = ["per_descripcion","per_estado"];

    public static function getLista(){
        return static::select('*')
        ->where('per_estado',1)
        ->orderBy('id','asc')
        ->get();
    }
    public static function ver_permisos_sin_asignar($permisos_asignados,$permiso_oculto_sin_asignar=''){
        return static::select('*')
        ->orderBy('per_descripcion','asc')
        ->whereNotIn('id', $permisos_asignados)
        //->whereNotIn('per_id', $permiso_oculto_sin_asignar)
        ->get();
    }    
}
