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

        View::composer('theme.adminskote.aside', function($view) {
            $menus = menus::getMenus(true);
            $view->with('menus',$menus);
        });

        View::composer(['seguridad.submodulos.index'], function ($view) {
            $menus = menus::all();
            $view->with('menus', $menus);
        });
    }
}
