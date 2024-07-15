<?php

namespace App\Models\seguridad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class subMenus extends Model
{
    use HasFactory;
    protected $remember_token = false;
    protected $table = 'listbar_items';
    protected $fillable = ['id_menus','codigo','descripcion','indice','ruta','grupo','icono','id_personal','estado'];
    protected $guarded = ['id'];
    protected $primaryKey = 'id';

    public function menu(): BelongsTo
    {
        return $this->belongsTo(menus::class, 'id_menus','id');
    }

    public function roles(): BelongsToMany {
        return $this->belongsToMany(roles::class, 'roles_items','listbaritem_id','roles_id');
    }
}
