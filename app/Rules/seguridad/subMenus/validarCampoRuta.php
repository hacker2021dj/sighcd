<?php

namespace App\Rules\seguridad\subMenus;

use App\Models\seguridad\subMenus;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Crypt;

class validarCampoRuta implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value != 'develop') {
            $id = (request()->id) ? Crypt::decrypt(request()->id) : null;
            $submenu = subMenus::where($attribute, $value)->where('id', '<>',$id)->get();
            if (count($submenu) != 0)
                $fail($attribute, 'La ruta ya existe');
        }
    }
}
