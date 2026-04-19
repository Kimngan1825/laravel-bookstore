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

    /* Order Styles & Filters */
    .page-title { color: #555; font-weight: bold; padding: 20px 0; text-transform: uppercase; }
    .filter-tab { padding: 8px 18px; border-radius: 20px; text-decoration: none; font-size: 0.85rem; color: #666; background: #fff; margin-right: 8px; border: 1px solid #ddd; transition: 0.2s; font-weight: 500; }
    .filter-tab:hover { background: #f8f9fa; color: var(--admin-teal); }
    .filter-tab.active { background: var(--admin-teal); color: white; border-color: var(--admin-teal); }
    
    /* Master-Detail Layout */
    .order-list-container { background: white; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); height: 650px; overflow-y: auto; }
    .order-item-card { border-left: 4px solid transparent; transition: 0.2s; cursor: pointer; border-bottom: 1px solid #eee; padding: 15px; }
    .order-item-card:hover { background: #f4fdfb; }
    .order-item-card.active { background: #e8f4f1; border-left-color: var(--admin-teal); }

    .status-badge { font-size: 11px; padding: 4px 12px; border-radius: 12px; font-weight: bold; text-transform: uppercase; border: 1px solid transparent; }
    .st-pending { background: #fff3cd; color: #856404; border-color: #ffeeba; }
    .st-confirmed { background: #cfe2ff; color: #084298; border-color: #b6d4fe; }
    .st-shipping { background: #e0cffc; color: #6610f2; border-color: #d1b8fb; }
    .st-delivered { background: #d1e7dd; color: #0f5132; border-color: #badbcc; }
    .st-cancelled { background: #f8d7da; color: #842029; border-color: #f5c2c7; }

    .detail-card { border-radius: 8px; border: none; box-shadow: 0 2px 15px rgba(0,0,0,0.08); background: #fff; }
    .book-thumb { width: 45px; height: 65px; object-fit: cover; border-radius: 4px; border: 1px solid #eee; }
    .text-teal { color: var(--admin-teal) !important; }
</style>

{{-- Header --}}
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

<div class="container-fluid px-5 pb-5">
    <h3 class="page-title">QUẢN LÝ ĐƠN HÀNG</h3>

    {{-- Bộ lọc trạng thái --}}
    <div class="mb-4 d-flex align-items-center flex-wrap gap-2">
        <span class="fw-bold me-2 text-muted small"><i class="bi bi-funnel-fill me-1"></i> BỘ LỌC:</span>
        <a href="{{ route('admin.orders', ['status' => 'all']) }}" class="filter-tab {{ $statusFilter == 'all' ? 'active' : '' }}">Tất cả</a>
        <a href="{{ route('admin.orders', ['status' => 'pending']) }}" class="filter-tab {{ $statusFilter == 'pending' ? 'active' : '' }}">Chờ duyệt</a>
        <a href="{{ route('admin.orders', ['status' => 'confirmed']) }}" class="filter-tab {{ $statusFilter == 'confirmed' ? 'active' : '' }}">Đã xác nhận</a>
        <a href="{{ route('admin.orders', ['status' => 'shipping']) }}" class="filter-tab {{ $statusFilter == 'shipping' ? 'active' : '' }}">Đang giao</a>
        <a href="{{ route('admin.orders', ['status' => 'delivered']) }}" class="filter-tab {{ $statusFilter == 'delivered' ? 'active' : '' }}">Đã giao</a>
        <a href="{{ route('admin.orders', ['status' => 'cancelled']) }}" class="filter-tab {{ $statusFilter == 'cancelled' ? 'active' : '' }}">Đã hủy</a>
    </div>

    <div class="row">
        {{-- DANH SÁCH ĐƠN HÀNG (CỘT 4) --}}
        <div class="col-md-4">
            <div class="order-list-container border">
                <div class="p-3 border-bottom bg-light fw-bold text-teal">DANH SÁCH ĐƠN</div>
                @forelse($orders as $o)
                <a href="{{ route('admin.orders', ['id' => $o->order_id, 'status' => $statusFilter]) }}" class="text-decoration-none text-dark">
                    <div class="order-item-card {{ request('id') == $o->order_id ? 'active' : '' }}">
                        <div class="d-flex justify-content-between align-items-start">
                            <span class="fw-bold text-primary">#{{ $o->order_id }}</span>
                            <span class="status-badge st-{{ $o->status }}">{{ $o->status }}</span>
                        </div>
                        <div class="small fw-bold mt-2"><i class="bi bi-person me-1"></i>{{ $o->full_name }}</div>
                        <div class="d-flex justify-content-between mt-2">
                            <span class="text-danger fw-bold">{{ number_format($o->total_amount) }}đ</span>
                            <span class="text-muted" style="font-size: 0.75rem">{{ date('d/m H:i', strtotime($o->order_date)) }}</span>
                        </div>
                    </div>
                </a>
                @empty
                <div class="p-5 text-center text-muted italic">Không tìm thấy đơn hàng nào.</div>
                @endforelse
            </div>
        </div>

        {{-- CHI TIẾT ĐƠN HÀNG (CỘT 8) --}}
        <div class="col-md-8">
            @if($orderDetail)
            <div class="card detail-card p-4">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
                    <div>
                        <h5 class="fw-bold text-teal mb-1">CHI TIẾT ĐƠN HÀNG #{{ $orderDetail->order_id }}</h5>
                        <div class="text-muted small">Thời gian đặt: {{ date('d/m/Y H:i:s', strtotime($orderDetail->order_date)) }}</div>
                    </div>
                    <span class="status-badge st-{{ $orderDetail->status }} fs-6 px-4 py-2 shadow-sm">{{ $orderDetail->status }}</span>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6 border-end">
                        <h6 class="fw-bold text-muted mb-3"><i class="bi bi-person-lines-fill me-2"></i>Thông tin người nhận</h6>
                        <div class="ps-3 border-start border-3 border-light">
                            <div class="fw-bold">{{ $orderDetail->full_name }}</div>
                            <div class="small text-muted">{{ $orderDetail->email }}</div>
                            <div class="small text-muted">{{ $orderDetail->phone }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h6 class="fw-bold text-muted mb-3"><i class="bi bi-truck me-2"></i>Địa chỉ giao hàng</h6>
                        <div class="ps-3 border-start border-3 border-light small text-muted">
                            {{ $orderDetail->shipping_address }}
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-sm align-middle mb-4">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3">Sản phẩm</th>
                                <th class="text-center">Số lượng</th>
                                <th class="text-end">Đơn giá</th>
                                <th class="text-end pe-3">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orderItems as $item)
                            <tr>
                                <td class="ps-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="{{ asset('storage/uploads/books/'.$item->image) }}" class="book-thumb">
                                        <span class="fw-bold small">{{ $item->title }}</span>
                                    </div>
                                </td>
                                <td class="text-center">x{{ $item->quantity }}</td>
                                <td class="text-end">{{ number_format($item->price) }}đ</td>
                                <td class="text-end fw-bold pe-3">{{ number_format($item->price * $item->quantity) }}đ</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end fw-bold pt-4 border-0">Tổng giá trị đơn hàng:</td>
                                <td class="text-end text-danger fw-bold fs-4 pt-4 pe-3 border-0">{{ number_format($orderDetail->total_amount) }}đ</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                {{-- Form Cập nhật chuẩn --}}
                <div class="bg-light p-3 rounded border">
                    <form action="{{ route('admin.orders.update') }}" method="POST" class="d-flex align-items-center gap-3 flex-wrap">
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $orderDetail->order_id }}">
                        <input type="hidden" name="current_filter" value="{{ $statusFilter }}">
                        <span class="fw-bold text-muted small"><i class="bi bi-pencil-fill me-1"></i> THAY ĐỔI TRẠNG THÁI:</span>
                        <select name="new_status" class="form-select w-auto shadow-sm">
                            <option value="pending" {{ $orderDetail->status == 'pending' ? 'selected' : '' }}>Pending (Chờ duyệt)</option>
                            <option value="confirmed" {{ $orderDetail->status == 'confirmed' ? 'selected' : '' }}>Confirmed (Đã xác nhận)</option>
                            <option value="shipping" {{ $orderDetail->status == 'shipping' ? 'selected' : '' }}>Shipping (Đang giao)</option>
                            <option value="delivered" {{ $orderDetail->status == 'delivered' ? 'selected' : '' }}>Delivered (Đã giao)</option>
                            <option value="cancelled" {{ $orderDetail->status == 'cancelled' ? 'selected' : '' }}>Cancelled (Hủy đơn)</option>
                        </select>
                        <button type="submit" class="btn btn-primary px-4 shadow-sm border-0" style="background: var(--admin-teal)">
                            <i class="bi bi-check-circle-fill me-2"></i> Cập nhật ngay
                        </button>
                    </form>
                </div>
            </div>
            @else
            <div class="card detail-card p-5 text-center text-muted">
                <i class="bi bi-cursor display-1 opacity-25 mb-3"></i>
                <h5>Vui lòng chọn đơn hàng bên trái</h5>
                <p class="small">Chọn một đơn hàng để xem chi tiết và xử lý trạng thái.</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection