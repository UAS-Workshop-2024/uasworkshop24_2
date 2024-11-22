<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login Admin</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div>
  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center"><h4>Login Admin</h4></div>
  
                <div class="card-body">
                    <form >
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
</html>
{{-- method="POST" action="{{ route('login') }}" --}}