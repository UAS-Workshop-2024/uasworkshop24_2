@extends('layouts.main')

@section('content')
<div class="container">
    <h1 class="mt-4">My Account</h1>
    <div class="row">
        <div class="col-md-4">
            <img src="{{ $user->profile_image }}" class="img-fluid rounded" alt="User Profile">
        </div>
        <div class="col-md-8">
            <p><strong>First Name:</strong> {{ $user->first_name }}</p>
            <p><strong>Last Name:</strong> {{ $user->last_name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>No. Telp:</strong> {{ $user->phone }}</p>
        </div>
    </div>
</div>
@endsection
