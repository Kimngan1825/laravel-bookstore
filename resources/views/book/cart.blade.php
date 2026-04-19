<x-book-layout title="Giỏ hàng">
    <style>
        .cart-container { max-width: 1000px; margin: 30px auto; padding: 0 15px; }
        .cart-title { text-align: center; color: #20B2AA; font-weight: bold; font-size: 24px; margin-bottom: 10px; }
        .cart-note { background-color: #f0f8f7; border-left: 4px solid #20B2AA; padding: 12px 15px; margin-bottom: 25px; font-size: 13px; color: #555; }
       
        .cart-table { width: 100%; border-collapse: collapse; margin-bottom: 25px; background: white; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
        .cart-table th { background-color: #f5f5f5; padding: 15px; text-align: left; font-weight: 600; font-size: 14px; border-bottom: 2px solid #e0e0e0; }
        .cart-table td { padding: 15px; border-bottom: 1px solid #f0f0f0; }
        .cart-table tr:hover { background-color: #fafafa; }
        .text-center { text-align: center; }
        .product-name { font-weight: 500; }
        
        .product-cell { display: flex; gap: 12px; align-items: center; }
        .product-img { width: 50px; height: 65px; object-fit: cover; border-radius: 4px; background: #f5f5f5; }
        
        .price-cell { color: #dc3545; font-weight: 600; }
        .total-cell { color: #dc3545; font-weight: 700; font-size: 15px; }
        
        .btn-delete { background-color: #dc3545; color: white; padding: 6px 12px; text-decoration: none; border-radius: 4px; display: inline-block; font-size: 12px; border: none; cursor: pointer; }
        .btn-delete:hover { background-color: #c82333; }
        
        .quantity-row { display: flex; gap: 5px; align-items: center; }
        .quantity-input { width: 60px; padding: 6px; border: 1px solid #ddd; border-radius: 4px; text-align: center; }
        .btn-update-qty { padding: 6px 12px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 12px; }
        .btn-update-qty:hover { background-color: #0056b3; }
        
        .total-section { text-align: right; font-size: 18px; font-weight: 700; color: #dc3545; margin: 30px 0 20px 0; padding-top: 20px; border-top: 2px solid #e0e0e0; }
        
        .action-buttons { display: flex; gap: 10px; justify-content: space-between; flex-wrap: wrap; margin-top: 30px; align-items: center; }
        .btn { padding: 12px 25px; border: none; border-radius: 4px; cursor: pointer; font-weight: 600; font-size: 14px; text-decoration: none; display: inline-block; transition: all 0.3s; }
        .btn-primary { background-color: #28a745; color: white; }
        .btn-primary:hover { background-color: #218838; }
        .btn-secondary { background-color: #e8a8b8; color: white; }
        .btn-secondary:hover { background-color: #d4858c; }
        .btn-warning { background-color: #ffc107; color: #333; }
        .btn-warning:hover { background-color: #e0a800; }
        .btn-info { background-color: #17a2b8; color: white; }
        .btn-info:hover { background-color: #138496; }
        
        .empty-cart { text-align: center; padding: 50px 20px; }
        .empty-cart-icon { font-size: 3rem; color: #ccc; margin-bottom: 15px; }
        
        .alert-success { background-color: #d4edda; color: #155724; padding: 12px; border-radius: 4px; margin-bottom: 20px; border: 1px solid #c3e6cb; }
        .alert-error { background-color: #f8d7da; color: #721c24; padding: 12px; border-radius: 4px; margin-bottom: 20px; border: 1px solid #f5c6cb; }
    </style>

    <div class="cart-container">
        @if(session('success'))
            <div class="alert-success">✓ {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert-error">✗ {{ session('error') }}</div>
        @endif

        <h2 class="cart-title">🛒 Giỏ hàng</h2>

        @if(empty($cart))
            <div class="empty-cart">
                <div class="empty-cart-icon">📦</div>
                <p style="font-size: 16px; color: #999; margin-bottom: 20px;">Giỏ hàng của bạn đang trống</p>
                <a href="/sach" class="btn btn-info">← Tiếp tục mua sắm</a>
            </div>
        @else
            <div class="cart-note">
                📌 Chọn sản phẩm và bấm "Cập nhật" để tính lại tiền trước khi thanh toán.
            </div>

            <form method="POST" action="{{ route('cart.index') }}" id="cartForm">
                @csrf
                
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th width="40">
                                <input type="checkbox" id="selectAll" style="cursor: pointer;" checked>
                            </th>
                            <th>Sách</th>
                            <th width="100" class="text-center">Giá</th>
                            <th width="140" class="text-center">Số lượng</th>
                            <th width="120" class="text-center">Thành tiền</th>
                            <th width="70" class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody id="cartItems">
                        @foreach($cart as $id => $item)
                            <tr data-product-id="{{ $id }}">
                                <td class="text-center">
                                    <input type="checkbox" name="selected_items[]" value="{{ $id }}" class="item-checkbox" style="cursor: pointer;" checked>
                                </td>
                                <td>
                                    <div class="product-cell">
                                        @if($item['hinh_anh'])
                                            <img src="{{ asset('book/' . $item['hinh_anh']) }}" alt="{{ $item['ten_sach'] }}" class="product-img">
                                        @else
                                            <div class="product-img" style="display: flex; align-items: center; justify-content: center;">
                                                <i class="bi bi-book" style="font-size: 24px; color: #ccc;"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <p class="product-name">{{ $item['ten_sach'] }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center price-cell">{{ number_format($item['gia_ban'], 0, ',', '.') }} ₫</td>
                                <td class="text-center">
                                    <div style="display: flex; gap: 5px; justify-content: center;">
                                        <input type="number" name="quantity[{{ $id }}]" min="1" value="{{ $item['so_luong'] }}" class="quantity-input" style="width: 60px;">
                                        <button type="submit" class="btn-update-qty" name="update_item" value="{{ $id }}" formnovalidate>
                                            Cập nhật
                                        </button>
                                    </div>
                                </td>
                                <td class="text-center item-total total-cell">
                                    {{ number_format($item['gia_ban'] * $item['so_luong'], 0, ',', '.') }} ₫
                                </td>
                                <td class="text-center">
                                    <button type="submit" class="btn-delete" name="remove_item" value="{{ $id }}" formnovalidate onclick="return confirm('Xác nhận xóa?')">
                                        ✕ Xóa
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="total-section">
                    Tổng tiền (tạm tính các món đã chọn): <span id="total">{{ number_format($total, 0, ',', '.') }}</span> ₫
                </div>

                <div class="action-buttons" style="justify-content: space-between;">
                    <div>
                        <button type="submit" class="btn btn-warning" name="update_all" value="1" formnovalidate>↻ Cập nhật giỏ hàng</button>
                        <button type="submit" class="btn btn-secondary" name="clear_cart" value="1" formnovalidate onclick="return confirm('Xác nhận xóa tất cả sản phẩm trong giỏ?')">🗑 Xóa hết</button>
                    </div>
                    <div>
                        <a href="/sach" class="btn btn-info">← Tiếp tục mua sắm</a>
                        <a href="{{ route('cart.checkout.page') }}" class="btn btn-primary">✓ Tiến hành thanh toán</a>
                    </div>
                </div>
            </form>
        @endif
    </div>

    @push('scripts')
    <script>
        // Select All checkbox
        document.getElementById('selectAll')?.addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.item-checkbox');
            checkboxes.forEach(cb => cb.checked = this.checked);
            calculateTotal();
        });

        // Calculate total price
        function calculateTotal() {
            let total = 0;
            document.querySelectorAll('tbody tr').forEach(row => {
                const checkbox = row.querySelector('.item-checkbox');
                if (checkbox.checked) {
                    const text = row.querySelector('.item-total').textContent.replace(/[^\d]/g, '');
                    total += parseInt(text) || 0;
                }
            });
            document.getElementById('total').textContent = total.toLocaleString('vi-VN');
        }

        // Update total when checkbox changes
        document.querySelectorAll('.item-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', calculateTotal);
        });

        calculateTotal();
    </script>
    @endpush
</x-book-layout>
