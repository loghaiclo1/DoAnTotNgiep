@extends('layout.main')

@section('title', 'BookShop - Đăng Nhập')
@section('content')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title light-background">
            <div class="container d-lg-flex justify-content-between align-items-center">
                <h1 class="mb-2 mb-lg-0">Login</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href=" {{ url('/') }}">Home</a></li>
                        <li class="current">Login</li>
                    </ol>
                </nav>
            </div>
        </div><!-- End Page Title -->


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

                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                @foreach ($errors->all() as $error)
                                                    <div>{{ $error }}</div>
                                                @endforeach
                                            </div>
                                        @endif
                                        <div class="mb-4">
                                            <label for="email" class="form-label">Email address</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                required>
                                        </div>

                                        <div class="mb-4">
                                            <label for="password" class="form-label">Password</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" id="password" name="password"
                                                    required>
                                                <button class="btn btn-outline-secondary" type="button"
                                                    onclick="togglePassword('password', this)">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="remember"
                                                    name="remember">
                                                <label class="form-check-label" for="remember">Remember me</label>
                                            </div>
                                            <a href="#" class="forgot-password">Forgot Password?</a>
                                        </div>

                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary btn-lg">Login</button>
                                        </div>
                                    </form>

                                </div>

                                <div class="col-12">
                                    <a href="{{ route('login') }}" class="btn btn-outline-danger btn-lg">
                                        <i class="bi bi-google me-2"></i>Đăng nhập bằng Google
                                    </a>
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <small>Nếu chưa có tài khoản, <a href="{{ route('register') }}">đăng kí ở đây</a></small>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section>
    </main>


@endsection
