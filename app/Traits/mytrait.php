<?php

namespace App\Traits;

trait mytrait
{
    function getResponse($tipo, $modulo) {
        switch ($tipo) {
            case 'S': $message = 'El registro se grabó correctamente';
                    $modal = '#modal-'.$modulo;
                    $vvalida = 'Grabar';
                    break;
            case 'U': $message = 'El registro se actualizó correctamente';
                    $modal = '#modal-'.$modulo;
                    $vvalida = 'Actualizar';
                    break;
            case 'D': $message = 'El registro se eliminó correctamente';
                    $modal = '';
                    $vvalida = 'Eliminar';
                    break;
        }

        return [
            'status' => 200,
            'mensaje' => $message,
            'modal' => $modal,
            'ntabla' => '#tblista-'.$modulo,
            'validacion' => $vvalida,
        ];
    }
}
