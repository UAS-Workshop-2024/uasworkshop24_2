<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// user
Route::get('/coba', [App\Http\Controllers\ApiUserController::class, 'ambilData'])->name('coba');
Route::get('/ambilJenisUser', [App\Http\Controllers\ApiUserController::class, 'ambilJenisUser'])->name('coba');
Route::get('/coba/{id}', [App\Http\Controllers\ApiUserController::class, 'show']);
Route::put('/coba/{id}', [App\Http\Controllers\ApiUserController::class, 'update']);
Route::delete('/deleteUser/{id}', [App\Http\Controllers\ApiUserController::class, 'destroy']);
Route::post('/createUser', [App\Http\Controllers\ApiUserController::class, 'store']);

// menu
Route::get('/menu', [App\Http\Controllers\ApiMenuController::class, 'index'])->name('menu.index');
Route::get('/menu/{id}', [App\Http\Controllers\ApiMenuController::class, 'show'])->name('menu.show');
Route::post('/menu', [App\Http\Controllers\ApiMenuController::class, 'store'])->name('menu.store');
Route::put('/menu/{id}', [App\Http\Controllers\ApiMenuController::class, 'update'])->name('menu.update');
Route::delete('/menu/{id}', [App\Http\Controllers\ApiMenuController::class, 'destroy'])->name('menu.destroy');

// menu user
Route::get('/menuUser', [App\Http\Controllers\ApiMenuUserController::class, 'index'])->name('menuUser.show');
Route::post('/menuUser', [App\Http\Controllers\ApiMenuUserController::class, 'store'])->name('menuUser.store');
Route::get('/menuUser/{id}', [App\Http\Controllers\ApiMenuUserController::class, 'show']);
Route::put('/menuUser/{id}', [App\Http\Controllers\ApiMenuUserController::class, 'update']);
Route::delete('/menuUser/{id}', [App\Http\Controllers\ApiMenuUserController::class, 'destroy']);
Route::get('/ambilJenisUserDiMenuUser', [App\Http\Controllers\ApiMenuUserController::class, 'ambilJenisUserDiMenuUser']);
Route::get('/ambilMenuUser', [App\Http\Controllers\ApiMenuUserController::class, 'ambilMenuUser']);


// jenisuser
Route::get('/kategori', [App\Http\Controllers\JenisUserController::class, 'show'])->name('jenisUser.show');
Route::post('/createKategori', [App\Http\Controllers\JenisUserController::class, 'store'])->name('jenisUser.show');
Route::put('/kategori/{id}', [App\Http\Controllers\JenisUserController::class, 'update']);
Route::delete('/kategori/{id}', [App\Http\Controllers\JenisUserController::class, 'destroy']);

