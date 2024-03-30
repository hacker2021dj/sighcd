<?php

namespace App\Http\Requests\seguridad;

use App\Rules\seguridad\subMenus\validarCampoDescripcion;
use App\Rules\seguridad\subMenus\validarCampoRuta as SubMenusValidarCampoRuta;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;

class validacionSubMenus extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id =  ($this->request->get('id')) ?  Crypt::decrypt($this->request->get('id')) : null;
        return [
            'id_menus'       => 'required|numeric',
            'codigo'        => 'required|max:15|unique:submenus,codigo,'.$id,
            'descripcion'   => [
                                    'required',
                                    'max:100',
                                    new validarCampoDescripcion,
                                ],
            //'required|max:100|unique:submenus,descripcion,'.$id,
            // 'indice'        => 'required|max:20|unique:submenus,indice,'.$id,
            'grupo'         =>  'nullable|max:100,|unique:submenus,grupo,'.$id,
            'ruta'          => [
                                    'required',
                                    'max:100',
                                    new SubMenusValidarCampoRuta,
                                ],
            'icono'         => 'nullable|max:50',
        ];
    }
}
