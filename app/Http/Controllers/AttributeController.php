<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeRequest;
use App\Models\Attributes;

class AttributeController extends Controller
{
    public function index()
    {
        $attributes = Attributes::orderBy('name', 'ASC')->get();

        return view('frontendadmin.attributes.attributes', compact('attributes'));
    }

    public function create()
    {
        $types = Attributes::types();
        $booleanOptions = Attributes::booleanOptions();
        $validations = Attributes::validations();

        return view('frontendadmin.attributes.create', compact('types', 'booleanOptions', 'validations'));
    }

    public function store(AttributeRequest $request)
    {
        $attribute = Attributes::create($request->validated());

        return redirect()->route('admin.attributes.edit', $attribute)->with([
            'message' => 'berhasil di buat !',
            'alert-type' => 'success'
        ]);
    }

    public function edit(Attributes $attribute)
    {
        $types = Attributes::types();
        $booleanOptions = Attributes::booleanOptions();
        $validations = Attributes::validations();

        return view('frontendadmin.attributes.edit', compact('attribute','types','booleanOptions','validations'));
    }

    public function update(AttributeRequest $request, Attributes $attribute)
    {
        $attribute->update($request->validated());

        return redirect()->route('admin.attributes.index')->with([
            'message' => 'Berhasil di edit !',
            'alert-type' => 'info'
        ]);
    }

    public function destroy(Attributes $attribute)
    {
        $attribute->delete();

        return redirect()->back()->with([
            'message' => 'Berhasil di hapus',
            'alert-type' => 'danger'
        ]);
    }
}
