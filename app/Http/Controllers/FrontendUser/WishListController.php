<?php

namespace App\Http\Controllers\FrontendUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Products;
use App\Models\WishLists;


class WishListController extends Controller
{
    public function index()
    {
        $wishlists = WishLists::where('user_id', Auth::user())
			->orderBy('created_at', 'desc')->get();

		return view('user.frontend.wishlists.wishlist', compact('wishlists'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'status' => 401
            ]);
        }

        $request->validate(
			[
				'product_slug' => 'required',
			]
		);

		$product = Products::where('slug', $request->get('product_slug'))->firstOrFail();

		$favorite = WishLists::where('user_id', Auth::user())
			->where('product_id', $product->id)
            ->first();

		if ($favorite) {
			return response('Produk sudah ada !', 422);
		}

		WishLists::create(
			[
				'user_id' => Auth::user(),
				'product_id' => $product->id,
			]
		);

		return response('Produk berhasil di masukkan !', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WishLists $wishlist)
    {
        $wishlist->delete();

		return redirect('wishlists')->with([
            'message' => 'berhasil di hapus !',
            'alert-type' => 'danger'
        ]);
    }
}

