<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $connection = 'mysql';
    protected $table = "comentarios";
    public $timestamps = false;
    protected $fillable = ['id', 'ticket_id', 'comentario', 'fecha', 'user_id'];

    public static function getLista()
    {
        return static::select('*')
            ->orderBy('id', 'desc')
            ->get();
    }

    public static function getListaTicket($ticket_id)
    {
        return static::select('comentarios.fecha', 'users.username', 'comentarios.comentario')
            ->join('users', 'comentarios.user_id', '=', 'users.id')
            ->where('comentarios.ticket_id', $ticket_id)
            ->orderBy('comentarios.id', 'asc')
            ->get();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }
}
