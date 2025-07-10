@extends('layout.main')

@section('title', 'BookShop - Đăng ký tài khoản')
@section('content')
<main class="main">

    <!-- Page Title -->
    <div class="page-title light-background">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Đăng ký</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ url('/') }}">Trang chủ</a></li>
                    <li class="current">Đăng ký</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Login Register Section -->
    <section id="login-register" class="login-register section">
        <div class="container aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="login-register-wraper">
                        <ul class="nav nav-tabs nav-tabs-bordered justify-content-center mb-4" role="tablist">
                            <li class="nav-item" role="presentation">
                                <b>Đăng ký tài khoản</b>
                            </li>
                        </ul>

                        <div class="tab-pane fade show active" id="login-register-registration-form" role="tabpanel">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('register') }}" id="register-form">

                                @csrf
                                <div class="row g-3">
                                    <div class="col-sm-6">
                                        <label for="login-register-reg-firstname" class="form-label">Họ</label>
                                        <input type="text" class="form-control @error('ho') is-invalid @enderror"
                                            id="login-register-reg-firstname" name="ho" value="{{ old('ho') }}" required>
                                        @error('ho')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="login-register-reg-lastname" class="form-label">Tên</label>
                                        <input type="text" class="form-control @error('ten') is-invalid @enderror"
                                            id="login-register-reg-lastname" name="ten" value="{{ old('ten') }}" required>
                                        @error('ten')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label for="login-register-reg-email" class="form-label">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="login-register-reg-email" name="email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label for="login-register-reg-password" class="form-label">Mật khẩu</label>
                                        <div class="input-group">
                                            <input type="password"
                                                class="form-control @error('matkhau') is-invalid @enderror"
                                                id="login-register-reg-password" name="matkhau" required>
                                            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('login-register-reg-password', this)">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </div>
                                        @error('matkhau')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label for="login-register-reg-confirm-password" class="form-label">Nhập lại mật khẩu</label>
                                        <div class="input-group">
                                            <input type="password"
                                                class="form-control @error('matkhau') is-invalid @enderror"
                                                id="login-register-reg-confirm-password"
                                                name="matkhau_confirmation" required>
                                            <button class="btn btn-outline-secondary" type="button"
                                                onclick="togglePassword('login-register-reg-confirm-password', this)">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </div>
                                        @error('matkhau')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                                        @if ($errors->has('g-recaptcha-response'))
                                            <div class="text-danger">{{ $errors->first('g-recaptcha-response') }}</div>
                                        @endif
                                    </div>

                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary btn-lg">Đăng ký</button>
                                    </div>
                                    <div class="col-12 text-center">
                                        <small>Nếu có tài khoản, <a href="{{ route('login') }}">đăng nhập ở đây</a></small>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Hiển thị thông báo sau khi đăng ký --}}
    @if (session('register_success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Đăng ký thành công!',
                    text: 'Bạn sẽ được chuyển sang trang đăng nhập sau 3 giây...',
                    timer: 3000,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = "{{ route('login') }}";
                });
            });
        </script>
    @endif

    {{-- Ẩn lỗi khi sửa các trường --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const fields = [
                'login-register-reg-email',
                'login-register-reg-firstname',
                'login-register-reg-lastname',
                'login-register-reg-confirm-password'
            ];

            fields.forEach(function (id) {
                const input = document.getElementById(id);
                if (!input) return;

                input.addEventListener('input', function () {
                    if (input.classList.contains('is-invalid')) {
                        input.classList.remove('is-invalid');
                        const feedback = input.parentElement.querySelector('.invalid-feedback');
                        if (feedback) feedback.style.display = 'none';
                    }
                });
            });
        });

        function togglePassword(id, btn) {
            const input = document.getElementById(id);
            if (input.type === "password") {
                input.type = "text";
                btn.querySelector('i').classList.remove('fa-eye');
                btn.querySelector('i').classList.add('fa-eye-slash');
            } else {
                input.type = "password";
                btn.querySelector('i').classList.remove('fa-eye-slash');
                btn.querySelector('i').classList.add('fa-eye');
            }
        }
    </script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('register-form');
    const passwordInput = document.getElementById('login-register-reg-password');
    const confirmInput = document.getElementById('login-register-reg-confirm-password');

    form.addEventListener('submit', function (e) {
        const captchaResponse = grecaptcha.getResponse();

        if (!captchaResponse) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Vui lòng xác thực captcha',
                text: 'Bạn cần xác nhận "Tôi không phải là người máy" để tiếp tục.',
            });
            return;
        }

        if (passwordInput.value !== confirmInput.value) {
            e.preventDefault();

            confirmInput.classList.add('is-invalid');

            const existingFeedback = confirmInput.parentElement.querySelector('.invalid-feedback');
            if (!existingFeedback) {
                const feedback = document.createElement('div');
                feedback.classList.add('invalid-feedback');
                feedback.textContent = 'Mật khẩu xác nhận không khớp.';
                confirmInput.parentElement.appendChild(feedback);
            }

            Swal.fire({
                icon: 'error',
                title: 'Lỗi!',
                text: 'Mật khẩu và mật khẩu xác nhận không giống nhau.',
            });

            return;
        }
    });
});

</script>

</main>
@endsection
