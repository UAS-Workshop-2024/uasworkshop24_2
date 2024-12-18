@extends('frontendadmin.layouts.app')
@section('content')
<body>
<div>
  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center"><h4>Login Admin</h4></div>

                <div class="card-body">
                    <form  method="POST" action="{{ route('admin.login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required autofocus>
                        </div>

                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label" for="remember">Remember Me</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Login</button>
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
