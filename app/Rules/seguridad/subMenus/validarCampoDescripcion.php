<?php

namespace App\Rules\seguridad\subMenus;

use App\Models\seguridad\subMenus;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Crypt;

class validarCampoDescripcion implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $id = (request()->id) ? Crypt::decrypt(request()->id) : null;
        $subdespc = subMenus::where($attribute, $value)->where('id', '<>',$id)->whereIdMenus(request()->id_menus)->get();
            if (count($subdespc) != 0)
                $fail($attribute, 'La descripción ya existe');
    }
}
