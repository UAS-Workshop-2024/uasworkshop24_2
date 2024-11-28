<?php

namespace App\Http\Controllers;
use App\Models\Attributes;
use App\Models\AttributeOptions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeOptionRequest;

class AttributeOptionController extends Controller
{
    public function index()
    {
        return view('frontendadmin.attribute_options');
    }

    public function store(AttributeOptionRequest $request, Attributes $attribute)
    {
        $attribute->attribute_options()->create($request->validated());

        return redirect()->route('admin.attributes.edit', $attribute)->with([
            'message' => 'Berhasil di buat !',
            'alert-type' => 'success'
        ]);
    }

    public function update(AttributeOptionRequest $request, Attributes $attribute,AttributeOptions $attribute_option)
    {
        $attribute_option->update($request->validated());

        return redirect()->route('admin.attributes.edit', $attribute)->with([
            'message' => 'Berhasil di edit !',
            'alert-type' => 'info'
        ]);
    }

    public function destroy(Attributes $attribute,AttributeOptions $attribute_option)
    {
        $attribute_option->delete();

        return redirect()->back()->with([
            'message' => 'Berhasil di hapus !',
            'alert-type' => 'danger'
        ]);
    }
}
