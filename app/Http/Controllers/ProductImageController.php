<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\ProductImage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProductImageRequest;

class ProductImageController extends Controller
{
    public function index(Products $product)
    {
        return view('frontendadmin.product_images.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Products $product)
    {
        return view('frontendadmin.product_images.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductImageRequest $request, Products $product)
    {
        if($request->validated()) {
            $path = $request->file('path')->store(
                'product/images', 'public'
            );
            ProductImage::create(['path' => $path, 'product_id' => $product->id]);
        }

        return redirect()->route('products.product_images.index', $product)->with([
            'message' => 'Berhasil di upload !',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $product, ProductImage $product_image)
    {
        File::delete('storage/'. $product_image->path);
        $product_image->delete();

        return redirect()->back()->with([
            'message' => 'Berhasil di hapus !',
            'alert-type' => 'danger'
        ]);
    }
}
