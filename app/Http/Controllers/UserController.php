<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserController extends Controller
{
    public function show()
    {
        if (Auth::user()->id_jenis_user == 1) {
            $users = DB::table('user')
                ->join('jenis_user', 'user.id_jenis_user', '=', 'jenis_user.id_jenis_user')
                ->select('user.*', 'jenis_user.jenis_user')
                ->get();

            $jenis_users = DB::table('jenis_user')->get();
            return view('management.user', compact('users' , 'jenis_users'));
        } else {
            return redirect()->route('home');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name'      => 'required|string|max:60',
            'last_name'      => 'required|string|max:60',
            'password'     => 'required|string|max:60',
            'email'     => 'required|string|email|max:200|unique:user',
            // 'phone' => 'required|string|max:30',
            // 'address1'  => 'required|string|max:30',
            // 'address2'  => 'required|string|max:30',
            // 'province_id' => 'required',
            // 'city_id' => 'required',
            // 'postcode' => 'required',
            'id_jenis_user' => 'required',
        ]);

        $user = new User;
        $user->first_name    = $request->first_name;
        $user->last_name     = $request->last_name;
        $user->password     = Hash::make($request->password);
        $user->email        = $request->email;
        $user->id_jenis_user  = $request->id_jenis_user;

        $user->save();

        return redirect()->route('user.show')->with('success', 'Menu level created successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name'      => 'required|string|max:60',
            'last_name'      => 'required|string|max:60',
            'password'     => 'required|string|max:60',
            'email'     => 'required|string|email|max:200|unique:user',
            // 'phone' => 'required|string|max:30',
            // 'address1'  => 'required|string|max:30',
            // 'address2'  => 'required|string|max:30',
            // 'province_id' => 'required',
            // 'city_id' => 'required',
            // 'postcode' => 'required',
            'id_jenis_user' => 'required|integer',
        ]);

        $user = User::where('id', $id)->firstOrFail();

        $user->first_name   = $request->first_name;
        $user->last_name     = $request->last_name;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->email        = $request->email;
        $user->id_jenis_user  = $request->id_jenis_user;

        $user->save();

        return redirect()->route('user.show')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::where('id', $id)->first();

        if ($user) {
            $user->delete();
            return redirect()->route('user.show')->with('success', 'User deleted successfully.');
        } else {
            return redirect()->route('user.show')->with('error', 'User not found.');
        }
    }

}
