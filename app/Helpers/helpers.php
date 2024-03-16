<?php
if (!function_exists('includeRouteFiles')) {
    // Funcion para incluir directorio de rutas.
    function includeRouteFiles($folder)
    {
        try {
            $rdi = new recursiveDirectoryIterator($folder);
            $it = new recursiveIteratorIterator($rdi);

            while ($it->valid()) {
                if (!$it->isDot() && $it->isFile() && $it->isReadable() && $it->current()->getExtension() === 'php') {
                    require $it->key();
                }

                $it->next();
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}

    // if (!function_exists('getMenuActivo')) {
    //     function getMenuActivo($ruta,$gruupo) {
    //         if ((request()->url() == route($ruta) || $gruupo == request()->segment(1) ) && route($ruta) != route('developend')/*|| request()->segment(1)  */) {
    //             return 'active';
    //         } else {
    //             return '';
    //         }
    //     }
    // }

    // Funcion que permite hacer load de imagenes
//     function getB64Image($base64_image){
//         // Obtener el String base-64 de los datos
//         $image_service_str = substr($base64_image, strpos($base64_image, ",")+1);
//         // Decodificar ese string y devolver los datos de la imagen
//         $image = base64_decode($image_service_str);
//         // Retornamos el string decodificado
//         return $image;
//    }

//    function getB64Extension($base64_image, $full=null){
//         // Obtener mediante una expresión regular la extensión imagen y guardarla
//         // en la variable "img_extension"
//         preg_match("/^data:image\/(.*);base64/i",$base64_image, $img_extension);
//         // Dependiendo si se pide la extensión completa o no retornar el arreglo con
//         // los datos de la extensión en la posición 0 - 1
//         return ($full) ?  $img_extension[0] : $img_extension[1];
//     }

// }
