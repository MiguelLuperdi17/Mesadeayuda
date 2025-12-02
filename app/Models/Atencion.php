<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atencion extends Model
{
    protected $connection = 'mysql';
    protected $table = "atenciones";
    public $timestamps = false;
    protected $fillable = ['id', 'servicio_id', 'nombre', 'atencion', 'tipo'];

    public static function getLista()
    {
        return static::select('*')
            ->orderBy('id', 'desc')
            ->get();
    }
    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'servicio_id');
    }
}
