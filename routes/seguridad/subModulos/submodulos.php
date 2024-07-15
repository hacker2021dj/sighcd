<?php

use App\Http\Controllers\seguridad\subModulos\subModulosController;
use Illuminate\Support\Facades\Route;

Route::prefix('seguridad/submodulos')->controller(subModulosController::class)->group(function() {
    $modulo = 'submodulos';
    Route::get('lista-'.$modulo, 'index')->name('lista-'.$modulo);
    Route::post('crear-'.$modulo, 'create')->name('crear-'.$modulo);
    Route::post('grabar-'.$modulo, 'store')->name('grabar-'.$modulo);
    Route::post('editar-'.$modulo, 'edit')->name('editar-'.$modulo);
    Route::put('actualizar-'.$modulo, 'update')->name('actualizar-'.$modulo);
    Route::delete('eliminar-'.$modulo, 'destroy')->name('eliminar-'.$modulo);
});
