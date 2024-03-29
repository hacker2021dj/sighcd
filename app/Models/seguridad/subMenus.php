<?php

namespace App\Models\seguridad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subMenus extends Model
{
    use HasFactory;
    protected $remember_token = false;
    protected $table = 'submenus';
    protected $fillable = ['id_menus','codigo','descripcion','indice','ruta','grupo','icono','id_personal'];
    protected $guarded = ['id'];
    protected $primaryKey = 'id';
}
