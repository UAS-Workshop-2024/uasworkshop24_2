<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\JenisUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ApiUserController extends Controller
{
    public function ambilData()
    {
        $data = User::all();
        return response()->json([
            'status' => 'success',
            'data' => $data,
        ], 200);
    }

    public function ambilJenisUser(){
        $data = JenisUser::all();
        return response()->json([
            'status' => 'success',
            'data' => $data,
        ], 200);
    }

    public function show($id)
    {
        $user = User::find($id);
        $jenisUsers = JenisUser::all();

        if ($user) {
            return response()->json([
                'status' => 'success',
                'data' => $user,
                'jenisUsers' => $jenisUsers
            ], 200);
        } else {
            return response()->json(['status' => 'error', 'message' => 'User not found'], 404);
        }
    }

    // Menyimpan user baru (untuk View dan API)
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:60',
            'last_name' => 'required|string|max:60',
            'password' => 'required|string|max:60',
            'email' => 'required|string|email|max:200|unique:user',
            'phone' => 'required|string|max:30',
            'id_jenis_user' => 'required|integer',
        ]);

        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->id_jenis_user = $request->id_jenis_user;
        $user->save();

        if ($request->wantsJson()) {
            return response()->json(['message' => 'User created successfully.', 'data' => $user], 201);
        }

        return redirect()->route('user.show')->with('success', 'Menu level created successfully.');
    }

    // Mengupdate user (untuk View dan API)
    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:60',
            'last_name' => 'required|string|max:60',
            'password' => 'nullable|string|max:60',
            'email' => 'required|string|email|max:200|unique:user,email,' . $id,
            'phone' => 'required|string|max:30',
            'id_jenis_user' => 'required|integer',
        ]);

        $user = User::findOrFail($id);

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->id_jenis_user = $request->id_jenis_user;
        $user->save();

        if ($request->wantsJson()) {
            return response()->json(['message' => 'User updated successfully.', 'data' => $user], 200);
        }

        return redirect()->route('user.show')->with('success', 'User updated successfully.');
    }

    // Menghapus user (untuk View dan API)
    public function destroy(Request $request, $id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();

            if ($request->wantsJson()) {
                return response()->json(['message' => 'User deleted successfully.'], 200);
            }

            return redirect()->route('user.show')->with('success', 'User deleted successfully.');
        }

        if ($request->wantsJson()) {
            return response()->json(['error' => 'User not found.'], 404);
        }

        return redirect()->route('user.show')->with('error', 'User not found.');
    }
}
