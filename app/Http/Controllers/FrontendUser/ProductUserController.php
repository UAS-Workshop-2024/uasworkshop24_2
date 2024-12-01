<?php

namespace App\Http\Controllers\FrontendUser;
use App\Http\Controllers\Controller;

use App\Models\ProductCategory;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductUserController extends Controller
{
    public function index()
    {
        $product = Products::all();

        return view('user\Frontend.products', compact('product_user'));
    }

    public function show($id)
    {
        $product = Products::find($id);
        if(!$product){
            return redirect()->route(' ')->with('error', 'Produk tidak ditemukan!');
        }

        return view('user\frontend.detail_product', ['product' => $product]);
    }

    public function jenis()
    {
        $jenis = ProductCategory::all();

        return view('user\frontend.jenis_product', ['jenis' => $jenis]);
    }

    public function detailjenis($id)
    {
        $jenis = ProductCategory::find($id);
        if(!$jenis){
            return redirect()->route('')->with('error', 'Jenis produk tidak ditemukan!');
        }
        $product = $jenis->product;
        return view('user\frontend.detail_jenis_product', ['jenis' => $jenis, 'prodcut' => $product]);
    }
}
