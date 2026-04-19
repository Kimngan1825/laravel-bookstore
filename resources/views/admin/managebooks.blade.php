@extends('layouts.admin')

@section('content')
<style>
    :root { --admin-teal: #1BA085; }
    body { background-color: #f4f7f6; }

    /* --- 1. Header & Navigation --- */
    .header-teal { 
        background-color: var(--admin-teal); 
        color: white; 
        padding: 10px 25px; 
        display: flex; 
        justify-content: space-between; 
        align-items: center; 
    }
    .nav-btn { 
        color: white; 
        border: 1px solid rgba(255,255,255,0.5); 
        padding: 5px 15px; 
        border-radius: 8px; 
        text-decoration: none; 
        font-size: 0.9rem; 
        background: rgba(255,255,255,0.1); 
        transition: 0.3s; 
    }
    .nav-btn:hover { background: rgba(255,255,255,0.2); color: white; }
    .btn-logout { background-color: #e74c3c; border: none; }
    .btn-logout:hover { background-color: #c0392b; }

    /* --- 2. Layout & Form Sections --- */
    .page-title { color: #555; font-weight: bold; padding: 20px 0; text-transform: uppercase; }
    .form-section { background: white; border-radius: 8px; padding: 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); margin-bottom: 30px; }
    .section-header { color: var(--admin-teal); font-weight: bold; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
    
    .form-label { font-weight: bold; color: #333; font-size: 0.85rem; margin-bottom: 5px; }
    .form-control, .form-select { border-radius: 6px; border: 1px solid #ddd; padding: 8px 12px; font-size: 0.9rem; }
    .bg-detail { background-color: #f8f9fa; border-radius: 8px; padding: 20px; }
    
    .btn-submit-book { 
        background-color: var(--admin-teal); 
        color: white; 
        border: none; 
        padding: 10px 30px; 
        border-radius: 8px; 
        font-weight: bold; 
        display: flex; 
        align-items: center; 
        gap: 8px; 
        margin: 0 auto; 
        transition: 0.3s; 
    }
    .btn-submit-book:hover { background-color: #168a71; transform: translateY(-2px); }

    /* --- 3. Table Styles --- */
    .table-container { background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
    .table thead { border-top: 3px solid var(--admin-teal); background-color: white; }
    .table thead th { font-weight: bold; color: #333; text-transform: uppercase; font-size: 0.8rem; padding: 15px; border-bottom: 1px solid #eee; }
    .table tbody td { padding: 15px; vertical-align: middle; border-bottom: 1px solid #eee; font-size: 0.9rem; }
    
    .book-title { font-weight: bold; color: #2c3e50; margin-bottom: 2px; }
    .book-info { font-size: 0.8rem; color: #7f8c8d; }
    .book-price { font-weight: bold; color: #e74c3c; }

    /* --- 4. Status Dropdown --- */
    .status-select { 
        cursor: pointer; 
        border-radius: 20px; 
        font-size: 0.8rem; 
        padding: 4px 12px; 
        font-weight: 600; 
        text-align: center; 
        border: none; 
        appearance: none; 
        width: 130px; 
    }
    .status-active { background-color: #d1e7dd; color: #0f5132; }
    .status-inactive { background-color: #f8d7da; color: #842029; }
</style>

{{-- Header chuẩn mẫu --}}
<div class="header-teal shadow-sm">
    <div class="fw-bold"><i class="bi bi-shield-check me-2"></i>Admin Dashboard</div>
    <div class="d-flex align-items-center gap-2">
        <span class="small me-2">Xin chào, {{ Auth::user()->full_name ?? 'Trần Quản Trị' }}</span>
        <a href="{{ route('admin.dashboard') }}" class="nav-btn"><i class="bi bi-arrow-left-short"></i> Dashboard</a>
        <a href="{{ url('/') }}" class="nav-btn"><i class="bi bi-house-door"></i> Trang chủ</a>
        <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="nav-btn btn-logout">
                <i class="bi bi-box-arrow-right"></i> Đăng xuất
            </button>
        </form>
    </div>
</div>

<div class="container-fluid px-5 pb-5">
    <h3 class="page-title">QUẢN LÝ KHO SÁCH</h3>

    {{-- Phần hiển thị thông báo sách sắp hết --}}
    @if(count($lowStockBooks) > 0)
        <div class="alert alert-warning border-0 shadow-sm mb-4 d-flex align-items-center">
            <i class="bi bi-exclamation-triangle-fill fs-4 me-3"></i>
            <div>
                <strong class="d-block">CẢNH BÁO TỒN KHO:</strong>
                <span class="small">Có {{ count($lowStockBooks) }} đầu sách sắp hết hàng (tồn kho < 5). Hãy kiểm tra và nhập thêm nhen!</span>
            </div>
            <button class="btn btn-sm btn-outline-dark ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLowStock">
                Xem chi tiết
            </button>
        </div>
        <div class="collapse mb-4" id="collapseLowStock">
            <div class="card card-body border-warning small">
                @foreach($lowStockBooks as $ls)
                    <div class="d-flex justify-content-between border-bottom py-1">
                        <span>{{ $ls->title }}</span>
                        <span class="fw-bold text-danger">Còn {{ $ls->stock }} cuốn</span>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    {{-- Form Thêm/Sửa Sách --}}
    <div class="form-section">
        <div class="section-header">
            <i class="bi bi-plus-circle"></i> {{ isset($bookToEdit) ? 'CHỈNH SỬA THÔNG TIN SÁCH' : 'THÊM SÁCH MỚI VÀO KHO' }}
        </div>
        
        <form action="{{ route('admin.books.save') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($bookToEdit)) 
                <input type="hidden" name="book_id" value="{{ $bookToEdit->book_id }}"> 
            @endif
            
            <div class="row">
                {{-- Cột Trái: Thông tin cơ bản --}}
                <div class="col-md-6 pe-4">
                    <div class="mb-3">
                        <label class="form-label">Tên sách</label>
                        <input type="text" name="title" class="form-control" value="{{ $bookToEdit->title ?? '' }}" required>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label">Danh mục</label>
                            <select name="category_id" class="form-select">
                                @foreach($categories as $c)
                                    <option value="{{ $c->category_id }}" {{ (isset($bookToEdit) && $bookToEdit->category_id == $c->category_id) ? 'selected' : '' }}>
                                        {{ $c->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Tác giả</label>
                            <select name="author_id" class="form-select">
                                @foreach($authors as $a)
                                    <option value="{{ $a->author_id }}" {{ (isset($bookToEdit) && $bookToEdit->author_id == $a->author_id) ? 'selected' : '' }}>
                                        {{ $a->author_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label">Giá bán</label>
                            <input type="number" name="price" class="form-control" value="{{ $bookToEdit->price ?? '' }}" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Tồn kho</label>
                            <input type="number" name="stock" class="form-control" value="{{ $bookToEdit->stock ?? '' }}" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ảnh bìa</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                </div>

                {{-- Cột Phải: Thông tin chi tiết --}}
                <div class="col-md-6">
                    <div class="bg-detail h-100">
                        <h6 class="fw-bold text-secondary mb-3 small">THÔNG TIN CHI TIẾT</h6>
                        <div class="row g-2">
                            <div class="col-6">
                                <input type="text" name="supplier" class="form-control" placeholder="Nhà cung cấp" value="{{ $bookToEdit->supplier ?? '' }}">
                            </div>
                            <div class="col-6">
                                <input type="text" name="publisher" class="form-control" placeholder="Nhà xuất bản" value="{{ $bookToEdit->publisher ?? '' }}">
                            </div>
                            <div class="col-4">
                                <input type="text" name="publication_year" class="form-control" placeholder="Năm XB" value="{{ $bookToEdit->publication_year ?? '' }}">
                            </div>
                            <div class="col-4">
                                <input type="text" name="language" class="form-control" placeholder="Tiếng Việt" value="{{ $bookToEdit->language ?? '' }}">
                            </div>
                            <div class="col-4">
                                <input type="text" name="page_count" class="form-control" placeholder="Số trang" value="{{ $bookToEdit->page_count ?? '' }}">
                            </div>
                            <div class="col-6">
                                <input type="text" name="weight" class="form-control" placeholder="Trọng lượng" value="{{ $bookToEdit->weight ?? '' }}">
                            </div>
                            <div class="col-6">
                                <input type="text" name="size" class="form-control" placeholder="Kích thước" value="{{ $bookToEdit->size ?? '' }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label mt-2">Mô tả</label>
                                <textarea name="description" class="form-control" rows="3">{{ $bookToEdit->description ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-submit-book shadow-sm">
                    <i class="bi bi-save"></i> {{ isset($bookToEdit) ? 'LƯU CẬP NHẬT' : 'THÊM SÁCH MỚI' }}
                </button>
            </div>
        </form>
    </div>

    {{-- Table Danh Sách Sách --}}
    <div class="table-container">
        <table class="table align-middle mb-0">
            <thead class="text-center">
                <tr>
                    <th width="5%">ID</th>
                    <th width="8%">Ảnh</th>
                    <th width="35%" class="text-start">Tên sách</th>
                    <th width="12%">Giá</th>
                    <th width="10%">Kho</th>
                    <th width="15%">Trạng thái</th>
                    <th width="5%">Sửa</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $b)
                    <tr>
                        <td class="text-center fw-bold text-muted">#{{ $b->book_id }}</td>
                        <td class="text-center">
                            <img src="{{ asset('storage/uploads/books/'.$b->image) }}" style="height: 60px; width: 45px; object-fit: cover;" class="shadow-sm border">
                        </td>
                        <td>
                            <div class="book-title">{{ $b->title }}</div>
                            <div class="book-info">{{ $b->author_name }} | {{ $b->category_name }}</div>
                        </td>
                        <td class="text-center book-price">{{ number_format($b->price) }} đ</td>
                        <td class="text-center">
                            <span class="badge bg-light text-dark border px-3 py-2">{{ $b->stock }}</span>
                        </td>
                        <td class="text-center">
                            <form action="{{ route('admin.books.save') }}" method="POST">
                                @csrf
                                <input type="hidden" name="book_id" value="{{ $b->book_id }}">
                                <input type="hidden" name="quick_status" value="1">
                                <select name="is_active" onchange="this.form.submit()" 
                                    class="status-select mx-auto {{ $b->is_active ? 'status-active' : 'status-inactive' }}">
                                    <option value="1" {{ $b->is_active ? 'selected' : '' }}>Hiển thị</option>
                                    <option value="0" {{ !$b->is_active ? 'selected' : '' }}>Đang ẩn</option>
                                </select>
                            </form>
                        </td>
                        <td class="text-center">
                            <a href="?edit_id={{ $b->book_id }}" class="btn btn-sm btn-outline-primary border-1 shadow-sm">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection