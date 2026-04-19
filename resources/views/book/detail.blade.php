<x-book-layout :title="$book->title">
<style>
    .detail-shell { max-width: 1200px; }
    .crumb-wrap { background: #f1f3f5; border-radius: 4px; padding: 10px 14px; font-weight: 600; font-size: 15px; color: #5d6775; }
    .crumb-wrap a { text-decoration: none; color: #4e5a67; }
    .product-panel { background: #fff; border: 1px solid #eceff3; border-radius: 8px; }
    .product-media { padding: 16px; border-right: 1px solid #edf0f3; }
    .book-cover-box { background: #fafbfc; border: 1px solid #eceff3; border-radius: 6px; padding: 16px; min-height: 430px; display: flex; align-items: center; justify-content: center; }
    .book-cover { width: 100%; max-width: 300px; height: 420px; object-fit: contain; }
    .cta-row { margin-top: 14px; display: grid; grid-template-columns: 1fr 1.3fr; gap: 10px; }
    .btn-cart { border: 1px solid #e34d5f; color: #e34d5f; background: #fff; font-weight: 700; }
    .btn-cart:hover { background: #fff0f2; color: #d83a4f; }
    .btn-buy { background: #e6394d; color: #fff; font-weight: 700; border: none; }
    .btn-buy:hover { background: #d72e43; color: #fff; }
    .product-main { padding: 20px; }
    .book-title { font-size: 44px; font-weight: 800; color: #1e2630; margin-bottom: 8px; line-height: 1.15; }
    .meta-line { color: #717f8d; margin-bottom: 10px; }
    .meta-line .em { color: #3477f2; font-weight: 700; }
    .rating-inline { display: flex; align-items: center; gap: 8px; color: #ffbf00; margin-bottom: 8px; }
    .price-text { color: #e6394d; font-size: 52px; font-weight: 800; margin: 12px 0 10px 0; }
    .qty-wrap { display: flex; align-items: center; gap: 14px; margin-bottom: 16px; flex-wrap: wrap; }
    .qty-label { font-size: 18px; font-weight: 700; color: #1f2a35; }
    .qty-box {
        display: inline-flex;
        align-items: center;
        border: 1px solid #d3dbe5;
        border-radius: 10px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 2px 8px rgba(15, 23, 42, 0.06);
    }
    .qty-btn {
        width: 44px;
        height: 44px;
        border: none;
        background: #f4f7fb;
        color: #374556;
        font-size: 24px;
        font-weight: 700;
        line-height: 1;
        transition: background-color 0.15s ease, color 0.15s ease;
    }
    .qty-btn:hover { background: #e8eef6; color: #1f2a35; }
    .qty-btn:active { background: #dde7f3; }
    .qty-input {
        width: 64px;
        height: 44px;
        border: none;
        border-left: 1px solid #d3dbe5;
        border-right: 1px solid #d3dbe5;
        text-align: center;
        font-size: 24px;
        font-weight: 700;
        color: #1f2a35;
        background: #fff;
        -moz-appearance: textfield;
    }
    .qty-input:focus { outline: none; background: #fcfdff; }
    .qty-input::-webkit-outer-spin-button,
    .qty-input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    .stock-hint { color: #7a8795; font-size: 15px; margin-left: 6px; }
    .spec-title { font-size: 36px; font-weight: 800; margin-top: 10px; margin-bottom: 10px; color: #1f2a35; }
    .spec-table th, .spec-table td { padding: 10px 12px; border: 1px solid #e6eaee; }
    .spec-table th { background: #f2f4f6; width: 30%; color: #2e3a47; }
    .review-block { margin-top: 16px; border-top: 1px solid #e6eaee; padding-top: 18px; }
    .review-title { font-size: 34px; font-weight: 800; margin-bottom: 8px; }
    .review-overview { border: 1px solid #e8ecef; border-radius: 8px; padding: 18px; }
    .avg-score { font-size: 76px; line-height: 1; font-weight: 800; color: #e6394d; text-align: center; }
    .star-row { color: #ffbf00; font-size: 28px; text-align: center; }
    .mini-muted { color: #8a96a3; text-align: center; }
    .bar-row { display: grid; grid-template-columns: 60px 1fr 50px; gap: 10px; align-items: center; margin-bottom: 6px; font-weight: 600; color: #5f6a78; }
    .bar-track { height: 8px; background: #eceff3; border-radius: 8px; overflow: hidden; }
    .bar-fill { height: 100%; background: #e6394d; }
    .review-form { margin-top: 22px; padding-top: 18px; border-top: 1px solid #e8ecef; }
    .review-item { border-top: 1px solid #e8ecef; padding: 18px 0; }
    .related-block { margin-top: 22px; border-top: 1px solid #e8ecef; padding-top: 18px; }
    .related-title { font-size: 44px; font-weight: 800; margin-bottom: 12px; }
    .related-card { position: relative; background: #fff; border: 1px solid #eceff3; border-radius: 8px; overflow: hidden; height: 100%; }
    .off-badge { position: absolute; top: 8px; right: 8px; background: #db2f3f; color: #fff; font-size: 12px; font-weight: 700; border-radius: 4px; padding: 2px 8px; z-index: 2; }
    .related-img { width: 100%; height: 240px; object-fit: contain; background: #fbfcfd; }
    .related-body { padding: 10px 12px 14px; }
    .related-name { font-size: 15px; font-weight: 700; color: #27313d; min-height: 42px; }
    .related-price { font-size: 22px; font-weight: 800; color: #e6394d; margin-top: 4px; }
    .cart-toast-wrap { position: fixed; top: 90px; right: 18px; z-index: 1200; display: flex; flex-direction: column; gap: 10px; max-width: 360px; }
    .cart-toast { border-radius: 10px; box-shadow: 0 10px 28px rgba(0, 0, 0, 0.15); color: #fff; padding: 12px 14px; font-weight: 600; display: flex; align-items: flex-start; gap: 9px; animation: toastIn .2s ease-out; }
    .cart-toast-success { background: linear-gradient(135deg, #11a36a, #0b8154); }
    .cart-toast-error { background: linear-gradient(135deg, #de4257, #c72f43); }
    .cart-toast i { margin-top: 1px; }

    @keyframes toastIn {
        from { opacity: 0; transform: translateY(-6px) scale(0.98); }
        to { opacity: 1; transform: translateY(0) scale(1); }
    }

    @media (max-width: 992px) {
        .product-media { border-right: none; border-bottom: 1px solid #edf0f3; }
        .book-title { font-size: 34px; }
        .price-text { font-size: 40px; }
        .spec-title, .review-title, .related-title { font-size: 30px; }
    }
</style>

@php
    $reviewCount = $reviews->count();
    $avgRating = $reviewCount > 0 ? round($reviews->avg('rating'), 1) : 0;
    $ratingStats = [];
    for ($i = 5; $i >= 1; $i--) {
        $count = $reviews->where('rating', $i)->count();
        $percent = $reviewCount > 0 ? round(($count * 100) / $reviewCount) : 0;
        $ratingStats[$i] = ['count' => $count, 'percent' => $percent];
    }
    $soldCount = $book->sold_count ?? 0;
@endphp

<div class="container detail-shell py-3 py-lg-4">
    <div id="cartToastWrap" class="cart-toast-wrap" aria-live="polite" aria-atomic="true"></div>

    <div class="crumb-wrap mb-3 text-uppercase">
        <a href="/">Trang chủ</a> &nbsp;/&nbsp;
        <a href="/sach">Sách</a> &nbsp;/&nbsp;
        <span>{{ $book->category_name ?? 'Chi tiết sách' }}</span> &nbsp;/&nbsp;
        <span>{{ $book->title }}</span>
    </div>

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="product-panel">
        <div class="row g-0">
            <div class="col-lg-4 product-media">
                <div class="book-cover-box">
                    @if($book->image)
                        <img src="{{ asset('book/' . $book->image) }}" alt="{{ $book->title }}" class="book-cover">
                    @else
                        <div class="text-muted">Không có ảnh</div>
                    @endif
                </div>

                @if($book->stock > 0)
                    <div class="cta-row">
                        <button type="button" class="btn btn-cart" id="btnAddToCartOnly">
                            <i class="bi bi-cart-plus"></i> Thêm giỏ
                        </button>
                        <button type="button" class="btn btn-buy" id="btnBuyNow">
                            Mua ngay
                        </button>
                    </div>
                @else
                    <div class="alert alert-danger mt-3 mb-0">Sản phẩm hiện đã hết hàng</div>
                @endif
            </div>

            <div class="col-lg-8 product-main">
                <h1 class="book-title">{{ $book->title }}</h1>

                <div class="meta-line">
                    Nhà cung cấp: <span class="em">{{ $book->supplier ?: 'N/A' }}</span>
                    &nbsp;&nbsp; Tác giả: <strong>{{ $book->author_name ?? 'N/A' }}</strong>
                    &nbsp;&nbsp; NXB: <strong>{{ $book->publisher ?? 'N/A' }}</strong>
                </div>

                <div class="rating-inline">
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= floor($avgRating))
                            <i class="bi bi-star-fill"></i>
                        @else
                            <i class="bi bi-star"></i>
                        @endif
                    @endfor
                    <span class="text-muted">({{ $reviewCount }} đánh giá)</span>
                    <span class="text-muted">| Đã bán {{ $soldCount }}</span>
                </div>

                <div class="price-text">{{ number_format($book->price, 0, ',', '.') }} đ</div>

                @if($book->stock > 0)
                    <form action="{{ route('book.addToCart', $book->book_id) }}" method="POST" id="addToCartForm">
                        @csrf
                        <div class="qty-wrap">
                            <span class="qty-label">Số lượng:</span>
                            <div class="qty-box">
                                <button type="button" class="qty-btn" id="qtyMinus">-</button>
                                <input id="quantity" name="quantity" type="number" min="1" max="{{ $book->stock }}" value="1" class="qty-input">
                                <button type="button" class="qty-btn" id="qtyPlus">+</button>
                            </div>
                            <div class="stock-hint">{{ $book->stock }} sản phẩm có sẵn</div>
                        </div>
                    </form>
                @endif

                <hr>
                <h3 class="spec-title">Thông tin chi tiết</h3>
                <table class="table spec-table mb-0">
                    <tr>
                        <th>Mã hàng</th>
                        <td>{{ $book->isbn ?: '---' }}</td>
                    </tr>
                    <tr>
                        <th>Tên Nhà Cung Cấp</th>
                        <td class="fw-bold text-primary">{{ $book->supplier ?: 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Tác giả</th>
                        <td>{{ $book->author_name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>NXB</th>
                        <td>{{ $book->publisher ?: 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Năm XB</th>
                        <td>{{ $book->publication_year ?: 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Hình thức</th>
                        <td>{{ $book->cover_type ?: 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Ngôn ngữ</th>
                        <td>{{ $book->language ?: 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Trọng lượng</th>
                        <td>{{ $book->weight ? $book->weight . ' gram' : 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Kích thước</th>
                        <td>{{ $book->size ?: 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Số trang</th>
                        <td>{{ $book->page_count ?: 'N/A' }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="review-block px-3 px-lg-4 pb-3 pb-lg-4">
            <h3 class="review-title">Đánh giá sản phẩm</h3>

            <div class="review-overview mb-4">
                <div class="row align-items-center">
                    <div class="col-lg-4 mb-3 mb-lg-0">
                        <div class="avg-score">{{ number_format($avgRating, 1) }}/5</div>
                        <div class="star-row">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= floor($avgRating))
                                    <i class="bi bi-star-fill"></i>
                                @else
                                    <i class="bi bi-star"></i>
                                @endif
                            @endfor
                        </div>
                        <div class="mini-muted">({{ $reviewCount }} đánh giá)</div>
                    </div>
                    <div class="col-lg-8">
                        @for($star = 5; $star >= 1; $star--)
                            <div class="bar-row">
                                <span>{{ $star }} sao</span>
                                <div class="bar-track">
                                    <div class="bar-fill" style="width: {{ $ratingStats[$star]['percent'] }}%;"></div>
                                </div>
                                <span>{{ $ratingStats[$star]['percent'] }}%</span>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>

            <div class="review-form mb-3">
                <h5 class="fw-bold mb-2">Viết đánh giá của bạn</h5>
                <div class="text-muted mb-2">Chọn mức độ hài lòng:</div>
                <div class="d-flex flex-wrap gap-3 mb-2">
                    <label><input type="radio" name="rating_demo" value="5" checked> 5 sao (Tuyệt vời)</label>
                    <label><input type="radio" name="rating_demo" value="4"> 4 sao (Hài lòng)</label>
                    <label><input type="radio" name="rating_demo" value="3"> 3 sao (Bình thường)</label>
                    <label><input type="radio" name="rating_demo" value="2"> 2 sao (Tệ)</label>
                    <label><input type="radio" name="rating_demo" value="1"> 1 sao (Rất tệ)</label>
                </div>
                <textarea class="form-control" rows="3" placeholder="Chia sẻ cảm nhận của bạn về sản phẩm này..."></textarea>
                <button type="button" class="btn btn-danger mt-3">Gửi đánh giá</button>
            </div>

            @forelse($reviews as $review)
                <div class="review-item">
                    <div class="d-flex justify-content-between align-items-start">
                        <h5 class="fw-bold mb-1">{{ $review->full_name }}</h5>
                        <span class="text-muted">{{ \Carbon\Carbon::parse($review->created_at)->format('d/m/Y') }}</span>
                    </div>
                    <div class="text-warning mb-2">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= (int)$review->rating)
                                <i class="bi bi-star-fill"></i>
                            @else
                                <i class="bi bi-star"></i>
                            @endif
                        @endfor
                    </div>
                    <div class="text-muted">{{ $review->comment }}</div>
                </div>
            @empty
                <div class="text-muted">Sản phẩm này chưa có đánh giá nào.</div>
            @endforelse

            @if($relatedBooks->count() > 0)
                <div class="related-block">
                    <h3 class="related-title">SẢN PHẨM LIÊN QUAN</h3>
                    <div class="row g-3">
                        @foreach($relatedBooks as $relatedBook)
                            <div class="col-6 col-lg-3">
                                <a href="{{ route('book.detail', $relatedBook->book_id) }}" class="text-decoration-none">
                                    <div class="related-card">
                                        @if(($relatedBook->discount ?? 0) > 0)
                                            <span class="off-badge">-{{ $relatedBook->discount }}%</span>
                                        @endif
                                        @if($relatedBook->image)
                                            <img src="{{ asset('book/' . $relatedBook->image) }}" alt="{{ $relatedBook->title }}" class="related-img">
                                        @else
                                            <div class="related-img d-flex align-items-center justify-content-center text-muted">Không có ảnh</div>
                                        @endif
                                        <div class="related-body">
                                            <div class="related-name">{{ $relatedBook->title }}</div>
                                            <div class="related-price">{{ number_format($relatedBook->price, 0, ',', '.') }} đ</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
    const qtyInput = document.getElementById('quantity');
    const minusBtn = document.getElementById('qtyMinus');
    const plusBtn = document.getElementById('qtyPlus');
    const addBtn = document.getElementById('btnAddToCartOnly');
    const buyNowBtn = document.getElementById('btnBuyNow');
    const addToCartForm = document.getElementById('addToCartForm');
    const cartToastWrap = document.getElementById('cartToastWrap');

    const showCartToast = (message, type = 'success') => {
        if (!cartToastWrap) return;

        const toast = document.createElement('div');
        toast.className = 'cart-toast ' + (type === 'error' ? 'cart-toast-error' : 'cart-toast-success');
        toast.innerHTML =
            '<i class="bi ' + (type === 'error' ? 'bi-exclamation-triangle-fill' : 'bi-check-circle-fill') + '"></i>' +
            '<div>' + message + '</div>';

        cartToastWrap.appendChild(toast);
        setTimeout(() => {
            toast.style.opacity = '0';
            toast.style.transform = 'translateY(-6px)';
            setTimeout(() => toast.remove(), 220);
        }, 2600);
    };

    const clampQty = () => {
        if (!qtyInput) return 1;
        const min = parseInt(qtyInput.min || '1', 10);
        const max = parseInt(qtyInput.max || '9999', 10);
        let current = parseInt(qtyInput.value || '1', 10);
        if (Number.isNaN(current)) current = min;
        current = Math.max(min, Math.min(max, current));
        qtyInput.value = current;
        return current;
    };

    minusBtn?.addEventListener('click', () => {
        const current = clampQty();
        qtyInput.value = Math.max(parseInt(qtyInput.min || '1', 10), current - 1);
    });

    plusBtn?.addEventListener('click', () => {
        const current = clampQty();
        qtyInput.value = Math.min(parseInt(qtyInput.max || '9999', 10), current + 1);
    });

    qtyInput?.addEventListener('change', clampQty);

    const submitAddToCart = (redirectCheckout = false) => {
        if (!addToCartForm) return;
        const quantity = clampQty();
        if (quantity < 1) {
            showCartToast('Số lượng phải lớn hơn 0', 'error');
            qtyInput?.focus();
            return;
        }

        const formData = new FormData(addToCartForm);
        const actionBtn = redirectCheckout ? buyNowBtn : addBtn;
        const originalText = actionBtn ? actionBtn.innerHTML : '';

        if (actionBtn) {
            actionBtn.disabled = true;
            actionBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Đang xử lý...';
        }

        fetch(addToCartForm.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'Accept': 'application/json'
            },
            body: formData
        })
            .then(async response => {
                let data = {};
                try {
                    data = await response.json();
                } catch (e) {
                    data = {};
                }

                if (!response.ok || data.success === false) {
                    throw new Error(data.message || data.error || 'Không thể thêm sản phẩm vào giỏ hàng');
                }

                return data;
            })
            .then(() => {
                showCartToast('Đã thêm ' + quantity + ' sản phẩm vào giỏ hàng', 'success');

                if (redirectCheckout) {
                    window.location.href = '{{ route('cart.checkout.page') }}';
                    return;
                }

                qtyInput.value = 1;
            })
            .catch(error => {
                showCartToast(error.message, 'error');
            })
            .finally(() => {
                if (actionBtn) {
                    actionBtn.disabled = false;
                    actionBtn.innerHTML = originalText;
                }
            });
    };

    addBtn?.addEventListener('click', () => submitAddToCart(false));
    buyNowBtn?.addEventListener('click', () => submitAddToCart(true));
</script>
@endpush
</x-book-layout>
