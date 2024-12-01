<?php

namespace App\Http\Controllers\FrontendUser;

use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\WishLists;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PageController extends Controller
{
    public function carts()
    {
        // $user = Auth::user()->id;
        // $carts = Products::with('Product')
        //     ->where('user_id', Auth::id())
        //     ->OrderBy('created_at', 'DESC')
        //     ->get();

        $cart = Session::get('cart', []);
        $product = [];

        if(!empty($cart)){
            $productId = array_keys($cart);
            $product = Products::whereIn('id', $productId)->get();
        }

        return view('user\Frontend.carts', compact('carts'));
    }

    public function addtoCarts(Request $request, $id)
    {
        $product = Products::findOrFail($id);
        $cart = session::get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity'] += 1;
        } else {
            $cart[$id] =[
                'name' => $product->name,
                'price' => $product->priceLabel(),
                'quantity' => 1,
            ];
        }

        Session::put('cart', $cart);

        return redirect()->route('carts')->with('success', 'Produk berhasil ditambahkan ke keranjang!');

    }

    public function updateCart(Request $request, $id)
    {
        $product = Products::findOrFail($id);
        $cart = session::get('cart', []);

        if(isset($cart[$id])){
            $quantity = $request->input('quantity');
            if($quantity > 0){
                $cart[$id]['quantity'] = $quantity;
                Session::put('cart', $cart);

                return redirect()->route('carts')->with('success', 'Keranjang berhasil terupdate');
            }
        }

    }

    public function removefromCart(Request $request, $id)
    {
        $cart = session::get('cart', []);

        if(isset($cart[$id])){
            unset($cart[$id]);
            session::put('cart', $cart);

            return redirect()->route('carts')->with('success', 'Produk dihapus dari keranjang.');
        }

        return redirect()->route('carts')->with('error', 'Produk tidak ditemukan');
    }

    public function clearCart()
    {
        session::forget('cart');

        return redirect()->route('carts')->with('success', 'Keranjang dibersihkan.');
    }

    public function wishlist()
    {
        $userId = Auth::id();
        $wishlist = WishLists::where('user_id', $userId)
            ->with('w_product')
            ->get();

        return view('user\Frontend.wishlist', compact('wishlistt'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:product,id',
        ]);

        $userId = Auth::id();
        $productId = $request->input('product_id');

        $wishlistItem = WishLists::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if($wishlistItem){
            return response()->json(['message' => 'Produk sudah ada di wishlist'], 409);
        }

        $wishlistItem = $wishlistItem::create([
            'user_id' => $userId,
            'product_id' => $productId,
        ]);

        return response()->json(['message' => 'Produk berhasil ditambahkan ke wishlist', 'item' => $wishlistItem], 201);
    }

    public function destroy($id)
    {
        $userId = Auth::id();
        $wishlistItem = WishLists::where('user_id', $userId)
            ->where('id', $id)
            ->first();

        if (!$wishlistItem) {
            return response()->json(['message' => 'Item tidak ditemukan atau tidak memiliki akses'], 404);
        }

        $wishlistItem->delete();

        return response()->json(['message' => 'Item berhasil dihapus dari wishlist']);
    }
}
