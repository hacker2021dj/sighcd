<?php

namespace App\Models\seguridad;

use App\Models\admin\roles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class usuario extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'usuarios';
    protected $fillable = ['name','usuario','email','password','remember_token'];
    protected $guarded = ['id'];
    protected $primaryKey = 'id';
    protected $hidden = ['password'];

    public function roles()
    {
        return $this->belongsToMany(roles::class, 'usuario_rol');
    }
}
