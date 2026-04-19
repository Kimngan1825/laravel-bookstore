@extends('layouts.admin')

@section('content')
<style>
    :root { --admin-teal: #1BA085; }
    body { background-color: #f4f7f6; }

    /* --- 1. Header Admin chuẩn Dashboard --- */
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

    /* --- 2. Tiêu đề trang --- */
    .page-header-box { padding: 20px 0; margin-bottom: 25px; }
    .page-title-custom { 
        color: #555; 
        font-weight: bold; 
        text-transform: uppercase; 
        letter-spacing: 1px; 
        margin: 0; 
    }

    /* --- 3. Card & Form thiết kế --- */
    .card-custom { border: none; border-radius: 5px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); background: #fff; }
    .card-header-custom { background: #fff; border-bottom: 1px solid #eee; padding: 12px 20px; }
    .text-teal-custom { color: var(--admin-teal) !important; font-weight: bold; font-size: 0.9rem; }
    
    .input-custom { border: 1px solid #ddd; padding: 10px; border-radius: 4px; width: 100%; font-size: 0.9rem; }
    .btn-submit-custom { 
        background-color: var(--admin-teal); 
        color: white; 
        border: none; 
        padding: 10px; 
        border-radius: 5px; 
        width: 100%; 
        font-weight: 500; 
    }
    .btn-submit-custom:hover { background-color: #168a71; color: white; }

    /* --- 4. Table Styles --- */
    .table thead { border-top: 3px solid var(--admin-teal); background-color: #fff; }
    .table thead th { 
        text-transform: none; 
        font-size: 0.9rem; 
        font-weight: bold; 
        color: #333; 
        padding: 12px; 
        border-bottom: 1px solid #dee2e6; 
    }
    .table tbody td { padding: 12px; vertical-align: middle; border-bottom: 1px solid #f2f2f2; font-size: 0.95rem; }
    .btn-action-icon { border: none !important; background: none; padding: 0 5px; font-size: 1.2rem; transition: 0.2s; }
</style>

{{-- Header Admin giống Dashboard 100% --}}
<div class="header-teal shadow-sm">
    <div class="fw-bold"><i class="bi bi-shield-check me-2"></i>Admin Dashboard</div>
    <div class="d-flex align-items-center gap-2">
        <span class="small me-2">Xin chào, {{ Auth::user()->full_name ?? 'Trần Quản Trị' }}</span>
        <a href="{{ route('admin.dashboard') }}" class="nav-btn"><i class="bi bi-arrow-left-short"></i> Dashboard</a>
        <a href="{{ url('/') }}" class="nav-btn"><i class="bi bi-house-door"></i> Trang chủ</a>
        <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="nav-btn btn-logout"><i class="bi bi-box-arrow-right"></i> Đăng xuất</button>
        </form>
    </div>
</div>

<div class="container-fluid px-5 pb-5">
    {{-- Tiêu đề QUẢN LÝ DANH MỤC SÁCH --}}
    <div class="page-header-box">
        <h3 class="page-title-custom">QUẢN LÝ DANH MỤC SÁCH</h3>
    </div>

    <div class="row">
        {{-- BÊN TRÁI: FORM THÊM MỚI/SỬA (col-md-4) --}}
        <div class="col-md-4 mb-4">
            <div class="card card-custom">
                <div class="card-header-custom">
                    <span class="text-teal-custom text-uppercase">
                        <i class="bi bi-folder-plus me-2"></i>
                        {{ isset($catToEdit) ? 'SỬA DANH MỤC' : 'THÊM MỚI' }}
                    </span>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.categories.save') }}" method="POST">
                        @csrf
                        @if(isset($catToEdit)) 
                            <input type="hidden" name="category_id" value="{{ $catToEdit->category_id }}"> 
                        @endif
                        
                        <div class="mb-4">
                            <label class="fw-bold small mb-2 text-muted">Tên danh mục sản phẩm</label>
                            <input type="text" name="category_name" class="input-custom" 
                                   value="{{ $catToEdit->category_name ?? '' }}" 
                                   placeholder="Ví dụ: Tiểu thuyết, Kinh tế..." required>
                        </div>

                        <button type="submit" class="btn btn-submit-custom shadow-sm">
                            <i class="bi bi-save me-1"></i> {{ isset($catToEdit) ? 'Cập nhật' : 'Thêm mới' }}
                        </button>

                        @if(isset($catToEdit))
                            <div class="text-center mt-3">
                                <a href="{{ route('admin.categories') }}" class="text-muted small text-decoration-none">Hủy bỏ</a>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>

        {{-- BÊN PHẢI: DANH SÁCH DANH MỤC (col-md-8) --}}
        <div class="col-md-8 mb-4">
            <div class="card card-custom overflow-hidden">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th width="10%" class="text-center">ID</th>
                                <th class="text-start">Tên danh mục sản phẩm</th>
                                <th width="20%" class="text-center">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $c)
                                <tr>
                                    <td class="text-center text-muted fw-bold">#{{ $c->category_id }}</td>
                                    <td class="fw-bold text-dark">{{ $c->category_name }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center">
                                            {{-- Nút Sửa --}}
                                            <a href="?edit_id={{ $c->category_id }}" class="btn-action-icon text-primary" title="Sửa">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            {{-- Nút Xóa --}}
                                            <a href="{{ route('admin.categories.delete', $c->category_id) }}" 
                                               class="btn-action-icon text-danger" 
                                               onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?')"
                                               title="Xóa">
                                                <i class="bi bi-trash-fill"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection