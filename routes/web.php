<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// ----------------------------- home dashboard ------------------------------//
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// -----------------------------login----------------------------------------//
Route::get('/login', [App\Http\Controllers\LoginController::class, 'login'])->name('login');
Route::post('/login', [App\Http\Controllers\LoginController::class, 'authenticate']);
Route::get('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');

// ------------------------------ register ---------------------------------//
Route::get('/register', [App\Http\Controllers\RegisterController::class, 'register'])->name('register');
Route::post('/register', [App\Http\Controllers\RegisterController::class, 'storeUser'])->name('register');

// ------------------------------ menu_levels ---------------------------------//
Route::get('menu', [App\Http\Controllers\MenuController::class, 'index'])->middleware('auth')->name('menu.show');
Route::post('menu', [App\Http\Controllers\MenuController::class, 'store'])->middleware('auth')->name('menu.store');
Route::post('menu/{id}', [App\Http\Controllers\MenuController::class, 'update'])->middleware('auth')->name('menu.update');
Route::get('menu/delete/{id}', [App\Http\Controllers\MenuController::class, 'destroy'])->middleware('auth')->name('menu.destroy');

// ------------------------------ menu_user ---------------------------------//
Route::get('menuUser', [App\Http\Controllers\MenuUserController::class, 'index'])->middleware('auth')->name('menuUser.show');
Route::post('menuUser', [App\Http\Controllers\MenuUserController::class, 'store'])->middleware('auth')->name('menuUser.store');
Route::post('menuUser/{id}', [App\Http\Controllers\MenuUserController::class, 'update'])->middleware('auth')->name('menuUser.update');
Route::get('menuUser/{id}', [App\Http\Controllers\MenuUserController::class, 'destroy'])->middleware('auth')->name('menuUser.destroy');

// ----------------------------- Jenis User ------------------------------//
Route::get('jenisUser', [App\Http\Controllers\JenisUserController::class, 'show'])->name('jenisUser.show');
Route::post('jenisUser', [App\Http\Controllers\JenisUserController::class, 'store'])->name('jenisUser.store');
Route::post('jenisUser/{id}', [App\Http\Controllers\JenisUserController::class, 'update'])->name('jenisUser.update');
Route::get('jenisUser/{id}', [App\Http\Controllers\JenisUserController::class, 'destroy'])->middleware('auth')->name('jenisUser.destroy');

// ----------------------------- User ------------------------------//
Route::get('user', [App\Http\Controllers\UserController::class, 'show'])->middleware('auth')->name('user.show');
Route::post('user', [App\Http\Controllers\UserController::class, 'store'])->middleware('auth')->name('user.store');
Route::post('user/{id}', [App\Http\Controllers\UserController::class, 'update'])->middleware('auth')->name('user.update');
Route::get('user/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->middleware('auth')->name('user.destroy');

// ----------------------------- profile ------------------------------//
Route::get('profile', [App\Http\Controllers\ProfileController::class, 'showProfile'])->middleware('auth')->name('profile.show');
Route::post('profile/update', [App\Http\Controllers\ProfileController::class, 'updateBiodata'])->middleware('auth')->name('profile.update');

