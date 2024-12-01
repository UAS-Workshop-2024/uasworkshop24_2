<?php

namespace App\Http\Controllers\FrontendUser;
use App\Http\Controllers\Controller;

use App\Models\Payments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index()
    {
        $user = Auth::id();
        $payment = Payments::where('user_id', $user)
            ->get();

        return view('user\frontend.pembayaran', compact('payment'));
    }

    public function show($id)
    {
        $user = Auth::id();
        $payment = Payments::where('user_id', $user)
            ->fins($id);
        if(!$payment){
            return redirect()->route('')->with('error', 'Transaksi tidak ada!');
        }
        return view('');
    }
}
