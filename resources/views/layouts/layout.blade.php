<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SerbukKopi.id')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .main-content {
            padding-top: 20px;
            padding-bottom: 20px;
        }
    </style>
</head>
<body>
        <div class="header-container">
            <!-- Bagian Kiri -->
            <div class="header-left">
                <a href="/" class="logo">SerbukKopi.id</a>
                <nav>
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li><a href="/products">Product</a></li>
                        <li><a href="/jenis-product">Kategori Product</a></li>
                    </ul>
                </nav>
            </div>

            <!-- Bagian Kanan -->
            <div class="header-icons">
                <a href="/wishlist" title="Wishlist"><i class="fas fa-heart"></i></a>
                <a href="/carts" title="Keranjang"><i class="fas fa-shopping-cart"></i></a>
                <a href="/orders" title="Checkout"><i class="fas fa-clipboard-check"></i></a>
                <a href="/profile" title="Profile"><i class="fas fa-user-circle"></i></a>
                <a href="/pembayaran" title="Pembayaran"><i class="fas fa-wallet"></i></a>
            </div>
        </div>
    </header>

            <!-- Content -->
            <div class="col-md-9">
                @yield('content')
            </div>
        </div>
    </main>

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
