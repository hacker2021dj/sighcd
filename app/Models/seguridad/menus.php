<?php

namespace App\Models\seguridad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class menus extends Model
{
    use HasFactory;

    protected $remember_token = false;
    protected $table = 'menus';
    protected $fillable = ['codigo','descripcion','indice','icono','id_personal'];
    protected $guarded = ['id'];
    protected $primaryKey = 'id';
}
