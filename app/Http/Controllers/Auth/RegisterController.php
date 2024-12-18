<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function register()
    {
        return view('user.frontend.auth.register');
    }
    public function storeUser(Request $request)
    {
        $request->validate([
            'first_name'  => 'required|string|max:60',
            'last_name'  => 'required|string|max:60',
            'email'     => 'required|string|email|max:200|unique:user',
            'password'  => 'required|string|max:60',
        ]);

        DB::table('user')->insert([
            'first_name'  => $request->first_name,
            'last_name'  => $request->last_name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'id_jenis_user' => 2,
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);

        return redirect('login')->withSuccess('User successfully registered.');
    }
}
