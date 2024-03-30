<?php

namespace App\Providers;

use App\Models\seguridad\menus;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::share('theme', 'adminskote');

        View::composer(['seguridad.submodulos.index'], function ($view) {
            $menus = menus::all();
            $view->with('menus', $menus);
        });
    }
}
