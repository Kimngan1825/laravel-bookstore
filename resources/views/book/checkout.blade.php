<x-book-layout title="Thanh toán">
    <style>
        .checkout-wrap { max-width: 1120px; margin: 30px auto; }
        .page-title { color: #5f6d7a; font-size: 36px; font-weight: 700; margin-bottom: 18px; }
        .card-custom { border: 1px solid #e9ecef; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04); }
        .card-header-green { background: #1f8f55; color: #fff; font-weight: 700; }
        .label-muted { font-size: 14px; color: #6b7280; font-weight: 700; margin-bottom: 6px; }
        .summary-item { border-bottom: 1px solid #f0f0f0; padding: 12px 0; }
        .summary-item:last-child { border-bottom: 0; }
        .summary-total { font-size: 34px; font-weight: 800; color: #dc3545; }
        .coupon-box { border: 1px solid #d9dee3; border-radius: 8px; background: #fafbfc; }
        .coupon-hint { color: #198754; font-size: 13px; margin-top: 6px; }

        @media (max-width: 992px) {
            .page-title { font-size: 30px; }
        }
    </style>

    <div class="container checkout-wrap">
        <h4 class="page-title"><i class="bi bi-credit-card"></i> Xác nhận thanh toán</h4>

        @if(session('error'))
            <div class="alert alert-danger">✗ {{ session('error') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <div>• {{ $error }}</div>
                @endforeach
            </div>
        @endif

        <div class="row g-3">
            <div class="col-lg-7">
                <div class="card card-custom border-0">
                    <div class="card-header card-header-green"><i class="bi bi-truck"></i> Thông tin giao hàng</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('cart.checkout') }}" id="orderForm">
                            @csrf

                            @if(isset($savedAddresses) && count($savedAddresses) > 0)
                                <div class="mb-3 border-bottom pb-3">
                                    <label class="label-muted text-success"><i class="bi bi-bookmark-star-fill"></i> Sổ địa chỉ</label>
                                    <div class="list-group">
                                        @foreach($savedAddresses as $addr)
                                            <label class="list-group-item list-group-item-action">
                                                <input
                                                    class="form-check-input me-2 address-radio"
                                                    type="radio"
                                                    name="selected_address"
                                                    onclick="fillAddress(this)"
                                                    data-name="{{ $addr->full_name }}"
                                                    data-phone="{{ $addr->phone }}"
                                                    data-addr="{{ $addr->address_line }}"
                                                    data-city="{{ $addr->city }}"
                                                >
                                                <span class="small">
                                                    <strong>{{ $addr->full_name }}</strong>
                                                    - {{ $addr->phone }}
                                                    <span class="text-muted">| {{ $addr->address_line }}, {{ $addr->city }}</span>
                                                </span>
                                            </label>
                                        @endforeach

                                        <label class="list-group-item list-group-item-action">
                                            <input class="form-check-input me-2 address-radio" type="radio" name="selected_address" onclick="resetFormAddress()" checked>
                                            <span class="small fw-bold text-primary">Nhập địa chỉ mới</span>
                                        </label>
                                    </div>
                                </div>
                            @endif

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="label-muted">Họ tên <span class="text-danger">*</span></label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="inpName"
                                        name="full_name"
                                        value="{{ old('full_name', $user->full_name ?? '') }}"
                                        required
                                    >
                                </div>
                                <div class="col-md-6">
                                    <label class="label-muted">SĐT <span class="text-danger">*</span></label>
                                    <input
                                        type="tel"
                                        class="form-control"
                                        id="inpPhone"
                                        name="phone"
                                        value="{{ old('phone', $user->phone ?? '') }}"
                                        required
                                    >
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="label-muted">Địa chỉ <span class="text-danger">*</span></label>
                                <textarea class="form-control" rows="2" id="inpAddr" name="address_line" required>{{ old('address_line') }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label class="label-muted">Tỉnh / Thành <span class="text-danger">*</span></label>
                                <select class="form-select" id="inpCity" name="city" required>
                                    <option value="">-- Chọn --</option>
                                    @foreach($cities as $city)
                                        <option value="{{ $city }}" {{ old('city') === $city ? 'selected' : '' }}>{{ $city }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4 form-check" id="saveAddrBox">
                                <input class="form-check-input" type="checkbox" name="save_new_address" value="1" id="saveCheck" {{ old('save_new_address') ? 'checked' : '' }}>
                                <label class="form-check-label small" for="saveCheck">Lưu vào sổ địa chỉ để dùng lần sau</label>
                            </div>

                            <div class="mb-4">
                                <label class="label-muted">Thanh toán <span class="text-danger">*</span></label>
                                <select name="payment_method" class="form-select" required>
                                    <option value="COD" {{ old('payment_method') === 'COD' ? 'selected' : '' }}>Thanh toán khi nhận hàng (COD)</option>
                                    <option value="BANK_TRANSFER" {{ old('payment_method') === 'BANK_TRANSFER' ? 'selected' : '' }}>Chuyển khoản ngân hàng</option>
                                    <option value="E_WALLET" {{ old('payment_method') === 'E_WALLET' ? 'selected' : '' }}>Ví điện tử</option>
                                </select>
                            </div>

                            <input type="hidden" name="coupon_code" id="orderCouponCode" value="{{ old('coupon_code', $couponInput ?? '') }}">
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card card-custom border-0 mb-3">
                    <div class="card-body">
                        <label class="fw-bold small mb-2"><i class="bi bi-ticket-perforated"></i> Mã ưu đãi</label>
                        <div class="coupon-box p-3">
                            <form method="POST" action="{{ route('coupon.apply') }}" class="d-flex gap-2 mb-2">
                                @csrf
                                <input
                                    type="text"
                                    class="form-control"
                                    id="couponInput"
                                    name="coupon_code"
                                    value="{{ old('coupon_code', $couponInput ?? '') }}"
                                    placeholder="Nhập mã (VD: SALE50)"
                                >
                                <button type="submit" class="btn btn-outline-success">Áp dụng</button>
                            </form>

                            @if(!empty($appliedCoupon))
                                <div class="d-flex justify-content-between align-items-center small mt-2">
                                    <span class="text-success fw-bold">Đã áp dụng: {{ $appliedCoupon->code }}</span>
                                    <form method="POST" action="{{ route('coupon.remove') }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link btn-sm p-0 text-danger text-decoration-none">Hủy mã</button>
                                    </form>
                                </div>
                            @endif

                            <div class="coupon-hint">Bấm Áp dụng để kiểm tra mã trước, hệ thống vẫn kiểm tra lại khi Đặt hàng.</div>
                        </div>
                    </div>
                </div>

                <div class="card card-custom border-0 sticky-top" style="top: 20px;">
                    <div class="card-header bg-light fw-bold">Đơn hàng của bạn</div>
                    <div class="card-body">
                        @foreach($cart as $item)
                            <div class="summary-item d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="fw-bold small">{{ $item['ten_sach'] }}</div>
                                    <small class="text-muted">x {{ $item['so_luong'] }}</small>
                                </div>
                                <span class="small">{{ number_format($item['gia_ban'] * $item['so_luong'], 0, ',', '.') }} đ</span>
                            </div>
                        @endforeach

                        <div class="mt-3">
                            <div class="d-flex justify-content-between small text-muted mb-1">
                                <span>Tạm tính:</span>
                                <span>{{ number_format($subtotal, 0, ',', '.') }} đ</span>
                            </div>
                            <div class="d-flex justify-content-between small text-success fw-bold mb-1">
                                <span>Giảm giá:</span>
                                @if(($discountPreview ?? 0) > 0)
                                    <span>- {{ number_format($discountPreview, 0, ',', '.') }} đ</span>
                                @else
                                    <span>- chưa áp dụng</span>
                                @endif
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <span class="fw-bold fs-5">Tổng cộng:</span>
                                <span class="summary-total">{{ number_format($totalPreview ?? $subtotal, 0, ',', '.') }} đ</span>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success w-100 mt-3 fw-bold" form="orderForm">ĐẶT HÀNG NGAY</button>
                        <a href="{{ route('cart.index') }}" class="btn btn-link w-100 text-decoration-none mt-2">Quay lại giỏ hàng</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Khởi tạo dữ liệu form ban đầu từ Laravel
            const oldFormData = {
                name: {!! json_encode(old('full_name', $user->full_name ?? '')) !!},
                phone: {!! json_encode(old('phone', $user->phone ?? '')) !!},
                addr: {!! json_encode(old('address_line', '')) !!},
                city: {!! json_encode(old('city', '')) !!}
            };

            function fillAddress(el) {
                document.getElementById('inpName').value = el.dataset.name || '';
                document.getElementById('inpPhone').value = el.dataset.phone || '';
                document.getElementById('inpAddr').value = el.dataset.addr || '';
                document.getElementById('inpCity').value = el.dataset.city || '';

                const saveBox = document.getElementById('saveAddrBox');
                if (saveBox) {
                    saveBox.style.display = 'none';
                }
            }

            function resetFormAddress() {
                document.getElementById('inpName').value = oldFormData.name;
                document.getElementById('inpPhone').value = oldFormData.phone;
                document.getElementById('inpAddr').value = oldFormData.addr;
                document.getElementById('inpCity').value = oldFormData.city;

                const saveBox = document.getElementById('saveAddrBox');
                if (saveBox) saveBox.style.display = 'block';
            }

            (function syncCouponCode() {
                const couponInput = document.getElementById('couponInput');
                const orderCouponCode = document.getElementById('orderCouponCode');

                if (!couponInput || !orderCouponCode) {
                    return;
                }

                const updateHiddenCoupon = function () {
                    orderCouponCode.value = couponInput.value;
                };

                updateHiddenCoupon();
                couponInput.addEventListener('input', updateHiddenCoupon);
            })();
        </script>
    @endpush
</x-book-layout>
