<?php

namespace App\Models;

use App\Models\Planificacion\Objetivos;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Materiales extends Model
{
    protected $connection = 'mysql';
    protected $table = "materiales";
    public $timestamps = false;

    protected $fillable = ['codigo', 'descripcion', 'marca', 'sub_familia', 'nro_parte'  , 'desc_larga' , 'familia' , 'um'   , 'grupo' , 'costo_unitario' , 'ubi_1' , 'ubi_2' , 'ubi_3' ,'estado'];
    public static function getLista(){
        return static::select('*')
            ->where('estado',1)
            ->orderBy('id','desc')
            ->get();
    }
}
