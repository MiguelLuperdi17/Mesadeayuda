<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Rol extends Model
{
    protected $connection = 'mysql';
    protected $table = "rol";
    public $timestamps = false;
    protected $fillable = ['rol_descripcion','rol_estado'];

    public static function getLista(){
    	return static::select('*')
    	 ->where('rol_estado',1)
    	->orderBy('id','asc')
    	->get();
    }
}
