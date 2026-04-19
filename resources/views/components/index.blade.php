<x-book-layout>
    <x-slot name="title">Trang chủ Nhà Sách</x-slot>
    
    <div class="row g-4">
        @forelse($books as $book)
            <div class="col-md-3">
                <div class="card h-100 shadow-sm">
                    @if($book->image)
                        <img src="/book/{{ $book->image }}" class="card-img-top" alt="{{ $book->title }}" style="height: 250px; object-fit: cover;" onerror="this.src='/book/placeholder.jpg'">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 250px;">
                            <i class="bi bi-book fs-1 text-muted"></i>
                        </div>
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-truncate" title="{{ $book->title }}">{{ $book->title }}</h5>
                        <p class="card-text text-muted small">{{ $book->publisher ?? 'NXB không rõ' }}</p>
                        <p class="card-text flex-grow-1">
                            <span class="badge bg-info">{{ $book->language ?? 'Tiếng Việt' }}</span>
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="h5 mb-0 text-danger">{{ number_format($book->price, 0) }}₫</span>
                            <a href="{{ route('book.detail', $book->book_id) }}" class="btn btn-sm btn-outline-primary">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning text-center">
                    <i class="bi bi-exclamation-triangle"></i> Hiện chưa có sách nào
                </div>
            </div>
        @endforelse
    </div>
</x-book-layout>