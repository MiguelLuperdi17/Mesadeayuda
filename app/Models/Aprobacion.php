<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aprobacion extends Model
{
    protected $connection = 'mysql';
    protected $table = "aprobaciones";
    public $timestamps = false;
    protected $fillable = ['id', 'user_id', 'ticket_id', 'fecha_creacion', 'fecha_aprobacion'];

    public static function getLista()
    {
        return static::select('*')
            ->orderBy('id', 'desc')
            ->get();
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
