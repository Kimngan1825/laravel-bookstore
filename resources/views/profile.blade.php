<x-booklayout title="Hồ sơ cá nhân - Bookstore">
<div class="container py-4">
    <div class="row">

        <!-- SIDEBAR -->
        <div class="col-md-3">
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body text-center">
                    <div class="rounded-circle bg-light mx-auto mb-2"
                        style="width:80px;height:80px;display:flex;align-items:center;justify-content:center;font-size:35px;">
                        👤
                    </div>
                    <h6 class="fw-bold mb-0">{{ $user->full_name }}</h6>
                    <small class="text-muted">Thành viên</small>
                </div>
            </div>

            <div class="list-group shadow-sm">
                <a href="#profile" class="list-group-item list-group-item-action active" data-bs-toggle="tab">
                    Hồ sơ cá nhân
                </a>
                <a href="#password" class="list-group-item list-group-item-action" data-bs-toggle="tab">
                    Đổi mật khẩu
                </a>
                <a href="#favorites" class="list-group-item list-group-item-action" data-bs-toggle="tab">
                    Sản phẩm yêu thích
                </a>
                <a href="#address" class="list-group-item list-group-item-action" data-bs-toggle="tab">
                    Sổ địa chỉ
                </a>
            </div>
        </div>

        <!-- CONTENT -->
        <div class="col-md-9">
            <div class="tab-content">

                <!-- PROFILE -->
                <div class="tab-pane fade show active" id="profile">
                    <div class="card shadow-sm border-0">
                        <div class="card-header fw-bold">Hồ sơ cá nhân</div>
                        <div class="card-body">

                            <div id="profile-message"></div>

                            <form id="update-profile-form">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label>Họ tên</label>
                                        <input type="text" id="full_name" class="form-control"
                                               value="{{ $user->full_name }}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>SĐT</label>
                                        <input type="text" id="phone" class="form-control"
                                               value="{{ $user->phone }}">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label>Email</label>
                                    <input type="email" id="email" class="form-control"
                                           value="{{ $user->email }}">
                                </div>

                                <button type="button" id="btn-update-profile" class="btn btn-primary">
                                    Cập nhật
                                </button>
                            </form>

                        </div>
                    </div>
                </div>

                <!-- PASSWORD -->
                <div class="tab-pane fade" id="password">
                    <div class="card shadow-sm border-0">
                        <div class="card-header fw-bold">Đổi mật khẩu</div>
                        <div class="card-body">

                            <form method="POST" action="{{ route('change_password') }}">
                                @csrf

                                <div class="mb-3">
                                    <label>Mật khẩu cũ</label>
                                    <input type="password" name="old_password" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label>Mật khẩu mới</label>
                                    <input type="password" name="new_password" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label>Xác nhận mật khẩu</label>
                                    <input type="password" name="confirm_password" class="form-control">
                                </div>

                                <button class="btn btn-primary">
                                    Đổi mật khẩu
                                </button>
                            </form>

                        </div>
                    </div>
                </div>

                <!-- FAVORITES -->
                <div class="tab-pane fade" id="favorites">
                    <div class="card shadow-sm border-0">
                        <div class="card-header fw-bold">
                            Sản phẩm yêu thích ({{ $favorites->count() }})
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach($favorites as $book)
                                <div class="col-md-3 mb-3">
                                    <div class="card border-0 shadow-sm">
                                        <img src="{{ asset('book/'.$book->image) }}"
                                             class="card-img-top"
                                             style="height:150px;object-fit:cover;">
                                        <div class="card-body p-2 text-center">
                                            <small class="fw-bold">{{ $book->title }}</small>
                                            <div class="text-danger">
                                                {{ number_format($book->price) }}đ
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>


                <div class="tab-pane fade" id="address">
                    <div class="card shadow-sm border-0">
                        <div class="card-header fw-bold">
                            Sổ địa chỉ ({{ $addresses->count() }})
                        </div>

                        <div class="card-body">

                            @forelse($addresses as $address)
                            <div class="border rounded p-3 mb-2">

                                <div class="fw-bold">
                                    {{ $address->full_name }}
                                </div>

                                <div class="text-muted">
                                    {{ $address->phone }}
                                </div>

                                <div>
                                    {{ $address->address_line }}, {{ $address->city }}
                                </div>

                                @if($address->is_default == 1)
                                    <span class="badge bg-success mt-1">
                                        Mặc định
                                    </span>
                                @endif

                            </div>
                            @empty
                            <p class="text-muted text-center">
                                Bạn chưa có địa chỉ nào
                            </p>
                            @endforelse

                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function(){

    $('#btn-update-profile').click(function(){

        $.ajax({
            url: "{{ route('profile.update') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                full_name: $('#full_name').val(),
                email: $('#email').val(),
                phone: $('#phone').val()
            },

            success: function(response){
                $('#profile-message').html(
                    '<div class="alert alert-success">Cập nhật thành công</div>'
                );
            },

            error: function(xhr){
                console.log(xhr.responseText);

                $('#profile-message').html(
                    '<div class="alert alert-danger">'
                    + xhr.responseJSON.message +
                    '</div>'
                );
            }

        });

    });

});
</script>

</x-booklayout>