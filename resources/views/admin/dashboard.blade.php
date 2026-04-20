@extends('layouts.admin')

@section('content')
<style>
    :root { --admin-teal: #1BA085; }
    /* Header & General */
    .header-teal { background-color: var(--admin-teal); color: white; padding: 12px 25px; display: flex; justify-content: space-between; align-items: center; border-radius: 0 0 10px 10px; }
    .chart-box { background: white; border-radius: 10px; padding: 20px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); }
    
    /* Stats Cards */
    .stat-card { background: white; border-radius: 10px; padding: 20px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); border-left: 6px solid; height: 100%; transition: 0.3s; }
    .border-warning-custom { border-color: #ffc107; }
    .border-primary-custom { border-color: #0d6efd; }
    .border-success-custom { border-color: #198754; }
    .border-info-custom { border-color: #0dcaf0; }
    .stat-value { font-size: 1.8rem; font-weight: 800; margin-top: 5px; }

    /* Navigation Buttons */
    .menu-btn { padding: 8px 15px; border-radius: 5px; text-decoration: none; font-weight: 600; border: 1px solid; transition: 0.3s; background: white; display: inline-flex; align-items: center; gap: 5px; }
    .btn-book { border-color: #0d6efd; color: #0d6efd; }
    .btn-order { border-color: #198754; color: #198754; }
    .btn-user { border-color: #0dcaf0; color: #0dcaf0; }
    .btn-review { border-color: #ffc107; color: #ffc107; }
    .btn-category { border-color: #6610f2; color: #6610f2; }
    .btn-coupon { border-color: #1BA085; color: #1BA085; }
    .menu-btn:hover { filter: brightness(0.9); background: #f8f9fa; }

    /* Ranking Badges */
    .rank-1 { background-color: #ffc107; color: #fff; }
    .rank-2 { background-color: #6c757d; color: #fff; }
    .rank-3 { background-color: #dc3545; color: #fff; }
</style>

{{-- Header --}}
<div class="header-teal shadow-sm mb-4">
    <div class="fs-5 fw-bold"><i class="bi bi-speedometer2"></i> Admin Dashboard</div>
    <div class="d-flex align-items-center">
        <span class="me-3">Xin chào, <strong>{{ Auth::user()->name ?? 'Admin'}}</strong></span>
        <a href="{{ url('/') }}" class="btn btn-sm btn-outline-light text-white fw-bold me-2" style="background-color: var(--admin-teal);">Trang chủ</a>
        <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-sm btn-danger fw-bold">Đăng xuất</button>
        </form>
    </div>
</div>

<div class="container-fluid px-4">
    {{-- Thanh quản lý nhanh --}}
    <div class="chart-box mb-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div class="d-flex align-items-center gap-2">
            <span class="fw-bold text-secondary small">QUẢN LÝ:</span>
            <a href="{{ route('admin.books') }}" class="menu-btn btn-book"><i class="bi bi-book"></i> Sách</a>
            <a href="{{ route('admin.orders') }}" class="menu-btn btn-order"><i class="bi bi-cart-check"></i> Đơn hàng</a>
            <a href="{{ route('admin.users') }}" class="menu-btn btn-user"><i class="bi bi-people"></i> User</a>
            <a href="{{ route('admin.reviews') }}" class="menu-btn btn-review"><i class="bi bi-star text-warning"></i> Đánh giá</a>
            <a href="{{ route('admin.categories') }}" class="menu-btn btn-category"><i class="bi bi-tags"></i> Danh mục</a>
            <a href="{{ route('admin.coupons') }}" class="menu-btn btn-coupon"><i class="bi bi-ticket-perforated"></i> Mã giảm giá</a>
        </div>
        
        <form method="GET" class="d-flex align-items-center gap-2">
            <span class="small text-muted"><i class="bi bi-funnel"></i> Lọc:</span>
            <select name="time" class="form-select form-select-sm" style="width: auto;">
                <option value="week" {{ $timeFilter == 'week' ? 'selected' : '' }}>Tuần</option>
                <option value="month" {{ $timeFilter == 'month' ? 'selected' : '' }}>Tháng</option>
            </select>
            <input type="text" class="form-control form-control-sm" value="Week 16, 2026" readonly style="width: 120px;">
            <button type="submit" class="btn btn-sm btn-primary px-3"><i class="bi bi-search"></i> Xem</button>
        </form>
    </div>

    {{-- Thẻ Thống kê --}}
    <div class="row g-3 mb-4 text-uppercase">
        <div class="col-md-3">
            <div class="stat-card border-warning-custom">
                <small class="text-muted fw-bold">{{ $revenueLabel }}</small>
                <div class="stat-value text-warning">{{ number_format($dynamicRevenue) }} đ</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card border-primary-custom">
                <small class="text-muted fw-bold">TỔNG SÁCH</small>
                <div class="stat-value text-primary">{{ $totalBooks }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card border-success-custom">
                <small class="text-muted fw-bold">TỔNG ĐƠN HÀNG</small>
                <div class="stat-value text-success">{{ $totalOrders }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card border-info-custom">
                <small class="text-muted fw-bold">THÀNH VIÊN</small>
                <div class="stat-value text-info">{{ $totalUsers }}</div>
            </div>
        </div>
    </div>

    {{-- Biểu đồ --}}
    <div class="row g-3">
        <div class="col-md-8">
            <div class="chart-box">
                <h6 class="fw-bold text-secondary mb-3"><i class="bi bi-graph-up"></i> BIỂU ĐỒ DOANH THU {{ $revenueLabel }}</h6>
                <div style="height: 500px;"><canvas id="chartRevenue"></canvas></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="chart-box">
                <h6 class="fw-bold text-secondary mb-3"><i class="bi bi-bar-chart-fill"></i> SÁCH BÁN CHẠY NHẤT</h6>
                <div style="height: 500px;"><canvas id="chartBooks"></canvas></div>
            </div>
        </div>
    </div>

    {{-- Top Khách hàng - Giống hoàn toàn mẫu ảnh --}}
    <div class="chart-box mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="fw-bold text-secondary mb-0 text-uppercase"><i class="bi bi-trophy text-warning"></i> Top 5 khách hàng tiêu biểu</h6>
            <a href="{{ route('admin.users') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">Xem tất cả khách hàng</a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light text-center small">
                    <tr><th>Hạng</th><th class="text-start">Thông tin khách hàng</th><th>Đơn hàng</th><th>Chi tiêu</th><th>Hành động</th></tr>
                </thead>
                <tbody>
                    @foreach($topUsers as $index => $u)
                    <tr class="text-center">
                        <td><span class="badge rounded-pill rank-{{ $index + 1 }} shadow-sm">#{{ $index + 1 }}</span></td>
                        <td class="text-start">
                            <div class="fw-bold text-dark">{{ $u->full_name }}</div>
                            <small class="text-muted">{{ $u->email }}</small>
                        </td>
                        <td class="fw-bold text-primary">{{ $u->total_orders }}</td>
                        <td class="fw-bold text-danger text-uppercase">{{ number_format($u->total_spent) }} đ</td>
                        <td><a href="{{ route('admin.users.orders', $u->user_id ?? 1) }}" class="btn btn-sm btn-outline-primary rounded-pill small">Chi tiết</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // 1. Biểu đồ Doanh thu (Đường cong)
    new Chart(document.getElementById('chartRevenue'), {
        type: 'line',
        data: {
            labels: {!! json_encode($chartLabels) !!},
            datasets: [{
                label: 'Doanh thu',
                data: {!! json_encode($chartData) !!},
                borderColor: '#1BA085',
                backgroundColor: 'rgba(27, 160, 133, 0.1)',
                fill: true, tension: 0.4, pointRadius: 4, pointBackgroundColor: '#1BA085'
            }]
        },
        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } } }
    });

    // 2. Biểu đồ Sách bán chạy (Cột ngang)
    new Chart(document.getElementById('chartBooks'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($bookLabels) !!},
            datasets: [{
                data: {!! json_encode($bookData) !!},
                backgroundColor: '#3498db', borderRadius: 5, barThickness: 15
            }]
        },
        options: { indexAxis: 'y', responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } } }
    });
</script>
@endsection