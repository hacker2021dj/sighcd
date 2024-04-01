<?php

namespace App\Models\seguridad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class menus extends Model
{
    use HasFactory;

    protected $remember_token = false;
    protected $table = 'listbargroup';
    protected $fillable = ['codigo','descripcion','indice','icono','id_personal'];
    protected $guarded = ['id'];
    protected $primaryKey = 'id';

    public function submenus(): HasMany {
        return $this->hasMany(submenus::class,'id_menus','id');
    }

    public static function getMenus($front = false) {
        if($front) {
            return menus::leftjoin('listbaritems','listbargroup.id','listbaritems.id_menus')
                ->join('rolesitems','listbaritems.id','rolesitems.listbaritem_id')
                ->select('listbargroup.icono','listbargroup.descripcion as dmenu','listbaritems.icono as iconoi','listbaritems.descripcion as dsubmenu','listbaritems.ruta','listbaritems.grupo')
                ->where('rolesitems.roles_id',session()->get('id_rol'))
                ->orderBy('listbargroup.indice')
                ->orderBy('listbaritems.indice')
                ->get()
                ->toArray();
        } else {
            return menus::leftjoin('listbaritems','listbargroup.id','listbaritems.id_menus')
                ->select('listbargroup.icono','listbargroup.descripcion as dmenu','listbaritems.icono as iconoi','listbaritems.descripcion as dsubmenu','listbaritems.ruta','listbaritems.grupo')
                ->orderBy('listbargroup.indice')
                ->orderBy('listbaritems.indice')
                ->get()
                ->toArray();
        }
    }


    // private function getDatosMenu($front) {
    //     if ($front) {
    //         return submenus::with('menu')->whereHas('roles', function($query) {
    //                     $query->where('roles_id',1)->orderBy('listbaritem_id');
    //                 })
    //                 ->orderBy('indice')
    //                 ->get()
    //                 ->toArray();
    //     } else {
    //         return menus::with('submenus')
    //                 ->get()
    //                 ->toArray();
    //     }
    // }



    // private function prueba($menu) {
    //     $titulo = null;
    //     dd($menu);
    //     if ($menu['descripcion'] != $titulo) {
    //         dump($titulo);
    //     }
    //     $titulo = $menu['descripcion'];
    // }

    // private function invertir($datos) {
    //     $menus = [];
    //     $smenus = [];
    //     $tmenu = null;
    //     foreach ($datos as $v) {
    //         if ($tmenu != $v['menu']['descripcion']) {
    //             $menus[] = $v['menu'];
    //             dump($tmenu);
    //         }
    //         $tmenu = $v['menu']['descripcion'];
    //         unset($v['menu']);
    //         $smenus[] = $v;
    //     }

    // }

    // public static function getMenus($front = false) {
    //     $menus =  new menus();
    //     $padres = $menus->getPadre();
    //     dd($padres);
    //     // $valores = $menus->getDatosMenu($front);
    //     // $menus->invertir($valores);

    //     // $hijos = $menus->getHijos($front);
    //     $menuAll = [];
    //     // foreach ($hijos as $line) {
    //     //     if ()
    //     //     $menus->prueba($line['menu']);
    //     //     // dump($line['menu']);
    //     // }

    //     // if ($front) {
    //     //     return submenus::with('menu')->whereHas('roles', function($query) {
    //     //         $query->where('roles_id',1);
    //     //     })
    //     //     ->get()
    //     //     ->toArray();
    //     //     // menus::whereHas('submenus.roles', function($query) {
    //     //     //             $query->where('roles_id', 1)->orderBy('listbaritem_id');
    //     //     //         })
    //     //     //         // >with('submenus')
    //     //     //         ->get()
    //     //     //         ->toArray();
    //     // } else {
    //     //     return menus::with('submenus')
    //     //             ->get()
    //     //             ->toArray();
    //     // }
    // }



}
