@extends('layout.main')

@section('title', 'BookShop - Quên Mật Khẩu')
@section('content')
<main class="main">

    <!-- Page Title -->
    <div class="page-title light-background">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Quên Mật Khẩu</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ url('/') }}">Trang chủ</a></li>
                    <li class="current">Quên Mật Khẩu</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->

    <section id="forgot-password" class="login-register section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="login-register-wraper">

                        <div class="tab-content">
                            <div class="tab-pane fade show active">
                                @if (session('status'))
                                    <div class="alert alert-success">
                                        {{ __(session('status')) }}
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            @foreach ($errors->all() as $error)
                                                <div>{{ $error }}</div>
                                            @endforeach
                                        </div>
                                    @endif

                                    <div class="mb-4">
                                        <label for="email" class="form-label">Địa chỉ email</label>
                                        <input type="email" name="email" id="email" class="form-control" placeholder="Nhập địa chỉ email" required>
                                        @error('email')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            Đặt lại mật khẩu
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="col-12 text-center mt-3">
                            <small>Đã nhớ mật khẩu? <a href="{{ route('login') }}">Đăng nhập tại đây</a></small>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
