<?php

namespace App\Http\Controllers;

use App\Models\Attributes;
use App\Models\AttributeOptions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeOptionRequest;

class AttributeOptionsController extends Controller
{
    public function index()
    {
        return view('frontendadmin.attributes_options.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Attributes $attribute)
    {
        return view('frontendadmin.attributes_options.create', compact('attribute'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AttributeOptionRequest $request, Attributes $attribute)
    {
        $attribute->attribute_options()->create($request->validated());

        return redirect()->route('admin.attributes.edit', $attribute)->with([
            'message' => 'Berhasil di buat !',
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
    // public function edit(Attributes $attribute, AttributeOptions $attribute_option)
    // {
    //     return view('frontendadmin.attributes_options.edit',compact('attribute', 'attribute_option'));
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */

    // public function update(AttributeOptionRequest $request, Attributes $attribute,AttributeOptions $attribute_option)
    // {
    //     $attribute_option->update($request->validated());

    //     return redirect()->route('attributes.edit', $attribute)->with([
    //         'message' => 'Berhasil di edit !',
    //         'alert-type' => 'info'
    //     ]);
    // }

    public function edit(Attributes $attribute, AttributeOptions $attribute_option)
{
    return view('frontendadmin.attributes_options.edit', compact('attribute', 'attribute_option'));
}

public function update(AttributeOptionRequest $request, Attributes $attribute, AttributeOptions $attribute_option)
{
    $attribute_option->update($request->validated());

    return redirect()->route('admin.attributes.edit', $attribute)->with([
        'message' => 'Berhasil di edit!',
        'alert-type' => 'info',
    ]);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attributes $attribute,AttributeOptions $attribute_option)
    {
        $attribute_option->delete();

        return redirect()->back()->with([
            'message' => 'Berhasil di hapus !',
            'alert-type' => 'danger'
        ]);
    }
}
