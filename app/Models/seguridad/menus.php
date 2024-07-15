<?php

namespace App\Models\seguridad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class menus extends Model
{
    use HasFactory;

    protected $remember_token = false;
    protected $table = 'listbar_group';
    protected $fillable = ['codigo','descripcion','indice','icono','id_personal','estado'];
    protected $guarded = ['id'];
    protected $primaryKey = 'id';

    public function submenus(): HasMany {
        return $this->hasMany(submenus::class,'id_menus','id');
    }

    public static function getMenus($front = false) {
        if($front) {
            return menus::leftjoin('listbar_items','listbar_group.id','listbar_items.id_menus')
                ->join('roles_items','listbar_items.id','roles_items.listbaritem_id')
                ->select('listbar_group.icono','listbar_group.descripcion as dmenu','listbar_items.icono as iconoi','listbar_items.descripcion as dsubmenu','listbar_items.ruta','listbar_items.grupo')
                ->where('roles_items.roles_id',session()->get('id_rol'))
                ->orderBy('listbar_group.indice')
                ->orderBy('listbar_items.indice')
                ->get()
                ->toArray();
        } else {
            return menus::leftjoin('listbar_items','listbar_group.id','listbar_items.id_menus')
                ->select('listbar_group.icono','listbar_group.descripcion as dmenu','listbar_items.icono as iconoi','listbar_items.descripcion as dsubmenu','listbar_items.ruta','listbar_items.grupo')
                ->orderBy('listbar_group.indice')
                ->orderBy('listbar_items.indice')
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
