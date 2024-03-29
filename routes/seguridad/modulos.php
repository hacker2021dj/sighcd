<?php

use App\Http\Controllers\seguridad\modulosController;
use Illuminate\Support\Facades\Route;

Route::prefix('seguridad/modulos')->controller(modulosController::class)->group(function() {
    $modulo = 'modulos';
    Route::get('lista-'.$modulo, 'index')->name('lista-'.$modulo);
    Route::post('crear-'.$modulo, 'create')->name('crear-'.$modulo);
    Route::post('grabar-'.$modulo, 'store')->name('grabar-'.$modulo);
    Route::post('editar-'.$modulo, 'edit')->name('editar-'.$modulo);
    Route::put('actualizar-'.$modulo, 'update')->name('actualizar-'.$modulo);
    Route::delete('eliminar-'.$modulo, 'destroy')->name('eliminar-'.$modulo);
});
