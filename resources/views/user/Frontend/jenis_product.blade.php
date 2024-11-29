@extends('layouts.main')

@section('title', 'Detail Jenis Product - SerbukKopi.id')

@section('content')
<div class="container">
    <h1 class="mt-4">Jenis Kopi</h1>
    <div class="row">
        @foreach($categories as $category)
        <div class="col-12 mb-3">
            <a href="{{ route('jenis.detail', $category->id) }}" class="btn btn-light w-100 text-start shadow-sm">
                {{ $category->name }}
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection
