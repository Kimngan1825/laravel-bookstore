<x-book-layout>
    <x-slot name="title">Trang chủ Nhà Sách</x-slot>

    <div class="container my-4">
        <h2 class="mb-4">Danh sách sách</h2>

        <div class="row">
            @forelse($books as $book)
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('storage/' . $book->file_image) }}" class="card-img-top" alt="{{ $book->title }}" style="height: 200px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $book->title }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($book->description, 100) }}</p>
                        <p class="card-text fw-bold text-danger">{{ number_format($book->price) }}đ</p>
                        <div class="mt-auto">
                            <button class="btn btn-outline-danger favorite-btn" data-book-id="{{ $book->book_id }}">
                                <i class="bi bi-heart"></i> Yêu thích
                            </button>
                            <a href="#" class="btn btn-primary">Thêm vào giỏ</a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <p class="text-center">Không có sách nào.</p>
            @endforelse
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const favoriteBtns = document.querySelectorAll('.favorite-btn');

            favoriteBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const bookId = this.getAttribute('data-book-id');
                    const icon = this.querySelector('i');

                    fetch('/favorite/toggle', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ book_id: bookId })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'added') {
                            icon.classList.remove('bi-heart');
                            icon.classList.add('bi-heart-fill');
                            this.classList.remove('btn-outline-danger');
                            this.classList.add('btn-danger');
                        } else if (data.status === 'removed') {
                            icon.classList.remove('bi-heart-fill');
                            icon.classList.add('bi-heart');
                            this.classList.remove('btn-danger');
                            this.classList.add('btn-outline-danger');
                        }
                        // Có thể hiển thị thông báo data.message
                    })
                    .catch(error => console.error('Error:', error));
                });
            });
        });
    </script>
</x-book-layout>