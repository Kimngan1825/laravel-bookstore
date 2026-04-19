@extends('layouts.admin')

@section('content')
<style>
    :root { --admin-teal: #1BA085; }
    body { background-color: #f4f7f6; }

    /* Header */
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

    /* Table Styles */
    .page-title { color: #555; font-weight: bold; padding: 20px 0; text-transform: uppercase; letter-spacing: 1px; }
    .table-container { background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 12px rgba(0,0,0,0.08); }
    
    .table thead { border-top: 4px solid var(--admin-teal); background-color: #f8f9fa; }
    .table thead th { text-transform: uppercase; font-size: 0.8rem; font-weight: 800; color: #333; padding: 15px; border-bottom: 1px solid #dee2e6; }
    .table tbody td { padding: 12px 15px; vertical-align: middle; border-bottom: 1px solid #f1f1f1; font-size: 0.9rem; }

    /* Role Select */
    .role-select { border: 1px solid #ddd; border-radius: 20px; padding: 3px 12px; font-size: 0.75rem; font-weight: bold; cursor: pointer; outline: none; }
    .role-admin { background-color: #fff0f3; color: #e91e63; border-color: #ffccd5; }
    .role-member { background-color: #eef2ff; color: #4f46e5; border-color: #e0e7ff; }

    /* Status Badge */
    .status-badge { font-size: 11px; padding: 5px 12px; border-radius: 20px; font-weight: bold; display: inline-block; }
    .status-active { background: #d1e7dd; color: #0f5132; }
    .status-locked { background: #f8d7da; color: #842029; }

    /* Action Buttons - Không viền, icon Fill */
    .btn-action { border: none !important; background: none; padding: 0 6px; font-size: 1.2rem; transition: 0.2s; }
    .btn-action:hover { transform: scale(1.15); }
    .text-info-custom { color: #0dcaf0; }
    .text-warning-custom { color: #ffc107; }
    .text-success-custom { color: #198754; }
    .text-danger-custom { color: #dc3545; }
</style>

{{-- Header --}}
<div class="header-teal shadow-sm">
    <div class="fw-bold"><i class="bi bi-shield-check me-2"></i>Admin Dashboard</div>
    <div class="d-flex align-items-center gap-2">
        <span class="small me-2">Xin chào Admin, {{ Auth::user()->full_name ?? 'Bảo Yến' }}</span>
        <a href="{{ route('admin.dashboard') }}" class="nav-btn"><i class="bi bi-arrow-left-short"></i> Dashboard</a>
        <a href="{{ url('/') }}" class="nav-btn"><i class="bi bi-house-door"></i> Trang chủ</a>
        <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="nav-btn btn-logout px-3"><i class="bi bi-box-arrow-right"></i> Đăng xuất</button>
        </form>
    </div>
</div>

<div class="container-fluid px-5 pb-5">
    <h3 class="page-title">DANH SÁCH TÀI KHOẢN HỆ THỐNG</h3>

    <div class="table-container shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="text-center">
                    <tr>
                        <th width="5%">ID</th>
                        <th width="15%" class="text-start">Họ và tên</th>
                        <th width="20%" class="text-start">Email đăng nhập</th>
                        <th width="12%">Số điện thoại</th>
                        <th width="15%">Quyền (Role)</th>
                        <th width="15%">Trạng thái</th>
                        <th width="18%">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $u)
                    <tr>
                        <td class="text-center fw-bold text-muted">#{{ $u->user_id }}</td>
                        <td class="text-start fw-bold text-dark">{{ $u->full_name }}</td>
                        <td class="text-start text-primary" style="font-size: 0.85rem;">{{ $u->email }}</td>
                        <td class="text-center text-muted small">{{ $u->phone ?? '---' }}</td>
                        <td class="text-center">
                            @if($u->user_id != Auth::id())
                                <form action="{{ route('admin.users.updateRole') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $u->user_id }}">
                                    <select name="role_id" onchange="this.form.submit()" 
                                            class="role-select {{ $u->role_id == 1 ? 'role-admin' : 'role-member' }}">
                                        <option value="1" {{ $u->role_id == 1 ? 'selected' : '' }}>Admin</option>
                                        <option value="2" {{ $u->role_id == 2 ? 'selected' : '' }}>Member</option>
                                    </select>
                                </form>
                            @else
                                <span class="badge bg-dark rounded-pill px-3" style="font-size: 10px;">BẠN (ADMIN)</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <span class="status-badge {{ $u->status == 1 ? 'status-active' : 'status-locked' }}">
                                <i class="bi {{ $u->status == 1 ? 'bi-check-circle' : 'bi-x-circle' }} me-1"></i>
                                {{ $u->status == 1 ? 'Hoạt động' : 'Đã khóa' }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center">
                                {{-- Nút Xem chi tiết - Chỉ tạo button --}}
                                <button class="btn-action text-info-custom" title="Xem chi tiết">
                                    <i class="bi bi-eye-fill"></i>
                                </button>

                                @if($u->user_id != Auth::id())
                                    {{-- Nút Khóa/Mở --}}
                                    <a href="{{ route('admin.users.toggle', ['id' => $u->user_id, 'status' => $u->status]) }}" 
                                       class="btn-action {{ $u->status == 1 ? 'text-warning-custom' : 'text-success-custom' }}" 
                                       title="{{ $u->status == 1 ? 'Khóa tài khoản' : 'Mở khóa' }}">
                                        <i class="bi {{ $u->status == 1 ? 'bi-lock-fill' : 'bi-unlock-fill' }}"></i>
                                    </a>
                                    {{-- Nút Xóa --}}
                                    <a href="{{ route('admin.users.delete', $u->user_id) }}" 
                                       class="btn-action text-danger-custom" 
                                       onclick="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn tài khoản này?')">
                                        <i class="bi bi-trash-fill"></i>
                                    </a>
                                @endif
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