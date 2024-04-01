<?php

namespace App\Http\Requests\seguridad;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;

class validacionMenus extends FormRequest
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
        $id = ($this->request->get('id')) ?  Crypt::decrypt($this->request->get('id')) : null;
        return [
            'codigo'        => 'required|max:15|unique:listbargroup,codigo,'.$id,
            'descripcion'   => 'required|max:100|unique:listbargroup,descripcion,'.$id,
            'indice'        => 'required|max:3|unique:listbargroup,indice,'.$id,
            'icono'         => 'nullable|max:50',
        ];
    }
}
