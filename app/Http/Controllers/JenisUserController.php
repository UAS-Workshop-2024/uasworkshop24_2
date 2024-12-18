<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\JenisUser;
use Illuminate\Support\Facades\Auth;

class JenisUserController extends Controller
{
    public function show()
    {
        if (Auth::check() && Auth::user()->id_jenis_user == 1) {
            $jenis_users = DB::table('jenis_user')
                ->where('delete_mark', 0)
                ->get();

            return view('frontendadmin.jenisuser', compact('jenis_users'));
        } else {
            return redirect()->route('home');
        }
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'jenis_user' => 'required|string|max:60',
        ]);

        JenisUser::create($validatedData);

        return redirect()->route('admin.jenisUser.show')
                         ->with('success', 'Jenis User created successfully.');
    }

    public function update(Request $request, $id)
    {
        $jenisUser = JenisUser::find($id);

        if (!$jenisUser) {
            return response()->json(['message' => 'Resource not found'], 404);
        }

        $validatedData = $request->validate([
            'jenis_user' => 'required|string|max:60',
        ]);

        $jenisUser->update($validatedData);

        return redirect()->route('admin.jenisUser.show')
                         ->with('success', 'Jenis User updated successfully.');
    }

    public function destroy($id)
    {
        $jenis_users = JenisUser::findOrFail($id);
        $jenis_users->delete();

        return redirect()->route('admin.jenisUser.show')->with('success', 'Menu User deleted successfully.');
    }
}
