<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $connection = 'mysql';
    protected $table = "tickets";
    public $timestamps = false;
    protected $fillable = ['id', 'codigo', 'idcategoria', 'idservicio', 'idreq', 'detalle', 'archivo_1', 'archivo_2', 'archivo_3', 'fecha_creacion', 'user_id', 'asignado', 'fecha_asignacion'];

    public static function getLista()
    {
        return static::select('*')
//            ->wherein('estado',["P","F"])
            ->orderBy('id', 'desc')
            ->get();
    }

    public static function getListaUser($id)
    {
        return static::select('*')
            ->where('user_id',$id)
            ->orderBy('id', 'desc')
            ->get();
    }

    public static function getListaPendiente()
    {
        return static::select('*')
            ->wherein('estado', ["P"])
            ->orderBy('id', 'desc')
            ->get();
    }

    public static function getListaAsignados($user_id)
    {
        return static::select('*')
            ->where('estado', ["A"])
            ->where('asignado', $user_id)
            ->orderBy('id', 'desc')
            ->get();
    }

    public static function getListaSeguimiento()
    {
        return static::select('*')
            ->wherein('estado', ["A"])
            ->orderBy('codigo', 'desc')
            ->get();
    }
    public static function getListaPendientesReporte()
    {
        return static::select('*')
            ->wherein('estado', ['A','P'])
            ->orderBy('codigo', 'desc')
            ->get();
    }

    public static function getListaAprobar($user_id)
    {
        return static::select('*','tickets.estado as estado_t')
            ->join('aprobaciones', 'aprobaciones.ticket_id', 'tickets.id')
            ->where('aprobaciones.user_id', $user_id)
            ->whereNull('aprobaciones.fecha_aprobacion')
            ->orderBy('tickets.codigo', 'desc')
            ->get();
    }

    public static function getCantidad_crear()
    {
        return static::select('id')
        ->count();
    }

    public static function getCantidad()
    {
        $currentYear = Carbon::now()->year;
        return static::select('id')
        ->whereYear('fecha_creacion', $currentYear)
        ->count();
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class, 'ticket_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'asignado');
    }

    public function usercreador()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function adjuntos()
    {
        return $this->hasMany(Adjunto::class, 'ticket_id');
    }

    public function aprobadores()
    {
        return $this->hasMany(Aprobacion::class, 'ticket_id');
    }

    public function atencion()
    {
        return $this->belongsTo(Atencion::class, 'atencion_id');
    }
}
