<?php

namespace App\Http\Controllers;

use App\Models\Menu;

class DashboardController extends Controller
{
    public function index()
    {
        $menu = Menu::query();
        $menu = $menu->orderBy('Permiso')->get();

        return view('dashboard')->with(['menu'=>$menu]); 
    }
}
