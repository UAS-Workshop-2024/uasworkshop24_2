<?php

namespace App\Http\Controllers\FrontendUser;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderUserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $orders = Order::with('orderItems', 'shipment')
            ->where('user_id', $user->id)
            ->get();

        return view('user\Frontend.orders', compact('order'));
    }

    public function create()
    {

    }

    public function show($id)
    {
        $user = Auth::user();
        $order = Order::with('orderItems', 'shipment')
            ->where('user_id', $user->id)
            ->findOrFail($id);

        return view( );
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
            'address' => 'required|string|max:255',
        ]);

        $user = Auth::user();

        $order = new Order();
        $order->user_id = $user->id;
        $order->product_id = $request->product_id;
        $order->quantity = $request->quantity;
        $order->total_price = $request->total_price;
        $order->address = $request->address;
        $order->status = 'Pending'; // Status default saat dibuat
        $order->save();

        $order->save();

        return redirect()->route('')->with('success', 'Produk berhasil di order!');
    }

    public function edit($id)
    {
        $user = Auth::user();
        $order = Order::where('user_id', $user->id)->findOrFail($id);

        return redirect()->route(' ')->with('');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
            'address' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $order = Order::findOrFail('user_id', $user)
            ->findOrFail($id);

        $order->product_id = $request->product_id;
        $order->quantity = $request->quantity;
        $order->total_price = $request->total_price;
        $order->address = $request->address;
        $order->save();

        return redirect()->route('')->with('success', 'Order telah terupdate!');
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $order = Order::where('user_id', $user->id)
            ->findOrFail($id);

        $order->delete();

        return redirect()->route('')->with('success', 'Order telah dihapus!');
    }
}
