@extends('layouts.main')

@section('title', 'Detail Product - SerbukKopi.id')

@section('content')
<div class="container">
    <div class="row mt-4">
        <div class="col-md-6">
            <img src="{{ $product->image }}" class="img-fluid rounded" alt="{{ $product->name }}">
        </div>
        <div class="col-md-6">
            <h1>{{ $product->name }}</h1>
            <p class="text-muted">{{ $product->description }}</p>
            <h4 class="text-danger">Rp {{ number_format($product->price, 0, ',', '.') }}</h4>
            <form action="{{ route('user.frontend.carts', $product->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="quantity" class="form-label">Pilih Ukuran:</label>
                    <select name="size" id="size" class="form-control">
                        <option value="100g">100g</option>
                        <option value="250g">250g</option>
                        <option value="500g">500g</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary w-100">Tambah ke Keranjang</button>
            </form>
        </div>
    </div>
    <div class="mt-5">
        <h4>Tips</h4>
        <p>Tips untuk menikmati kopi ini ...</p>
    </div>
    <div class="mt-3">
        <h4>Review</h4>
        <p>Belum ada review untuk produk ini.</p>
    </div>
</div>
@endsection
