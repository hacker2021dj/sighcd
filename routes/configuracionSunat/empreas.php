<?php

use App\Http\Controllers\configuracionSunat\empresasController;
use Illuminate\Support\Facades\Route;

Route::prefix('configuracion_sunat')->controller(empresasController::class)->group(function() {
    $modulo = 'empresas';
    Route::get('lista-'.$modulo, 'index')->name('lista-'.$modulo);
    // Route::get('lista',)
});
