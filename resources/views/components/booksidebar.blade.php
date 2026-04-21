<div class="filter-sidebar bg-white p-3 border rounded shadow-sm">
    <h6 class="fw-bold mb-3"><i class="bi bi-funnel"></i> BỘ LỌC TÌM KIẾM</h6>
    <form action="{{ route('products.index') }}" method="GET">
        <!-- DANH MỤC -->
        <div class="mb-3">
            <label class="form-label small fw-bold text-secondary">DANH MỤC</label>
            <select name="category" class="form-select form-select-sm">
                <option value="">-- Tất cả --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->category_id }}" {{ request('category') == $cat->category_id ? 'selected' : '' }}>
                        {{ $cat->category_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- TÁC GIẢ -->
        <div class="mb-3">
            <label class="form-label small fw-bold text-secondary">TÁC GIẢ</label>
            <input type="text" name="author" value="{{ request('author') }}" class="form-control form-control-sm" placeholder="Nhập tên tác giả...">
        </div>

        @if(request()->filled('type'))
            <input type="hidden" name="type" value="{{ request('type') }}">
        @endif

        <!-- KHOẢNG GIÁ (Range Slider) -->
        <div class="mb-3">
            <label class="form-label small fw-bold text-secondary">KHOẢNG GIÁ</label>
            <div class="mb-2 p-2 bg-light rounded" style="border: 1px solid #ddd;">
                <div class="text-danger fw-bold text-center" style="font-size: 0.95rem;">
                    <span id="priceDisplay">
                        {{ number_format(request('price_min', 0)) }} đ - {{ number_format(request('price_max', 2000000)) }} đ
                    </span>
                </div>
            </div>

            <div class="mb-2">
                <input type="range" id="priceRangeMin" name="price_min" class="form-range" min="0" max="2000000" value="{{ request('price_min', 0) }}" step="10000">
            </div>
            <div class="mb-2">
                <input type="range" id="priceRangeMax" name="price_max" class="form-range" min="0" max="2000000" value="{{ request('price_max', 2000000) }}" step="10000">
            </div>

            <div class="row g-2 mb-2">
                <div class="col-6">
                    <input type="number" id="priceMinInput" class="form-control form-control-sm" placeholder="Min" value="{{ request('price_min', 0) }}">
                </div>
                <div class="col-6">
                    <input type="number" id="priceMaxInput" class="form-control form-control-sm" placeholder="Max" value="{{ request('price_max', 2000000) }}">
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-danger btn-sm w-100 mb-2 fw-bold" style="background-color: #c82333;">Áp dụng bộ lọc</button>
        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-sm w-100 fw-bold">Xóa lọc</a>
    </form>
</div>