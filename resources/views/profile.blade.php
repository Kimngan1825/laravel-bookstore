<x-booklayout title="Hồ sơ cá nhân - Bookstore">
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-5">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white fw-bold py-3">
                        <i class="bi bi-person-lines-fill me-2"></i>Thông tin cá nhân
                    </div>
                    <div class="card-body">
                        <div id="profile-message"></div>

                        <form id="update-profile-form">
                            @csrf
                            <div class="mb-3">
                                <label class="small fw-bold mb-1">Họ tên</label>
                                <input type="text" id="full_name" name="full_name" class="form-control form-control-sm" value="{{ $user->full_name }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="small fw-bold mb-1">Email</label>
                                <input type="email" id="email" name="email" class="form-control form-control-sm" value="{{ $user->email }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="small fw-bold mb-1">Số điện thoại</label>
                                <input type="text" id="phone" name="phone" class="form-control form-control-sm" value="{{ $user->phone }}">
                            </div>
                            <button type="button" id="btn-update-profile" class="btn btn-primary w-100 fw-bold">
                                CẬP NHẬT HỒ SƠ
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-7">
                <h5 class="fw-bold mb-3 d-flex justify-content-between align-items-center">
                    <span>Sách yêu thích của bạn</span>
                    <span class="badge bg-mint text-white rounded-pill fs-6">{{ $favorites->count() }}</span>
                </h5>
                <div class="row">
                    @forelse($favorites as $item)
                    <div class="col-md-4 mb-3">
                        <div class="card h-100 border-0 shadow-sm text-center p-2">
                            <img src="{{ asset('storage/'.$item->file_image) }}" class="card-img-top mx-auto" style="width: 80px; height: 110px; object-fit: cover;">
                            <div class="card-body p-2 mt-2">
                                <p class="small text-truncate fw-bold mb-1">{{ $item->title }}</p>
                                <span class="text-danger small fw-bold">{{ number_format($item->price) }}đ</span>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted mt-2">Danh sách yêu thích đang trống.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#btn-update-profile').click(function() {
            let formData = {
                full_name: $('#full_name').val(),
                email: $('#email').val(),
                phone: $('#phone').val(),
                _token: $('input[name="_token"]').val()
            };

            $.ajax({
                url: "{{ route('profile_update') }}",
                method: "POST",
                data: formData,
                success: function(response) {
                    $('#profile-message').html(`
                        <div class="alert alert-success border-0 small py-2">
                            <i class="bi bi-check-circle-fill me-2"></i>${response.message}
                        </div>
                    `);
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    let errorHtml = '<div class="alert alert-danger border-0 small py-2"><ul class="mb-0">';
                    $.each(errors, function(key, value) {
                        errorHtml += '<li>' + value[0] + '</li>';
                    });
                    errorHtml += '</ul></div>';
                    $('#profile-message').html(errorHtml);
                }
            });
        });
    });
    </script>
</x-booklayout>