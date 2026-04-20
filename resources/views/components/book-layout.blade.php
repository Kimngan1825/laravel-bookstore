<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Cái tiệm bán sách' }}</title>
    <!-- Bootstrap 5 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --mint: #20B2AA; 
        }

        body { 
            background-color: #ffffff; 
            font-family: system-ui, -apple-system, sans-serif; 
            display: flex; 
            flex-direction: column; 
            min-height: 100vh; 
        }

        .header-custom {
            background-color: var(--mint);
            padding: 10px 0;
            color: white;
        }

        .header-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .brand {
            font-weight: bold;
            font-size: 1.2rem;
            text-decoration: none;
            color: white !important;
            display: flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
        }

        .nav-menu {
            display: flex;
            gap: 20px;
            margin-left: 25px;
            list-style: none;
            padding: 0;
            margin-bottom: 0;
        }
        .nav-menu a {
            color: white;
            text-decoration: none;
            font-size: 0.95rem;
            opacity: 0.9;
        }
        .nav-menu a.active {
            opacity: 1;
            border-bottom: 2px white;
            padding-bottom: 2px;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .search-box {
            display: flex;
            background: white;
            border-radius: 4px;
            overflow: hidden;
            height: 32px;
        }
        .search-box input {
            border: none;
            padding: 0 10px;
            width: 180px;
            font-size: 0.85rem;
            outline: none;
            color: #333;
        }
        .search-box button {
            background: white;
            border: none;
            border-left: 1px solid #eee;
            padding: 0 10px;
            color: #666;
        }

        .cart-icon {
            font-size: 1.2rem;
            color: white;
            text-decoration: none;
        }

        .auth-links {
            display: flex;
            align-items: center;
            gap: 8px;
            color: white;
            font-size: 0.9rem;
        }
        .auth-links a {
            color: white;
            text-decoration: none;
            opacity: 0.9;
        }
        .auth-links a:hover { opacity: 1; }
        
        .user-link {
            display: flex;
            align-items: center;
            gap: 6px;
            color: white;
            text-decoration: none;
        }

        .footer-custom {
            background-color: #f8f9fc;
            border-top: 1px solid #eeeeee;
            padding: 40px 0 30px 0;
            margin-top: auto; 
        }
        .footer-title {
            font-weight: 700;
            font-size: 1.05rem;
            margin-bottom: 15px;
            color: #212529;
        }
        .footer-brand {
            color: #0d6efd; 
            font-weight: bold;
            font-size: 1.1rem;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .footer-text {
            color: #6c757d;
            font-size: 0.95rem;
            line-height: 1.6;
        }
        .footer-socials a {
            color: #6c757d;
            font-size: 1.4rem;
            transition: color 0.3s;
        }
        .footer-socials a:hover {
            color: var(--mint);
        }

        
    </style>
</head>
<body>

    <header class="header-custom sticky-top shadow-sm">
        <div class="header-container">
            
            <div class="d-flex align-items-center">
                <!-- Logo -->
                <a href="/sach" class="brand">
                    <i class="bi bi-book"></i> Cái tiệm bán sách
                </a>
                <!-- Menu  -->
                <ul class="nav-menu">
                    <li><a href="/sach" class="active">Trang chủ</a></li>
                    <li><a href="/sach">Sách</a></li>
                    <li><a href="{{ route('orderhistory') }}">Đơn hàng</a></li>
                </ul>
            </div>

            <div class="header-right">
                <form action="/search" method="GET" class="search-box shadow-sm">
                    <input type="text" name="q" placeholder="Tìm sách...">
                    <button type="submit"><i class="bi bi-search"></i></button>
                        <div id="search-results" class="list-group list-group-flush shadow-sm" 
                            style="position: absolute; top: 100%; left: 0; right: 0; background: white; z-index: 1050; display: none; max-height: 300px; overflow-y: auto;">
                        </div>
                </form>


                <!-- Giỏ hàng -->
                <a href="/cart" class="cart-icon">
                    <i class="bi bi-cart3"></i>
                </a>

                <div class="auth-links">
                    @auth
                        <div class="dropdown">
                            <a href="#" class="user-link dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle fs-5"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                <li><a class="dropdown-item small" href="{{ route('profile') }}">Thông tin tài khoản</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button class="dropdown-item text-danger small">Đăng xuất</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <i class="bi bi-person-circle fs-5"></i>
                        <a href="{{ route('login') }}">Đăng nhập</a>
                        <span class="opacity-50">|</span>
                        <a href="{{ route('register') }}">Đăng ký</a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <main class="container mt-5">
        @if(isset($sidebar))
            <div class="row">
                <div class="col-md-3">
                    {{ $sidebar }} <!-- Nơi chứa bộ lọc hoặc menu cá nhân -->
                </div>
                <div class="col-md-9">
                    {{ $slot }} <!-- Nơi chứa danh sách sách hoặc nội dung chính -->
                </div>
            </div>
        @else
            {{ $slot }}
        @endif
    </main>

    <footer class="footer-custom">
        <div class="container" style="max-width: 1200px;">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="footer-brand">
                        <i class="bi bi-book-half"></i> Online Bookstore
                    </div>
                    <p class="footer-text mb-2">Website bán sách trực tuyến với giao diện thân thiện, dễ sử dụng.</p>
                    <p class="footer-text small">&copy; {{ date('Y') }} BookStore. All rights reserved.</p>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="footer-title">Liên hệ</div>
                    <ul class="list-unstyled footer-text">
                        <li class="mb-2"><i class="bi bi-envelope me-2"></i> support@bookstore.com</li>
                        <li><i class="bi bi-telephone me-2"></i> 0901 000 001</li>
                    </ul>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="footer-title">Theo dõi</div>
                    <div class="footer-socials d-flex gap-3">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.search-box input').on('keyup', function() {
                let query = $(this).val();
                if (query.length >= 2) { 
                    $.ajax({
                        url: "{{ route('search') }}", 
                        method: "GET",
                        data: { q: query },
                        success: function(data) {
                            $('#search-results').html(data).fadeIn();
                        }
                    });
                } else {
                    $('#search-results').fadeOut();
                }
            });

            $(document).on('click', function(e) {
                if (!$(e.target).closest('.search-box').length) $('#search-results').fadeOut();
            });
        });
    </script>

    @stack('scripts')
</body>
</html>