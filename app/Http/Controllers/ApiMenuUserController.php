<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\SettingMenuUser;
use App\Models\JenisUser;

class ApiMenuUserController extends Controller
{
    public function index()
    {
        $setting_menu_user = SettingMenuUser::with(['jenisUser', 'menu'])->get();
        return response()->json([
            'status' => 'success',
            'data' => $setting_menu_user
        ], 200);
    }

    public function show($id)
    {
        $setting_menu_user = SettingMenuUser::find($id);
        $jenisUsers = JenisUser::all();
        $menus = Menu::all();

        if ($setting_menu_user) {
            return response()->json([
                'status' => 'success',
                'data' => $setting_menu_user,
                'jenisUsers' => $jenisUsers,
                'menus' => $menus
            ], 200);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Setting Menu User not found'], 404);
        }
    }


    public function store(Request $request)
    {
        $request->validate([
            'create_jenis_user' => 'required|exists:jenis_user,id_jenis_user',
            'create_menu' => 'required|exists:menu,menu_id',
        ]);

        $menuUser = SettingMenuUser::create([
            'id_jenis_user' => $request->create_jenis_user,
            'menu_id' => $request->create_menu,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Menu User created successfully.',
            'data' => $menuUser
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $setting_menu_user = SettingMenuUser::find($id);
        if ($setting_menu_user) {
            $setting_menu_user->id_jenis_user = $request->id_jenis_user;
            $setting_menu_user->menu_id = $request->menu_id;
            $setting_menu_user->save();

            return response()->json(['status' => 'success', 'message' => 'Update Setting Menu User Success!'], 200);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Setting Menu User not found'], 404);
        }
    }


    public function destroy($id)
    {
        $setting_menu_user = SettingMenuUser::findOrFail($id);
        $setting_menu_user->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Menu User deleted successfully.'
        ], 200);
    }

    public function ambilJenisUserDiMenuUser()
    {
        $jenis_users = JenisUser::all();
        return response()->json([
            'status' => 'success',
            'data' => $jenis_users
        ], 200);
    }

    public function ambilMenuUser()
    {
        $menus = Menu::all();

        return response()->json([
            'status' => 'success',
            'data' => $menus
        ], 200);
    }
}
