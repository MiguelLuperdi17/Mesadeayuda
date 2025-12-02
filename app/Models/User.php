<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public static function getLista(){
        return static::select('*')
            // ->where('rol_id',1)
            ->orderBy('id','desc')
            ->get();
    }

    public static function getListaProveedor(){
        return static::select('*')
             ->where('rol_id',6)
            ->orderBy('id','desc')
            ->get();
    }

    public static function getAnalistas(){
        return static::select('*')
            ->wherein('rol_id',[1,3])
            ->orderBy('id','desc')
            ->get();
    }

    public static function getAutorizadores(){
        return static::select('*')
            ->wherein('rol_id',[4,5])
            ->orderBy('id','desc')
            ->get();
    }

    public function permisos()
    {
        return $this->belongsToMany(Permiso::class, 'rol_permiso', 'rol_id', 'per_id');
    }
}
