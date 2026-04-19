@extends('layouts.admin')

@section('content')
<style>
    :root { --admin-teal: #1BA085; }
    body { background-color: #f4f7f6; }

    /* Header */
    .header-teal-slim { 
        background-color: var(--admin-teal); 
        color: white; 
        padding: 8px 20px; 
        display: flex; 
        justify-content: space-between; 
        align-items: center; 
    }
    .btn-back-dash { 
        background: white; 
        color: #333; 
        border: 1px solid #ddd; 
        padding: 4px 12px; 
        border-radius: 4px; 
        text-decoration: none; 
        font-size: 0.85rem; 
    }

    /* Card thông tin */
    .user-info-card { 
        background: white; 
        border: 1px solid #eee; 
        border-radius: 10px; 
        padding: 25px; 
        margin: 25px 0;
        display: flex;
        align-items: center;
        box-shadow: 0 2px 5px rgba(0,0,0,0.02);
    }
    .avatar-placeholder { 
        width: 65px; height: 65px; 
        background: #f8f9fa; 
        border-radius: 50%; 
        display: flex; align-items: center; justify-content: center; 
        font-size: 1.5rem; color: #ccc; 
        margin-right: 25px;
        border: 1px solid #eee;
    }
    .info-grid { display: flex; flex-wrap: wrap; gap: 20px 40px; margin-top: 10px; }
    .info-item { display: flex; align-items: center; font-size: 0.85rem; color: #555; }
    .info-item i { margin-right: 8px; font-size: 1rem; }

    /* Trạng thái đơn hàng */
    .st-badge { padding: 4px 12px; border-radius: 4px; font-size: 0.75rem; font-weight: bold; color: white; border: none; }
    .st-pending { background-color: #ffc107; color: #000; }
    .st-delivered { background-color: #198754; }
    .st-cancelled { background-color: #dc3545; }
    .st-processing { background-color: #ffc107; color: #000; } /* Chờ xử lý giống pending */

    /* Bảng */
    .table-main { background: white; border-radius: 10px; border: 1px solid #eee; overflow: hidden; }
    .table thead th { 
        background: #fcfcfc; 
        border-bottom: 2px solid #1BA085; 
        padding: 15px; 
        font-size: 0.85rem; 
        color: #333;
        font-weight: 800;
    }
    .table tbody td { padding: 12px 15px; border-bottom: 1px solid #f8f8f8; font-size: 0.85rem; }
    
    .btn-chi-tiet { 
        border: 1px solid #0d6efd; 
        color: #0d6efd; 
        background: white; 
        padding: 2px 10px; 
        border-radius: 20px; 
        font-size: 0.75rem; 
        text-decoration: none;
    }
</style>

{{-- Header --}}
<div class="header-teal-slim shadow-sm">
    <div class="fw-bold"><i class="bi bi-shield-check me-2"></i>Admin Dashboard</div>
    <a href="{{ route('admin.dashboard') }}" class="btn-back-dash">
        <i class="bi bi-arrow-left me-1"></i> Quay lại Dashboard
    </a>
</div>

<div class="container-fluid px-5">
    {{-- Card thông tin khách hàng --}}
    <div class="user-info-card">
        <div class="avatar-placeholder"><i class="bi bi-person"></i></div>
        <div class="flex-grow-1">
            <h4 class="fw-bold mb-0">{{ $userInfo->full_name }}</h4>
            <div class="small text-muted mb-2">ID Khách hàng: #{{ $userInfo->user_id }}</div>
            
            <div class="info-grid">
                <div class="info-item"><i class="bi bi-envelope text-primary"></i> {{ $userInfo->email }}</div>
                <div class="info-item"><i class="bi bi-telephone text-success"></i> {{ $userInfo->phone ?? '0374220802' }}</div>
                <div class="info-item"><i class="bi bi-geo-alt text-danger"></i> Xem chi tiết trong đơn hàng</div>
                <div class="info-item"><i class="bi bi-calendar3 text-warning"></i> Tham gia: {{ \Carbon\Carbon::parse($userInfo->created_at)->format('d/m/Y') }}</div>
                <div class="info-item"><i class="bi bi-bullseye text-info"></i> Trạng thái: <span class="badge bg-success ms-1">Hoạt động</span></div>
            </div>
        </div>
    </div>

    {{-- Lịch sử đơn hàng --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold text-dark mb-0"><i class="bi bi-bag-check text-primary me-2"></i>Lịch sử đơn hàng</h5>
        <span class="badge bg-primary rounded-pill px-3 py-2">Tổng: {{ count($orderList) }} đơn</span>
    </div>

    <div class="table-main shadow-sm">
        <table class="table table-hover mb-0 align-middle">
            <thead class="text-center">
                <tr>
                    <th width="10%">Mã Đơn</th>
                    <th width="20%">Ngày đặt</th>
                    <th width="15%">Trạng thái</th>
                    <th width="15%">Tổng tiền</th>
                    <th width="15%">Thanh toán</th>
                    <th width="15%">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orderList as $order)
                <tr class="text-center">
                    <td class="fw-bold text-muted">#{{ $order->order_id }}</td>
                    <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d/m/Y H:i') }}</td>
                    <td>
                        <span class="st-badge st-{{ $order->status == 'confirmed' ? 'processing' : $order->status }}">
                            {{ $order->status == 'pending' ? 'Chờ xử lý' : ($order->status == 'delivered' ? 'Đã giao' : ($order->status == 'cancelled' ? 'Đã hủy' : 'Chờ xử lý')) }}
                        </span>
                    </td>
                    <td class="fw-bold text-danger">{{ number_format($order->total_amount) }} đ</td>
                    <td class="text-muted small">COD</td>
                    <td>
                        <a href="{{ route('admin.orders', ['id' => $order->order_id]) }}" class="btn-chi-tiet">
                            <i class="bi bi-eye me-1"></i> Chi tiết
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection