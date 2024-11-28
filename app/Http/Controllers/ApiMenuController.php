<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class ApiMenuController extends Controller
{
    public function index()
    {
        $data = Menu::all();
        return response()->json([
            'status' => 'success',
            'data' => $data
        ], 200);
    }

    public function show($id)
    {
        $menu = Menu::find($id);

        if ($menu) {
            return response()->json([
                'status' => 'success',
                'data' => $menu,
            ], 200);
        } else {
            return response()->json(['status' => 'error', 'message' => 'User not found'], 404);
        }
    }

    // Menambahkan menu baru
    public function store(Request $request)
    {
        $request->validate([
            'menu_id' => 'required',
            'menu_name' => 'required',
            'menu_link' => 'required',
            'menu_icon' => 'required',
        ]);

        $menu = Menu::create([
            'menu_id' => $request->menu_id,
            'menu_name' => $request->menu_name,
            'menu_link' => $request->menu_link,
            'menu_icon' => $request->menu_icon,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Menu created successfully.',
            'menu' => $menu
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'menu_name' => 'required',
            'menu_link' => 'required',
            'menu_icon' => 'required',
        ]);

        $menu = Menu::findOrFail($id);
        $menu->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Menu updated successfully.',
            'menu' => $menu
        ], 200);
    }


    // Menghapus menu
    public function destroy($id)
    {
        Menu::destroy($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Menu deleted successfully.'
        ], 200);
    }
}



