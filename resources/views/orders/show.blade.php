<x-book-layout title="Chi tiết đơn hàng #{{ $order->order_id }}">
    <style>
        .order-status-badge { border-radius: 20px; padding: 5px 15px; font-size: 0.85rem; font-weight: bold; }
        .bg-pending { background: #fff3cd; color: #856404; }
        .bg-completed { background: #d4edda; color: #155724; }
        .bg-cancelled { background: #f8d7da; color: #721c24; }
        .card-custom { border: none; box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075); border-radius: 10px; }
        .table-items img { width: 60px; height: 80px; object-fit: cover; border-radius: 5px; }
    </style>

    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold">ĐƠN HÀNG #{{ $order->order_id }}</h4>
            <a href="{{ route('orderhistory') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left"></i> Quay lại danh sách
            </a>
        </div>

        <div class="row g-4">
            <!-- CỘT TRÁI: DANH SÁCH SẢN PHẨM -->
            <div class="col-lg-8">
                <div class="card card-custom mb-4">
                    <div class="card-header bg-white py-3">
                        <h6 class="mb-0 fw-bold"><i class="bi bi-box-seam me-2"></i>Sản phẩm đã đặt</h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0 table-items">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4">Sản phẩm</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th class="text-end pe-4">Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $item)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="{{ asset('storage/uploads/books/' . $item->image) }}" alt="">
                                                <div class="fw-bold small">{{ $item->title }}</div>
                                            </div>
                                        </td>
                                        <td>{{ number_format($item->price) }}đ</td>
                                        <td class="text-center">{{ $item->quantity }}</td>
                                        <td class="text-end pe-4 fw-bold">{{ number_format($item->price * $item->quantity) }}đ</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card card-custom">
                    <div class="card-header bg-white py-3">
                        <h6 class="mb-0 fw-bold"><i class="bi bi-info-circle me-2"></i>Ghi chú đơn hàng</h6>
                    </div>
                    <div class="card-body">
                        <p class="text-muted small mb-0">{{ $order->note ?? 'Không có ghi chú nào.' }}</p>
                    </div>
                </div>
            </div>

            <!-- CỘT PHẢI: THÔNG TIN GIAO HÀNG & TỔNG TIỀN -->
            <div class="col-lg-4">
                <!-- Trạng thái đơn hàng -->
                <div class="card card-custom mb-4 text-center py-3">
                    <div class="small text-muted mb-1">Trạng thái đơn hàng</div>
                    <div>
                        <span class="order-status-badge 
                            {{ $order->status == 'pending' ? 'bg-pending' : '' }}
                            {{ $order->status == 'completed' ? 'bg-completed' : '' }}
                            {{ $order->status == 'cancelled' ? 'bg-cancelled' : '' }}">
                            {{ strtoupper($order->status) }}
                        </span>
                    </div>
                    <div class="small text-muted mt-2">Ngày đặt: {{ date('d/m/Y H:i', strtotime($order->order_date)) }}</div>
                </div>

                <!-- Thông tin khách hàng -->
                <div class="card card-custom mb-4">
                    <div class="card-header bg-white py-3">
                        <h6 class="mb-0 fw-bold">Thông tin nhận hàng</h6>
                    </div>
                    <div class="card-body small">
                        <div class="mb-2"><strong>Người đặt:</strong> {{ $order->full_name }}</div>
                        <div class="mb-2"><strong>Email:</strong> {{ $order->email }}</div>
                        <div class="mb-2"><strong>Số điện thoại:</strong> {{ $order->user_phone }}</div>
                        
                        <hr>
                        <!-- Các thông tin địa chỉ này vẫn phải lấy từ bảng orders (nơi lưu lúc đặt hàng) -->
                        <div class="mb-2"><strong>Địa chỉ giao:</strong> {{ $order->address_line ?? 'Chưa cập nhật' }}</div>
                        <div class="mb-0"><strong>Thành phố:</strong> {{ $order->city ?? '' }}</div>
                    </div>
                </div>

                <!-- Tổng kết tiền -->
                <div class="card card-custom border-primary border-top border-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Tạm tính:</span>
                            <span>{{ number_format($order->total_amount) }}đ</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Phí vận chuyển:</span>
                            <span class="text-success">Miễn phí</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold">Tổng cộng:</span>
                            <h4 class="text-danger fw-bold mb-0">{{ number_format($order->total_amount) }}đ</h4>
                        </div>
                        <div class="mt-3 small text-center text-muted">
                            <i class="bi bi-wallet2 me-1"></i> Hình thức: {{ $order->payment_method }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-book-layout>