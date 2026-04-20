<x-book-layout>
    <x-slot name="title">{{ $title ?? 'Tất cả sách' }}</x-slot>

    <style>
        /* CSS GRID 4 CỘT CHO SÁCH */
        .books-grid { display: flex; flex-wrap: wrap; margin: 0 -10px; }
        .books-grid .book-item { width: 25%; padding: 10px; }
        
        @media (max-width: 992px) { .books-grid .book-item { width: 33.33%; } }
        @media (max-width: 768px) { .books-grid .book-item { width: 50%; } }

        /* ĐỊNH DẠNG PAGINATION */
        .pagination { display: flex; justify-content: center !important; padding-left: 0; list-style: none; margin: 30px 0 0; }
        .page-item { margin: 0 3px; }
        .page-link { display: block; padding: 0.5rem 0.75rem; color: #666; background-color: #fff; border: 1px solid #ddd; border-radius: 4px; }
        .page-link:hover { color: #c82333; border-color: #c82333; }
        .page-item.active .page-link { background-color: #c82333 !important; border-color: #c82333 !important; color: white !important; }
        .page-item.disabled .page-link { color: #999; pointer-events: none; background-color: #fff; border-color: #ddd; }
        
        /* PHẦN TIÊU ĐỀ HÀNG NGANG */
        .section-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
    </style>

    <x-slot name="sidebar">
        <div class="filter-sidebar bg-white p-3 border rounded shadow-sm">
            <h6 class="fw-bold mb-3"><i class="bi bi-funnel"></i> BỘ LỌC TÌM KIẾM</h6>
            <form action="{{ route('products.index') }}" method="GET">
                <div class="mb-3">
                    <label class="form-label small fw-bold text-secondary">DANH MỤC</label>
                    <select name="category" class="form-select form-select-sm">
                        <option value="">-- Tất cả --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->category_id }}">{{ $cat->category_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold text-secondary">TÁC GIẢ</label>
                    <input type="text" name="author" class="form-control form-control-sm" placeholder="Nhập tên tác giả...">
                </div>
                @if(request()->filled('type'))
                    <input type="hidden" name="type" value="{{ request('type') }}">
                @endif
                <div class="mb-3">
                    <label class="form-label small fw-bold text-secondary">KHOẢNG GIÁ</label>
                    
                    <!-- Hiển thị giá đã chọn -->
                    <div class="mb-2 p-2 bg-light rounded" style="border: 1px solid #ddd;">
                        <div class="text-danger fw-bold text-center" style="font-size: 0.95rem;">
                            <span id="priceDisplay">0 đ - 2,000,000 đ</span>
                        </div>
                    </div>

                    <!-- Range slider -->
                    <div class="mb-2">
                        <input type="range" id="priceRangeMin" name="price_min" class="form-range" min="0" max="2000000" value="0" step="10000">
                    </div>
                    <div class="mb-2">
                        <input type="range" id="priceRangeMax" name="price_max" class="form-range" min="0" max="2000000" value="2000000" step="10000">
                    </div>

                    <!-- Nhập giá trực tiếp -->
                    <div class="row g-2 mb-2">
                        <div class="col-6">
                            <input type="number" id="priceMinInput" class="form-control form-control-sm" placeholder="Giá tối thiểu" min="0" max="2000000" value="0">
                        </div>
                        <div class="col-6">
                            <input type="number" id="priceMaxInput" class="form-control form-control-sm" placeholder="Giá tối đa" min="0" max="2000000" value="2000000">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-danger btn-sm w-100 mb-2 fw-bold" style="background-color: #c82333;">Áp dụng bộ lọc</button>
                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-sm w-100 fw-bold">Xóa lọc</a>
            </form>
        </div>
    </x-slot>

    <div class="section-header">
        <h5 class="fw-bold m-0">{{ $title ?? 'Tất cả sách' }}</h5>
    </div>

    <div class="bg-white p-3 border rounded shadow-sm">
        <div class="books-grid">
            @foreach($books as $book)
                <div class="book-item">
                    <a href="{{ route('book.detail', $book->book_id) }}" class="text-decoration-none text-dark">
                    <div class="product-card h-100 shadow-sm border rounded bg-white overflow-hidden">
                        <div class="p-img-wrap" style="position: relative; padding-top: 135%; overflow: hidden; background: #f9f9f9;">
                            <img src="{{ asset('storage/uploads/books/' . ($book->image ?? 'no-image.png')) }}" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
                            @if(isset($book->discount) && $book->discount > 0)
                                <span class="badge bg-danger position-absolute top-0 end-0 m-2">-{{ $book->discount }}%</span>
                            @endif
                        </div>
                        <div class="p-body p-3 text-center">
                            <div class="small fw-bold text-truncate mb-2" title="{{ $book->title }}">{{ $book->title }}</div>
                            <div class="text-danger fw-bold mb-1">{{ number_format($book->price, 0, ',', '.') }} đ</div>
                            <div class="text-warning" style="font-size: 0.75rem;">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star"></i>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
            @endforeach
        </div>

        <!-- Pagination Links -->
        @if ($books->hasPages())
            <div class="d-flex justify-content-center mt-4">
                <nav aria-label="Pagination">
                    <ul class="pagination mb-0">
                        @if ($books->onFirstPage())
                            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $books->previousPageUrl() }}" rel="prev">&laquo;</a></li>
                        @endif

                        @foreach (range(1, $books->lastPage()) as $page)
                            <li class="page-item {{ $page == $books->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $books->url($page) }}">{{ $page }}</a>
                            </li>
                        @endforeach

                        @if ($books->hasMorePages())
                            <li class="page-item"><a class="page-link" href="{{ $books->nextPageUrl() }}" rel="next">&raquo;</a></li>
                        @else
                            <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                        @endif
                    </ul>
                </nav>
            </div>
        @endif
    </div>

    <!-- SCRIPTS HỖ TRỢ -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>

    <script>
        // Cập nhật hiển thị giá range
        function updatePriceDisplay() {
            const minPrice = parseInt(document.getElementById('priceRangeMin').value) || 0;
            const maxPrice = parseInt(document.getElementById('priceRangeMax').value) || 2000000;
            
            document.getElementById('priceDisplay').textContent = 
                new Intl.NumberFormat('vi-VN').format(minPrice) + ' đ - ' + 
                new Intl.NumberFormat('vi-VN').format(maxPrice) + ' đ';
            
            document.getElementById('priceMinInput').value = minPrice;
            document.getElementById('priceMaxInput').value = maxPrice;
        }

        // Sự kiện cho range slider
        document.getElementById('priceRangeMin').addEventListener('input', function() {
            const minVal = parseInt(this.value);
            const maxVal = parseInt(document.getElementById('priceRangeMax').value);
            if (minVal > maxVal) {
                this.value = maxVal;
            }
            updatePriceDisplay();
        });

        document.getElementById('priceRangeMax').addEventListener('input', function() {
            const maxVal = parseInt(this.value);
            const minVal = parseInt(document.getElementById('priceRangeMin').value);
            if (maxVal < minVal) {
                this.value = minVal;
            }
            updatePriceDisplay();
        });

        // Sự kiện cho nhập liệu trực tiếp
        document.getElementById('priceMinInput').addEventListener('change', function() {
            let val = parseInt(this.value) || 0;
            if (val < 0) val = 0;
            if (val > 2000000) val = 2000000;
            document.getElementById('priceRangeMin').value = val;
            updatePriceDisplay();
        });

        document.getElementById('priceMaxInput').addEventListener('change', function() {
            let val = parseInt(this.value) || 2000000;
            if (val > 2000000) val = 2000000;
            if (val < 0) val = 0;
            document.getElementById('priceRangeMax').value = val;
            updatePriceDisplay();
        });

        // Scroll to top khi chuyển trang
        $(document).on('click', '.pagination a', function() {
            setTimeout(function() {
                $('html, body').animate({
                    scrollTop: $('.books-grid').offset().top - 150
                }, 500);
            }, 100);
        });
    </script>
</x-book-layout>