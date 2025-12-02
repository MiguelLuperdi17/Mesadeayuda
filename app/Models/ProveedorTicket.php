<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProveedorTicket extends Model
{
    protected $connection = 'mysql';
    protected $table = "proveedor_tickets";
    public $timestamps = false;
    protected $fillable = ['id', 'correlativo', 'proveedor_id','descripcion', 'sla_id', 'estado', 'fecha_creacion', 'fecha_final'];

    public static function getLista()
    {
        return static::select('*')
            ->orderBy('id', 'desc')
            ->get();
    }
    public static function getListaProveedor($id)
    {
        return static::select('*')
            ->where('proveedor_id', $id)
            ->orderBy('id', 'desc')
            ->get();
    }
    public static function getListaPendientesReporte()
    {
        return static::select('*')
            ->where('estado', '!=',2)
            ->orderBy('correlativo', 'desc')
            ->get();
    }

    public static function getCreadosSemanal()
    {
        return static::select('*')
            ->where('fecha_creacion', '>=', Carbon::now()->subDays(7))
            ->orderBy('correlativo', 'desc')
            ->count();
    }

    public static function getCerradosSemanal()
    {
        return static::select('*')
            ->where('fecha_final', '>=', Carbon::now()->subDays(7))
            ->orderBy('correlativo', 'desc')
            ->count();
    }

    public static function getCantidadProveedor($proveedor_id)
    {
        $currentYear = Carbon::now()->year;
        return static::select('id')
        ->where('proveedor_id',$proveedor_id)
        ->whereYear('fecha_creacion', $currentYear)
        ->count();
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
        return $this->belongsTo(User::class, 'user_id');
    }
    public function adjuntos()
    {
        return $this->hasMany(ProveedorAdjunto::class, 'ticket_id');
    }
    public function proveedor()
    {
        return $this->belongsTo(User::class, 'proveedor_id');
    }
}
