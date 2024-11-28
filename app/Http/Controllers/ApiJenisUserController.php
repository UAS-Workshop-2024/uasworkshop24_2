<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\JenisUser;
use Illuminate\Support\Facades\Auth;

class ApiJenisUserController extends Controller
{
    public function show()
    {
        $jenis_users = DB::table('jenis_user')
            ->where('delete_mark', 0)
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $jenis_users
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'jenis_user' => 'required|string|max:60',
        ]);

        $jenisUser = JenisUser::create($validatedData);

        return response()->json([
            'status' => 'success',
            'message' => 'Jenis User created successfully.',
            'data' => $jenisUser
        ], 201); // 201: Created
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

        return response()->json([
            'status' => 'success',
            'message' => 'Jenis User updated successfully.',
            'data' => $jenisUser
        ]);
    }

    public function destroy($id)
    {
        $jenisUser = JenisUser::find($id);

        if (!$jenisUser) {
            return response()->json(['message' => 'Resource not found'], 404);
        }

        $jenisUser->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Jenis User deleted successfully.'
        ]);
    }
}
