<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Categories;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Categories::with('parent')->get();

        return view('frontendadmin.categories', compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        Categories::create($request->validated());

        return redirect()->route('frontendadmin.categories')->with([
            'message' => 'berhasil dibuat !',
            'alert-type' => 'success'
        ]);
    }

    public function update(CategoryRequest $request, Categories $category)
    {
        $category->update($request->validated());

        return redirect()->route('frontendadmin.categories')->with([
            'message' => 'berhasil di tambah !',
            'alert-type' => 'success'
        ]);
    }

    public function destroy(Categories $category)
    {
        $category->delete();

        return redirect()->back()->with([
            'message' => 'berhasil di hapus !',
            'alert-type' => 'danger'
        ]);
    }
}
