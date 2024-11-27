@extends('frontendadmin.layouts.app')
@section('content')
<body>
<div>
  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center"><h4>Register Admin</h4></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <label for="first_name">First Name:</label>
                            <input type="first_name" class="form-control" id="first_name" name="first_name" required autofocus>
                          </div>

                          <div class="form-group">
                            <label for="last_name">Last Name:</label>
                            <input type="last_name" class="form-control" id="last_name" name="last_name" required autofocus>
                          </div>

                          <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </form>

                    <div class="text-center mt-3">
                        {{-- <a href="{{ route('register') }}">Don't have an account? Register</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
</body>

@endsection
{{-- method="POST" action="{{ route('login') }}" --}}
