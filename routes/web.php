<?php

use App\Http\Controllers\dashboard\dashboardController;
use App\Http\Controllers\seguridad\loginController;
use Illuminate\Support\Facades\Route;

// RUTA QUE SE USA PARA PARA LAS OPCIONES DE LOGIN Y LOGOUT
Route::prefix('/')->controller(loginController::class)->group(function() {
    Route::get('', 'index')->name('login');
    Route::post('login', 'login')->name('login_post');
    Route::get('logout', 'logout')->name('logout');
});

// RUTAS QUE PERMIEACCEDER A LAS FUNCIONES DEL SISTEMA UNA VEZ LOGEADO
Route::prefix('admin')->middleware('auth')->controller(dashboardController::class)->group(function() {
    Route::get('', 'index')->name('menu');
    Route::get('mantenimiento','development')->name('develop');
});

Route::middleware('auth')->group(function() {
    includeRouteFiles(__DIR__.'/seguridad/modulos/');
    includeRouteFiles(__DIR__.'/seguridad/subModulos/');
});
