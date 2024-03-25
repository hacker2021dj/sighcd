<?php

use App\Http\Controllers\dashboard\dashboardController;
use App\Http\Controllers\facturacion\facturacionController;
use App\Http\Controllers\seguridad\loginController;
use Illuminate\Support\Facades\Route;

// RUTA QUE SE USA PARA PARA LAS OPCIONES DE LOGIN Y LOGOUT
Route::prefix('/')->controller(loginController::class)->group(function() {
    Route::get('', 'index');
    Route::post('', 'login')->name('login');
    Route::get('cerrar', 'logout')->name('logout');
});

// RUTAS QUE PERMIEACCEDER A LAS FUNCIONES DEL SISTEMA UNA VEZ LOGEADO
Route::prefix('admin')->middleware('auth')->controller(dashboardController::class)->group(function() {
    Route::get('', 'index')->name('menu');
    Route::get('mantenimiento','desarrollo')->name('develop');
});

Route::post('facturacion', [facturacionController::class,'facturacion'])->name('fact');

Route::middleware('auth')->group(function() {
    includeRouteFiles(__DIR__.'/configuracionSunat/');
});
