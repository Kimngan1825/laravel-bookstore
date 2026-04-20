<div class="product-card h-100 shadow-sm border rounded bg-white overflow-hidden">
    {{-- Khung chứa ảnh: Tỷ lệ 3:4 chuẩn cho bìa sách --}}
    <div class="p-img-wrap" style="position: relative; width: 100%; padding-top: 140%; background: #f9f9f9; overflow: hidden;">
        <img src="{{ asset('storage/uploads/books/' . ($book->image ?? 'no-image.png')) }}" 
             style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;" 
             alt="{{ $book->title }}">
        
        @if(isset($book->discount) && $book->discount > 0)
            <span class="badge bg-danger position-absolute top-0 end-0 m-2" style="z-index: 5;">
                -{{ $book->discount }}%
            </span>
        @endif
    </div>

    {{-- Phần thông tin bên dưới ảnh --}}
    <div class="p-body p-3 text-center border-top">
        <div class="small fw-bold text-truncate mb-1" title="{{ $book->title }}" style="display: block; width: 100%;">
            {{ $book->title }}
        </div>
        <div class="p-price text-danger fw-bold small">
            {{ number_format($book->price * (1 - ($book->discount ?? 0)/100), 0, ',', '.') }}đ
        </div>
    </div>
</div>