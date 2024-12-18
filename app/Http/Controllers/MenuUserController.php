<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Menu;
use App\Models\SettingMenuUser;
use App\Models\JenisUser;

class MenuUserController extends Controller
{
    public function index()
    {
        if (Auth::user()->id_jenis_user == 1) {
            $setting_menu_user = DB::table('setting_menu_user')
                ->select(
                    'setting_menu_user.*',
                    'jenis_user.jenis_user',
                    'menu.menu_name'
                )
                ->join('jenis_user', 'jenis_user.id_jenis_user', '=', 'setting_menu_user.id_jenis_user')
                ->join('menu', 'menu.menu_id', '=', 'setting_menu_user.menu_id')
                ->get();

            $jenis_users = JenisUser::all();
            $menus = Menu::all();

            return view('frontendadmin.menuuser', compact('setting_menu_user', 'menus', 'jenis_users'));
        } else {
            return redirect()->route('home');
        }
    }
    public function store(Request $request)
    {
        $request->validate([
            'id_jenis_user' => 'required|exists:jenis_user,id_jenis_user',
            'menu_id' => 'required|exists:menu,menu_id',
            'create_by' => 'required|string|max:30',
        ]);

        SettingMenuUser::create([
            'id_jenis_user' => $request->id_jenis_user,
            'menu_id' => $request->menu_id,
            'create_by' =>  Auth::user()->id,
        ]);

        return redirect()->route('admin.menuUser.show')->with('success', 'Menu User created successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_jenis_user' => 'required|exists:jenis_user,id_jenis_user',
            'menu_id' => 'required|exists:menu,menu_id',
            'create_by' => 'required|string|max:30',
        ]);

        $setting_menu_user = SettingMenuUser::findOrFail($id);
        $setting_menu_user->update([
            'id_jenis_user' => $request->id_jenis_user,
            'menu_id' => $request->menu_id,
            'create_by' => Auth::user()->id,
        ]);

        return redirect()->route('admin.menuUser.show')->with('success', 'Menu User updated successfully.');
    }

    public function destroy($id)
    {
        $setting_menu_user = SettingMenuUser::findOrFail($id);
        $setting_menu_user->delete();

        return redirect()->route('admin.menuUser.show')->with('success', 'Menu User deleted successfully.');
    }

}

