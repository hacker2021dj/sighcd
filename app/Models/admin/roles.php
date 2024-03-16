<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class roles extends Model
{
    use HasFactory;
    protected $table = 'roles';
    protected $fillable = ['nombre'];
    protected $guarded = ['id'];
    protected $primaryKey = 'id';
}
