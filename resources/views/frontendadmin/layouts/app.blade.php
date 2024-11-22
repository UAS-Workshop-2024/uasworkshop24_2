

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <style>
        /* Tambahkan CSS di sini */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
        }

        .wrapper {
            display: flex;
            width: 100%;
        }

        .main-content {
            flex: 1;
            padding: 20px;
            background: #fff;
            min-height: 100vh;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        header p {
            margin: 0;
        }

        header .logout {
            text-decoration: none;
            color: #fff;
            background: #dc3545;
            padding: 5px 10px;
            border-radius: 4px;
            transition: background 0.3s ease;
        }

        header .logout:hover {
            background: #c82333;
        }

        footer {
            margin-top: auto;
            text-align: center;
            padding: 10px;
            background: #f8f9fa;
            border-top: 1px solid #ddd;
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="wrapper">
        <!-- Include Sidebar -->
        @include('frontendadmin.layouts.sidebar')

        <!-- Main Content -->
        <div class="main-content">
            @yield('header')
            @yield('content')
        </div>
    </div>
</body>
</html>
