<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function index()
    {
        return 'La sesión se inicio correctamente. <br>
            <a href="'. route('logout').'">cerrar sesión</a>
        ';
    }
}
