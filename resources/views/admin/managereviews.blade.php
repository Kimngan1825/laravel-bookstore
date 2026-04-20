@extends('layouts.admin')

@section('content')
<style>
    :root { --admin-teal: #1BA085; }
    
    /* Header */
    .header-teal { background-color: var(--admin-teal); color: white; padding: 10px 25px; display: flex; justify-content: space-between; align-items: center; }
    .nav-btn { color: white; border: 1px solid rgba(255,255,255,0.5); padding: 5px 15px; border-radius: 8px; text-decoration: none; font-size: 0.9rem; background: rgba(255,255,255,0.1); }
    .btn-logout { background-color: #e74c3c; border: none; }

    /* Nội dung bảng & Badge */
    .page-title { color: #555; font-weight: bold; padding: 20px 0; text-transform: uppercase; }
    .star-filled { color: #ffc107; }
    .star-empty { color: #e4e5e9; }
    
    .badge-pending { background-color: #fff3cd; color: #856404; border: 1px solid #ffeeba; }
    .badge-approved { background-color: #d1e7dd; color: #0f5132; border: 1px solid #badbcc; }

    .table-container { background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
    .table thead { border-top: 3px solid var(--admin-teal); background-color: white; }
    .table thead th { font-weight: bold; color: #333; font-size: 0.85rem; padding: 12px; }
    .table tbody td { padding: 15px 12px; vertical-align: middle; border-bottom: 1px solid #eee; font-size: 0.85rem; }
    
    .book-img { width: 40px; height: 55px; object-fit: cover; border-radius: 4px; border: 1px solid #ddd; }
</style>

{{-- Header --}}
<div class="header-teal shadow-sm">
    <div class="fw-bold"><i class="bi bi-shield-check me-2"></i>Admin Dashboard</div>
    <div class="d-flex align-items-center gap-2">
        <span class="small me-2">Xin chào Admin, {{ Auth::user()->full_name ?? 'Trần Quản Trị' }}</span>
        <a href="{{ route('admin.dashboard') }}" class="nav-btn">Dashboard</a>
        <a href="{{ url('/') }}" class="nav-btn">Trang chủ</a>
        <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="nav-btn btn-logout px-3">Đăng xuất</button>
        </form>
    </div>
</div>

<div class="container-fluid px-5">
    <h3 class="page-title">qUẢN LÝ BÌNH LUẬN & ĐÁNH GIÁ</h3>

    <div class="table-container shadow-sm card border-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="text-center">
                    <tr>
                        <th width="5%">ID</th>
                        <th width="8%">Ảnh</th>
                        <th width="20%" class="text-start">Sách</th>
                        <th width="15%" class="text-start">Người dùng</th>
                        <th width="10%">Đánh giá</th>
                        <th width="20%" class="text-start">Nội dung</th>
                        <th width="10%">Trạng thái</th>
                        <th width="12%">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reviews as $r)
                    <tr class="{{ $r->is_approved == 0 ? 'bg-warning bg-opacity-10' : '' }}">
                        <td class="text-center fw-bold text-muted">#{{ $r->review_id }}</td>
                        <td class="text-center">
                            <img src="{{ asset('storage/uploads/books/'.$r->image) }}" class="book-img">
                        </td>
                        <td class="text-start fw-bold text-primary">{{ $r->title }}</td>
                        <td class="text-start">
                            <div class="small fw-bold"><i class="bi bi-person-circle me-1"></i>{{ $r->full_name }}</div>
                            <div class="text-muted" style="font-size: 0.7rem">{{ date('d/m/Y H:i', strtotime($r->created_at)) }}</div>
                        </td>
                        <td class="text-center">
                            <div class="text-nowrap">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="bi bi-star-fill {{ $i <= $r->rating ? 'star-filled' : 'star-empty' }}"></i>
                                @endfor
                            </div>
                        </td>
                        <td class="text-start">
                            <div class="fst-italic text-muted" style="font-size: 0.8rem">"{{ $r->comment }}"</div>
                        </td>
                        <td class="text-center">
                            @if($r->is_approved == 1)
                                <span class="badge badge-approved rounded-pill px-3"><i class="bi bi-check-circle me-1"></i>Đã duyệt</span>
                            @else
                                <span class="badge badge-pending rounded-pill px-3"><i class="bi bi-hourglass-split me-1"></i>Chờ duyệt</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-1">
                                <a href="{{ route('admin.reviews.toggle', ['id' => $r->review_id, 'status' => $r->is_approved]) }}" 
                                   class="btn btn-sm {{ $r->is_approved == 1 ? 'btn-outline-warning' : 'btn-success' }} border-0 shadow-sm"
                                   title="{{ $r->is_approved == 1 ? 'Ẩn bình luận' : 'Duyệt hiển thị' }}">
                                    <i class="bi {{ $r->is_approved == 1 ? 'bi-eye-slash-fill' : 'bi-check-lg' }}"></i>
                                </a>
                                <a href="{{ route('admin.reviews.delete', $r->review_id) }}" 
                                   class="btn btn-sm btn-outline-danger border-0" 
                                   onclick="return confirm('Xóa vĩnh viễn đánh giá này?')">
                                    <i class="bi bi-trash-fill fs-5"></i>
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
@endsection