<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bookstore Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root { --admin-teal: #1BA085; }
        .body { background-color: #f8f9fa; }
        .header-teal { background-color: var(--admin-teal); color: white; padding: 12px 25px; display: flex; justify-content: space-between; align-items: center; }
        .stat-card { background: white; border-radius: 10px; padding: 20px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); border-left: 5px solid; height: 100%; }
        .border-warning-custom { border-color: #ffc107; }
        .border-primary-custom { border-color: #0d6efd; }
        .border-success-custom { border-color: #198754; }
        .border-info-custom { border-color: #0dcaf0; }
        .stat-value { font-size: 1.8rem; font-weight: 800; margin-top: 5px; }
        .chart-box { background: white; border-radius: 10px; padding: 20px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); }
        .menu-btn { padding: 8px 15px; border-radius: 5px; text-decoration: none; font-weight: 600; border: 1px solid; transition: 0.3s; }
        .btn-book { border-color: #0d6efd; color: #0d6efd; }
        .btn-order { border-color: #198754; color: #198754; }
        .btn-user { border-color: #0dcaf0; color: #0dcaf0; }
        .btn-user:hover { background: #0dcaf0; color: white; }
        .btn-review { border-color: #ffc107; color: #ffc107; }
        .btn-review:hover { background: #ffc107; color: white; }
        .btn-category { border-color: #6610f2; color: #6610f2; }
        .btn-category:hover { background: #6610f2; color: white; }
        .btn-coupon { border-color: #1BA085; color: #1BA085; }
        .btn-coupon:hover { background: #1BA085; color: white; }
    </style>
</head>
<body>
    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>