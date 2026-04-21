<x-book-layout>
    <x-slot name="title">Trang chủ - Cái tiệm bán sách</x-slot>

    <!-- KHỐI QUẢNG CÁO (HERO SECTION) -->
    <div class="row g-3 mb-5">
        <div class="col-md-8">
            <div id="homeCarousel" class="carousel slide shadow-sm rounded-3 overflow-hidden h-100" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="2"></button>
                </div>

                <div class="carousel-inner h-100">
                    <!-- Ảnh 1 -->
                    <div class="carousel-item active h-100" data-bs-interval="3000">
                        <img src="{{ asset('storage/uploads/banners/hero/h1.jpg') }}" class="d-block w-100 h-100" style="object-fit: cover;" alt="Banner 1">
                    </div>
                    <!-- Ảnh 2 -->
                    <div class="carousel-item h-100" data-bs-interval="3000">
                        <img src="{{ asset('storage/uploads/banners/hero/h2.jpg') }}" class="d-block w-100 h-100" style="object-fit: cover;" alt="Banner 2">
                    </div>
                    <!-- Ảnh 3 -->
                    <div class="carousel-item h-100" data-bs-interval="3000">
                        <img src="{{ asset('storage/uploads/banners/hero/h3.jpg') }}" class="d-block w-100 h-100" style="object-fit: cover;" alt="Banner 3">
                    </div>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#homeCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#homeCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </div>

        <!-- PHẦN BÊN PHẢI: 2 ẢNH TĨNH XẾP CHỒNG -->
        <div class="col-md-4 d-flex flex-column gap-3">
            <div class="banner-side shadow-sm rounded-3 overflow-hidden flex-fill">
                <img src="{{ asset('storage/uploads/banners/promo/p1.jpg') }}" class="w-100 h-100" style="object-fit: cover;" alt="Promo 1">
            </div>
            <div class="banner-side shadow-sm rounded-3 overflow-hidden flex-fill">
                <img src="{{ asset('storage/uploads/banners/side/s1.jpg') }}" class="w-100 h-100" style="object-fit: cover;" alt="Promo 2">
            </div>
        </div>
    </div>

        <!-- 1. DANH MỤC SẢN PHẨM (8 ô, chia 2 hàng) -->
    <div class="section-header mb-4">
        <h4 class="section-title title-category">Danh mục sản phẩm</h4>
    </div>
    <div class="row row-cols-2 row-cols-md-4 g-3 mb-5">
        @foreach($categories as $cat)
            <div class="col">
                <a href="{{ route('products.index', ['category' => $cat->category_id]) }}" class="cat-card-mini shadow-sm border rounded overflow-hidden text-decoration-none d-block">
                    <div class="cat-thumb position-relative">
                        <img src="{{ asset('storage/uploads/books/' . ($cat->book_image ?? 'no-image.png')) }}" alt="{{ $cat->category_name }}" class="w-100 h-100">
                        <div class="cat-title">{{ $cat->category_name }}</div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    <!-- 2. GIẢM GIÁ SỐC (Chỉ hiện 5 quyển) -->
    <div class="section-header mt-5">
        <h4 class="section-title title-flash">⚡ Giảm Giá Sốc</h4>
        <a href="{{ route('products.index', ['type' => 'flash']) }}" class="btn-see-more">Xem tất cả <i class="bi bi-chevron-right"></i></a>
    </div>
    <div class="row row-cols-2 row-cols-md-5 g-3 mb-5">
        @foreach($saleBooks->take(5) as $book)
            <div class="col">
                <x-productcard :book="$book" />
            </div>
        @endforeach
    </div>

    <!-- 3. BẢNG XẾP HẠNG TUẦN  -->
    <div class="section-header mt-5">
        <h4 class="section-title" style="color: #6610f2;">🏆 Bảng Xếp Hạng Tuần</h4>
        <a href="{{ route('products.index', ['type' => 'top']) }}" class="btn-see-more">Xem tất cả <i class="bi bi-chevron-right"></i></a>
    </div>
    <div class="row row-cols-2 row-cols-md-5 g-3 mb-5">
        @foreach($top5Books->take(5) as $index => $book)
            <div class="col">
                <a href="{{ route('book.detail', $book->book_id) }}" class="text-decoration-none text-dark">
                    <div class="product-card h-100 position-relative shadow-sm border rounded overflow-hidden">
                        {{-- Badge xếp hạng 1, 2, 3, 4, 5 --}}
                        @php $rank = $index + 1; @endphp
                        @php $rank = $index + 1; @endphp
                        <div class="badge-rank top-{{ $rank }}">{{ $rank }}</div>
                    
                    <div class="p-img-wrap" style="padding-top: 135%; position: relative;">
                        <img src="{{ asset('storage/uploads/books/'.$book->image) }}" class="w-100 h-100 position-absolute top-0 start-0" style="object-fit: cover;">
                    </div>
                    <div class="p-body p-2 text-center">
                        <div class="p-title small fw-bold text-truncate">{{ $book->title }}</div>
                        <div class="p-price text-danger fw-bold">{{ number_format($book->price) }}đ</div>
                        <div class="p-sold small text-muted"><i class="bi bi-fire text-danger"></i> Đã bán {{ $book->total_sold }}</div>
                    </div>
                </a>
                </div>
            </div>
        @endforeach
    </div>

    <!-- 4. SÁCH MỚI PHÁT HÀNH -->
    <div class="section-header mt-5">
        <h4 class="section-title title-new">✨ Sách Mới Phát Hành</h4>
        <a href="{{ route('products.index', ['type' => 'new']) }}" class="btn-see-more">Xem tất cả <i class="bi bi-chevron-right"></i></a>
    </div>
    <div class="row row-cols-2 row-cols-md-5 g-3 mb-5">
        @foreach($newBooks->take(5) as $book)
            <div class="col">
                <x-productcard :book="$book" :type="'new'" />
            </div>
        @endforeach
    </div>

    <!-- 5. GỢI Ý HÔM NAY -->
    <div class="section-header mt-5">
        <h4 class="section-title title-best">🔥 Gợi ý hôm nay</h4>
        <a href="{{ route('products.index', ['type' => 'today']) }}" class="btn-see-more">Xem tất cả <i class="bi bi-chevron-right"></i></a>
    </div>
    <div class="row row-cols-2 row-cols-md-5 g-3 mb-5">
        @foreach($bestSellers->take(5) as $book)
            <div class="col">
                <x-productcard :book="$book" />
            </div>
        @endforeach
    </div>

    <style>
        .section-title { font-weight: 800; text-transform: uppercase; font-size: 1.2rem; border-left: 5px solid #333; padding-left: 15px; margin: 0; }
        .title-category { color: #f7941e; border-left-color: #f7941e; }
        .title-flash { color: #dc3545; border-left-color: #dc3545; }
        .title-new { color: #20B2AA; border-left-color: #20B2AA; }
        .title-best { color: #F7941E; border-left-color: #F7941E; }
        
        .btn-see-more { font-size: 0.85rem; color: #807d7d; text-decoration: none; }
        .btn-see-more:hover { color: var(--mint); }

        .badge-rank { position: absolute; top: 0; left: 10px; width: 30px; height: 35px; color: #fff; font-weight: bold; text-align: center; line-height: 30px; clip-path: polygon(0 0, 100% 0, 100% 100%, 50% 80%, 0 100%); z-index: 10; }
        .top-1 { background: #FFD700; } .top-2 { background: #C0C0C0; } .top-3 { background: #CD7F32; } .top-4 { background: #8B4513; } .top-5   { background: #696969; }

        .cat-card-mini {
            display: block;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            background: #fff;
            border-color: transparent;
        }
        .cat-card-mini:hover {
            transform: translateY(-6px);
            box-shadow: 0 18px 45px rgba(0,0,0,0.08);
            text-decoration: none;
            border-color: #e6e6e6;
        }
        .cat-thumb {
            position: relative;
            aspect-ratio: 1 / 1;
            overflow: hidden;
            background: #f5f5f5;
        }
        .cat-thumb img {
            object-fit: cover;
            width: 100%;
            height: 100%;
            transition: transform 0.35s ease;
        }
        .cat-card-mini:hover .cat-thumb img {
            transform: scale(1.06);
        }
        .cat-title {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            padding: 0.85rem 0.9rem;
            background: rgba(255,255,255,0.92);
            color: #111;
            font-weight: 700;
            font-size: 0.95rem;
            text-shadow: none;
            border-top: 1px solid rgba(0,0,0,0.08);
        }
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 10px;
            margin-top: 40px;
            margin-bottom: 20px;
            width: 100%;
            font-style: bold;
        }
        .section-title {
            font-weight: 800;
            text-transform: uppercase;
            font-size: 1.2rem;
            margin: 0;
        }
        .title-flash { color: #dc3545; }
        .title-new { color: #20B2AA; }
        .title-best { color: #F7941E; }
        .carousel { min-height: 350px; }
        .banner-side { cursor: pointer; transition: transform 0.3s; }
        .banner-side:hover { transform: scale(1.02); }
        .rounded-3 { border-radius: 8px !important; }
    </style>
</x-book-layout>