<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // $user = Auth::user();
        // $menus = $user->JenisUser->menu;
        // dd($menus);
        $user = DB::table('user')->count();

        return view('home',compact('user'));
    }
}
