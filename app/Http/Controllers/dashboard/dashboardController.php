<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function index()
    {
        return view('theme.adminskote.layout');
    }

    public function desarrollo() {
        return view('errors.mantenimiento');
    }
}
