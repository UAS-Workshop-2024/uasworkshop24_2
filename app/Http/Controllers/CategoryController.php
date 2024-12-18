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

        return view('frontendadmin.categories.categories', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $main_categories = Categories::whereNull('parent_id')->get(['id', 'name']);

        return view('frontendadmin.categories.create', compact('main_categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        Categories::create($request->validated());

        return redirect()->route('admin.categories.index')->with([
            'message' => 'berhasil dibuat !',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categories $category)
    {
        $main_categories = Categories::whereNull('parent_id')->where('id','!=', $category->id)->get(['id', 'name']);

        return view('frontendadmin.categories.edit', compact('category', 'main_categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Categories $category)
    {
        $category->update($request->validated());

        return redirect()->route('admin.categories.index')->with([
            'message' => 'berhasil di tambah !',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categories $category)
    {
        $category->delete();

        return redirect()->back()->with([
            'message' => 'berhasil di hapus !',
            'alert-type' => 'danger'
        ]);
    }
}
