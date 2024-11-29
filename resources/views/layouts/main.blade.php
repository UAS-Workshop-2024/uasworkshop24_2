<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SerbukKopi.id')</title>
    <!-- Tambahkan font-awesome untuk ikon -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        /* Inline CSS */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #f8f8f8;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header-left {
            display: flex;
            align-items: center;
        }

        .header-left .logo {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            text-decoration: none;
            margin-right: 20px;
        }

        .header-left nav ul {
            display: flex;
            gap: 15px;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .header-left nav ul li a {
            text-decoration: none;
            color: #555;
            font-size: 16px;
            transition: color 0.3s;
        }

        .header-left nav ul li a:hover {
            color: #000;
        }

        .header-icons {
            display: flex;
            gap: 15px;
        }

        .header-icons a {
            color: #555;
            font-size: 20px;
            text-decoration: none;
            transition: color 0.3s;
        }

        .header-icons a:hover {
            color: #000;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="header-container">
            <!-- Bagian Kiri -->
            <div class="header-left">
                <a href="/" class="logo">SerbukKopi.id</a>
                <nav>
                    <ul class="nav-menu">
                        <li><a href="/" class="nav-link">Home</a></li>
                        <li><a href="/products" class="nav-link">Product</a></li>
                        <li><a href="/jenis-product" class="nav-link">Kategori Product</a></li>
                    </ul>
                </nav>
            </div>
    
            <!-- Bagian Kanan -->
            <div class="header-icons">
                <a href="/wishlist" title="Wishlist" class="icon-link"><i class="fas fa-heart"></i></a>
                <a href="/carts" title="Keranjang" class="icon-link"><i class="fas fa-shopping-cart"></i></a>
                <a href="/orders" title="Checkout" class="icon-link"><i class="fas fa-clipboard-check"></i></a>
                <a href="/profile" title="Profile" class="icon-link"><i class="fas fa-user-circle"></i></a>
                <a href="/pembayaran" title="Pembayaran" class="icon-link"><i class="fas fa-wallet"></i></a>
            </div>
        </div>
    </header>

    <!-- Content -->
    <main>
        <div class="col-md-9">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white py-3">
        <div class="container text-center">
            <div style="margin-bottom: 10px;">
                <a href="/kontak" style="text-decoration: none; color: #fffaf0; margin-right: 10px;">Kontak</a> |
                <a href="/bantuan" style="text-decoration: none; color: #fffaf0; margin-left: 10px;">Bantuan</a>
            <p>© {{ date('Y') }} SerbukKopi.id - All Rights Reserved</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
