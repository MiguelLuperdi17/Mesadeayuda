<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComentarioHito extends Model
{
    protected $connection = 'mysql';
    protected $table = "comentarios_hitos";
    public $timestamps = false;
    protected $fillable = ['id','proyecto_id', 'comentario', 'fecha', 'user_id'];

    public static function getLista()
    {
        return static::select('*')
            ->orderBy('id', 'desc')
            ->get();
    }

    public static function getListaProyecto($proyecto_id)
    {
        return static::select('comentarios_hitos.fecha', 'users.username', 'comentarios_hitos.comentario')
            ->join('users', 'comentarios_hitos.user_id', '=', 'users.id')
            ->where('comentarios_hitos.proyecto_id', $proyecto_id)
            ->orderBy('comentarios_hitos.id', 'asc')
            ->get();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    //public function ticket()
    //{
    //    return $this->belongsTo(Ticket::class, 'ticket_id');
    //}
}