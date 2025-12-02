<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adjunto extends Model
{
    protected $connection = 'mysql';
    protected $table = "adjuntos";
    public $timestamps = false;
    protected $fillable = ['id', 'ticket_id', 'detalle'];

    public static function getLista()
    {
        return static::select('*')
            ->orderBy('id', 'desc')
            ->get();
    }

//    public function comentarios()
//    {
//        return $this->hasMany(Cotizaciones::class, 'ticket_id');
//    }
}
