<x-booklayout title="Lịch sử mua hàng - Bookstore">
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-mint">Lịch sử đơn hàng</h2>
            <a href="{{ route('sach.index') }}" class="btn btn-outline-primary btn-sm">
                <i class="bi bi-arrow-left me-1"></i> Tiếp tục mua hàng
            </a>
        </div>

        @if($orders->count() > 0)
            <div class="table-responsive shadow-sm rounded">
                <table class="table table-hover align-middle bg-white mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="py-3 px-4">Mã đơn</th>
                            <th class="py-3">Ngày đặt</th>
                            <th class="py-3">Tổng tiền</th>
                            <th class="py-3">Trạng thái</th>
                            <th class="py-3">Thanh toán</th>
                            <th class="py-3 text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td class="px-4 fw-bold">#{{ $order->order_id }}</td>
                            <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d/m/Y H:i') }}</td>
                            <td class="text-danger fw-bold">{{ number_format($order->total_amount) }}đ</td>
                            <td>
                                @php
                                    $statusClass = [
                                        'pending' => 'bg-warning',
                                        'completed' => 'bg-success',
                                        'cancelled' => 'bg-secondary'
                                    ][$order->status] ?? 'bg-info';
                                @endphp
                                <span class="badge {{ $statusClass }} rounded-pill px-3">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td><small class="text-muted">{{ $order->payment_method }}</small></td>
                            <td class="text-center">
                                <a href="{{ route('orders.show', $order->order_id) }}" class="btn btn-sm btn-light border">
                                    Chi tiết
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-5 bg-white shadow-sm rounded">
                <i class="bi bi-bag-x display-1 text-muted"></i>
                <p class="text-muted mt-3">Bạn chưa có đơn hàng nào.</p>
                <a href="{{ route('products.index') }}" class="btn btn-mint text-white px-4">Mua sắm ngay</a>
            </div>
        @endif
    </div>
</x-booklayout>