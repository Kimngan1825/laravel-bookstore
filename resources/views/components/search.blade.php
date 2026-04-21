<x-book-layout>
    <x-slot name="title">Kết quả tìm kiếm: {{ $q }}</x-slot>

    <x-slot name="sidebar">
        @include('components.booksidebar') 
    </x-slot>

    <div class="section-header" style="margin-top: 40px;">
        <h4 class="section-title title-new">Kết quả tìm kiếm cho: "{{ $q }}"</h4>
        <span class="text-muted">Tìm thấy {{ $books->count() }} sản phẩm</span>
    </div>

    @if($books->count() > 0)
        <div class="row row-cols-2 row-cols-md-5 g-3">
            @foreach($books as $book)
                <div class="col">
                    @include('components.productcard', ['book' => $book])
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-5">
            <i class="bi bi-search fs-1 text-muted"></i>
            <p class="mt-3 text-muted">Rất tiếc, tiệm sách không tìm thấy sách nào phù hợp.</p>
        </div>
    @endif
</x-book-layout>