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
    </div><!-- End Page Title -->

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

                        <!-- Registration Form -->
                        <div class="tab-pane fade show active" id="login-register-registration-form" role="tabpanel">

                            {{-- Thông báo thành công --}}
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Đóng"></button>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-sm-6">
                                        <label for="login-register-reg-firstname" class="form-label">Họ</label>
                                        <input type="text" class="form-control @error('ho') is-invalid @enderror"
                                            id="login-register-reg-firstname" name="ho" value="{{ old('ho') }}"
                                            required>
                                            @error('ho')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="login-register-reg-lastname" class="form-label">Tên</label>
                                        <input type="text" class="form-control @error('ten') is-invalid @enderror"
                                            id="login-register-reg-lastname" name="ten" value="{{ old('ten') }}"
                                            required>
                                            @error('ten')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label for="login-register-reg-email" class="form-label">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="login-register-reg-email" name="email" value="{{ old('email') }}"
                                            required>
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
                                            <input type="password" class="form-control"
                                                id="login-register-reg-confirm-password" name="matkhau_confirmation"
                                                required>
                                            <button class="btn btn-outline-secondary" type="button"
                                                onclick="togglePassword('login-register-reg-confirm-password', this)">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </div>
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

                        </div> <!-- End Form -->

                    </div>
                </div>
            </div>
        </div>
    </section><!-- /Login Register Section -->
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const emailInput = document.getElementById('login-register-reg-email');
            const errorDiv = emailInput.parentElement.querySelector('.invalid-feedback');

            emailInput.addEventListener('input', function () {
                if (errorDiv) {
                    errorDiv.style.display = 'none';
                    emailInput.classList.remove('is-invalid');
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Các field cần theo dõi
            const fields = ['login-register-reg-firstname', 'login-register-reg-lastname'];

            fields.forEach(function(id) {
                const input = document.getElementById(id);
                input.addEventListener('input', function () {
                    if (input.classList.contains('is-invalid')) {
                        input.classList.remove('is-invalid');
                        const feedback = input.parentElement.querySelector('.invalid-feedback');
                        if (feedback) {
                            feedback.style.display = 'none';
                        }
                    }
                });
            });
        });
        </script>
</main>
@endsection
