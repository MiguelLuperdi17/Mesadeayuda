<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $connection = 'mysql';
    protected $table = "categorias";
    public $timestamps = false;
    protected $fillable = ['id', 'nombre'];

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
