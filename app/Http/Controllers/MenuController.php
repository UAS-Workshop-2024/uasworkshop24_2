<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Menu;
use App\Models\MenuLevel;
use Carbon\Carbon;

class MenuController extends Controller
{
    public function index()
    {
        if (Auth::user()->id_jenis_user == 1) {
            $menu = DB::table('menu')->get();

            return view('frontendadmin.managemenu', compact('menu'));
        } else {
            return redirect()->route('home');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'menu_id' => 'required',
            'menu_name' => 'required',
            'menu_link' => 'required',
            'menu_icon' => 'required',
            'create_by' => 'required',
        ]);

        Menu::create([
            'menu_id' => $request->menu_id,
            'menu_name' => $request->menu_name,
            'menu_link' => $request->menu_link,
            'menu_icon' => $request->menu_icon,
            'create_by' =>  Auth::user()->id,
        ]);

        return redirect()->route('menu.show')->with('success', 'Menu created successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_level' => 'required',
            'menu_name' => 'required',
            'menu_link' => 'required',
            'menu_icon' => 'required',
            'create_by' => 'required',
        ]);

        $menu = Menu::findOrFail($id);
        $menu->id_level = $request->id_level;
        $menu->menu_name = $request->menu_name;
        $menu->menu_link = $request->menu_link;
        $menu->menu_icon = $request->menu_icon;
        $menu->create_by = Auth::user()->id;
        $menu->save();

        return redirect()->route('menu.show')->with('success', 'Menu updated successfully.');
    }

    public function destroy($id)
    {
        Menu::destroy($id);

        return redirect()->route('menu.show')->with('success', 'Menu deleted successfully.');
    }
}
