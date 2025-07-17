@extends('layout.main')

@section('title', 'BookShop - Đăng Nhập')
@section('content')
    <main class="main">
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        {{-- Hiển thị thông báo nếu bị khóa --}}
        <div id="account-locked-alert" style="display: none;" class="alert alert-danger">
            Tài khoản của bạn đã bị khóa.
        </div>
        <!-- Page Title -->
        <div class="page-title light-background">
            <div class="container d-lg-flex justify-content-between align-items-center">
                <h1 class="mb-2 mb-lg-0">Đăng nhập</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href=" {{ url('/') }}">Trang chủ</a></li>
                        <li class="current">Đăng nhập</li>
                    </ol>
                </nav>
            </div>
        </div><!-- End Page Title -->
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <section id="login-register" class="login-register section">

            <div class="container aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">

                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="login-register-wraper">

                            <!-- Tab Content -->
                            <div class="tab-content">

                                <!-- Login Form -->
                                <div class="tab-pane fade show active" id="login-register-login-form" role="tabpanel">
                                    <form action="{{ route('login') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="returnUrl" value="{{ request('returnUrl') }}">
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                @foreach ($errors->all() as $error)
                                                    <div>{{ $error }}</div>
                                                @endforeach
                                            </div>
                                        @endif
                                        <div class="mb-4">
                                            <label for="email" class="form-label">Địa chỉ email</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="Nhập địa chỉ email" required>
                                        </div>

                                        <div class="mb-4">
                                            <label for="password" class="form-label">Mật khẩu</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" id="password" name="password"
                                                    placeholder="Nhập mật khẩu" required>
                                                <button class="btn btn-outline-secondary" type="button"
                                                    onclick="togglePassword('password', this)">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <div class="form-check" style="margin: 0">
                                                <input type="checkbox" class="form-check-input" id="remember"
                                                    name="remember">
                                                <label class="form-check-label" for="remember">Lưu tài khoản</label>
                                            </div>
                                            <a href="{{ route('password.request') }}" class="forgot-password">Quên mật
                                                khẩu</a>
                                        </div>

                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary btn-lg">Đăng nhập</button>
                                        </div>
                                    </form>

                                </div>

                                <div class="col-12 mt-3 d-grid">
                                    <a href="{{ route('auth.google') }}" class="btn btn-outline-danger btn-lg"
                                        style="font-size: 1.05rem">
                                        <i class="bi bi-google"></i> Đăng nhập bằng Google
                                    </a>
                                </div>
                            </div>
                            <div class="col-12 text-center" style="margin-top: 1.05rem">
                                <small>Nếu chưa có tài khoản, <a href="{{ route('register') }}">đăng kí ở đây</a></small>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section>


        <script>
            document.addEventListener("DOMContentLoaded", function() {
                if (localStorage.getItem('account_locked') === 'true') {
                    document.getElementById('account-locked-alert').style.display = 'block';
                    localStorage.removeItem('account_locked'); // Xóa để tránh hiện lại lần sau
                }
            });
        </script>

    </main>


@endsection
