@extends('layouts.admin')

@section('content')
<style>
    :root { --admin-teal: #1BA085; }
    
    /* Header */
    .header-teal { background-color: var(--admin-teal); color: white; padding: 10px 25px; display: flex; justify-content: space-between; align-items: center; }
    .nav-btn { color: white; border: 1px solid rgba(255,255,255,0.5); padding: 5px 15px; border-radius: 8px; text-decoration: none; font-size: 0.9rem; background: rgba(255,255,255,0.1); transition: 0.3s; }
    .nav-btn:hover { background: rgba(255,255,255,0.2); color: white; }
    .btn-logout { background-color: #e74c3c; border: none; }
    .btn-logout:hover { background-color: #c0392b; }

    /* Layout Content */
    .page-title { color: #555; font-weight: bold; padding: 20px 0; text-transform: uppercase; }
    .card-custom { border: none; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); background: #fff; }
    .card-header-teal { border-top: 3px solid var(--admin-teal); background: white; font-weight: bold; color: var(--admin-teal); text-align: center; padding: 12px; border-bottom: 1px solid #eee; }

    /* Input & Form */
    .form-label-small { font-weight: bold; color: #333; font-size: 0.8rem; margin-bottom: 5px; display: block; }
    .input-custom { border: 1px solid #ddd; padding: 10px; border-radius: 5px; width: 100%; font-size: 0.85rem; }
    .btn-save-coupon { background-color: var(--admin-teal); color: white; border: none; padding: 10px; border-radius: 5px; width: 100%; font-weight: bold; display: flex; align-items: center; justify-content: center; gap: 8px; }
    .btn-save-coupon:hover { background-color: #168a71; }

    /* Table */
    .table thead { border-top: 3px solid var(--admin-teal); background-color: white; }
    .table thead th { font-weight: bold; color: #333; text-transform: none; font-size: 0.85rem; padding: 12px; border-bottom: 1px solid #dee2e6; }
    .table tbody td { padding: 15px 12px; vertical-align: middle; border-bottom: 1px solid #f2f2f2; font-size: 0.85rem; }
    
    .coupon-badge { background-color: var(--admin-teal); color: white; padding: 6px 15px; border-radius: 4px; font-weight: bold; font-size: 0.9rem; letter-spacing: 1px; }
    .text-price-red { color: #e74c3c; font-weight: bold; font-size: 1rem; }
    .info-sub { font-size: 11px; color: #999; }
</style>

{{-- Header gộp từ managebooks --}}
<div class="header-teal shadow-sm">
    <div class="fw-bold"><i class="bi bi-shield-check me-2"></i>Admin Dashboard</div>
    <div class="d-flex align-items-center gap-2">
        <span class="small me-2">Xin chào Admin, {{ Auth::user()->full_name ?? 'Trần Quản Trị' }}</span>
        <a href="{{ route('admin.dashboard') }}" class="nav-btn"><i class="bi bi-arrow-left-short"></i> Dashboard</a>
        <a href="{{ url('/') }}" class="nav-btn"><i class="bi bi-house-door"></i> Trang chủ</a>
        <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="nav-btn btn-logout"><i class="bi bi-box-arrow-right"></i> Đăng xuất</button>
        </form>
    </div>
</div>

<div class="container-fluid px-5">
    <h3 class="page-title">QUẢN LÝ MÃ GIẢM GIÁ (COUPONS)</h3>

    <div class="row">
        {{-- CỘT BÊN TRÁI: TẠO MÃ MỚI --}}
        <div class="col-md-4">
            <div class="card card-custom mb-4">
                <div class="card-header-teal">
                    <i class="bi bi-plus-circle me-1"></i> TẠO MÃ MỚI
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.coupons.save') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label-small text-muted">Mã Code (VD: TET2025)</label>
                            <input type="text" name="code" class="input-custom text-uppercase fw-bold" placeholder="NHẬP MÃ..." required>
                        </div>

                        <div class="row mb-3">
                            <div class="col-6">
                                <label class="form-label-small text-muted">Loại giảm</label>
                                <select name="discount_type" class="form-select input-custom">
                                    <option value="percent">% Phần trăm</option>
                                    <option value="fixed">Tiền (VNĐ)</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="form-label-small text-muted">Giá trị</label>
                                <input type="number" name="discount_value" class="input-custom" placeholder="VD: 10" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label-small text-muted">Đơn tối thiểu (VNĐ)</label>
                            <input type="number" name="min_order_value" class="input-custom" value="0">
                        </div>

                        <div class="mb-3">
                            <label class="form-label-small text-muted">Lượt dùng tối đa (0 = Vô hạn)</label>
                            <input type="number" name="max_usage" class="input-custom" value="100">
                        </div>

                        <div class="mb-4">
                            <label class="form-label-small text-muted">Ngày hết hạn (Bỏ trống = Vô hạn)</label>
                            <input type="datetime-local" name="end_date" class="input-custom">
                        </div>

                        <button type="submit" class="btn btn-save-coupon shadow-sm">
                            <i class="bi bi-save"></i> LƯU MÃ
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- CỘT BÊN PHẢI: DANH SÁCH MÃ --}}
        <div class="col-md-8">
            <div class="card card-custom">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="text-center">
                            <tr>
                                <th width="15%">Code</th>
                                <th width="20%">Giảm giá</th>
                                <th width="20%">Điều kiện</th>
                                <th width="25%">Hạn dùng</th>
                                <th width="10%">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($coupons as $c)
                            <tr class="text-center">
                                <td><span class="coupon-badge">{{ $c->code }}</span></td>
                                <td>
                                    <span class="text-price-red">
                                        {{ $c->discount_type == 'percent' ? '-' . (int)$c->discount_value . '%' : '-' . number_format($c->discount_value) . 'đ' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="text-muted small">Min: {{ number_format($c->min_order_value) }}đ</span>
                                </td>
                                <td>
                                    <div class="fw-bold">{{ $c->end_date ? date('d/m/y H:i', strtotime($c->end_date)) : 'Vĩnh viễn' }}</div>
                                    <div class="info-sub">Đã dùng: {{ $c->usage_count }}/{{ $c->max_usage > 0 ? $c->max_usage : '∞' }}</div>
                                </td>
                                <td>
                                    <a href="{{ route('admin.coupons.delete', $c->coupon_id) }}" 
                                       class="text-danger border-0 p-0" onclick="return confirm('Xóa mã này?')">
                                        <i class="bi bi-trash-fill fs-5"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection