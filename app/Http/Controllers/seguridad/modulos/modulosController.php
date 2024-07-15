<?php

namespace App\Http\Controllers\seguridad\modulos;

use App\Http\Controllers\Controller;
use App\Http\Requests\seguridad\validacionMenus;
use App\Models\seguridad\menus;
use App\Models\seguridad\subMenus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class modulosController extends Controller
{
    private $modulo = 'modulos';
    public function index(Request $request)
    {
        modulo($this->modulo);
        if ($request->ajax()) {
            return DataTables::of(menus::all())
                ->addIndexColumn()
                ->addColumn('action', function($row)  {
                    $modulo = $this->modulo;
                    $id = Crypt::encrypt($row->id);
                    $btn = '<div class="centro">';
                    $btn .= (string)view("includes.btn_accion", compact('id','modulo')); // vista que incluye btn editar y eliminar
                    // // $btn.= '<button class="btn btn-warning btn-xs boton_reporte-'.$modulo.'" value="'.$id.'">
                    // //             <i class="fas fa-file-pdf tooltipsC" title="Reporte '.$modulo.'"></i>
                    // //         </button>'; // los botones nesesarios segun el modulo
                    return $btn.= '</div';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('seguridad.modulos.index');
    }

    public function create()
    {
        $vorden = menus::max('indice');
        return view('seguridad.modulos.form_modulos', compact('vorden'));
    }

    public function store(validacionMenus $request)
    {
        if ($request->ajax()) {
            try {
                DB::beginTransaction();
                    $request->request->add(['id_personal' => Auth::id()]);
                    menus::create($request->all());
                DB::commit();
                $rpta = $this->getResponse('S', $this->modulo);
            } catch (\Exception $e) {
                DB::rollBack();
                $rpta = [
                    'status' => 500,
                    'mensaje' => $e->getMessage(),
                    'valida' => 'Grabar',
                ];
            }
            return response()->json($rpta);
        }
    }

    public function edit(Request $request)
    {
        if ($request->ajax()) {
            $id = Crypt::decrypt($request->id);
            $menu = menus::findOrFail($id);
            return view('seguridad.modulos.form_modulos', compact('menu'));
        }
    }

    public function update(validacionMenus $request)
    {
        if ($request->ajax()) {
            try {
                $id = Crypt::decrypt($request->id);
                DB::beginTransaction();
                    menus::findOrFail($id)->update($request->all());
                DB::commit();
                $rpta = $this->getResponse('U', $this->modulo);
            } catch (\Exception $e) {
                DB::rollBack();
                $rpta = [
                    'status' => 500,
                    'mensaje' => $e->getMessage(),
                    'valida' => 'Actualizar',
                ];
            }
            return response()->json($rpta);
        }
    }

    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            try {
                $id = Crypt::decrypt($request->id);
                $submenu = subMenus::whereIdMenus($id)->get();
                if (count($submenu) == 0) {
                    DB::beginTransaction();
                        menus::destroy($id);
                    DB::commit();
                    $rpta = $this->getResponse('D', $this->modulo);
                } else {
                    $rpta = [
                        'status' => 500,
                        'mensaje' => 'no se puede eliminar, el módulo tiene ya tiene sub módulos',
                        'valida' => 'Eliminar',
                    ];
                }
            } catch (\Exception $e) {
                DB::rollBack();
                $rpta = [
                    'status' => 500,
                    'mensaje' => $e->getMessage(),
                    'valida' => 'Eliminar',
                ];
            }
            return response()->json($rpta);
        }
    }
}
