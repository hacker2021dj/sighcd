<?php

namespace App\Http\Controllers\seguridad\subModulos;

use App\Http\Controllers\Controller;
use App\Http\Requests\seguridad\validacionSubMenus;
use App\Models\seguridad\subMenus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class subModulosController extends Controller
{
    private $modulo = 'submodulos';
    public function index(Request $request)
    {
        modulo($this->modulo);
        if ($request->ajax()) {
            $idmenu = $request->id_menu;
            return DataTables::of(subMenus::whereIdMenus($idmenu))
                ->addIndexColumn()
                ->addColumn('action', function($row)  {
                    $modulo = $this->modulo;
                    $id = Crypt::encrypt($row->id);
                    $btn = '<div class="centro">';
                    $btn .= (string)view("includes.btn_accion",compact('id','modulo'));
                    return $btn.= '</div';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('seguridad.submodulos.index');
    }

    public function create(Request $request)
    {
        $idmenu = $request->id_menu;
        $vorden = subMenus::whereIdMenus($idmenu)->max('indice');
        return view('seguridad.submodulos.form_sub_modulos', compact('vorden'));
    }

    public function store(validacionSubMenus $request)
    {
        if ($request->ajax()) {
            try {
                DB::beginTransaction();
                    $request->request->add(['id_personal' => Auth::id()]);
                    subMenus::create($request->all());
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
            $smenu = subMenus::findOrFail($id);
            return view('seguridad.submodulos.form_sub_modulos', compact('smenu'));
        } else {
            abort(404);
        }
    }

    public function update(validacionSubMenus $request,)
    {
        if ($request->ajax()) {
            try {
                $id = Crypt::decrypt($request->id);
                DB::beginTransaction();
                    subMenus::findOrFail($id)->update($request->all());
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
                DB::beginTransaction();
                    subMenus::destroy($id);
                DB::commit();
                $rpta = $this->getResponse('D', $this->modulo);
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
