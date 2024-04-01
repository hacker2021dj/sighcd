<?php

namespace App\Models\seguridad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class roles extends Model
{
    use HasFactory;
    protected $remember_token = false;
    protected $table = 'roles';
    protected $fillable = ['nombre','guard_name'];
    protected $guarded = ['id'];
    protected $primaryKey = 'id';

    public function submenus (): BelongsToMany {
        return $this->belongsToMany(submenus::class, 'rolesitems','roles_id','listbaritem_id');
    }
}
