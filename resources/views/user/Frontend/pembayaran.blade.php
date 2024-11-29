@extends('layouts.main')

@section('content')
<div class="container">
    <h1 class="mt-4">Detail Pembayaran</h1>
    <div class="row">
        <div class="col-md-6">
            <img src="{{ $qris_image }}" alt="QRIS Pembayaran" class="img-fluid">
        </div>
        <div class="col-md-6">
            <h4>Orders</h4>
            <ul class="list-group">
                @foreach($orders as $order)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $order->product_name }}
                    <span>Rp {{ number_format($order->price, 0, ',', '.') }}</span>
                </li>
                @endforeach
            </ul>
            <div class="mt-3">
                <h5>Total: Rp {{ number_format($total, 0, ',', '.') }}</h5>
            </div>
        </div>
    </div>
</div>
@endsection
