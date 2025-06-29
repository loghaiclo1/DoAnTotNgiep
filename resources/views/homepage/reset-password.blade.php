@extends('layout.main')

@section('title', 'BookShop - Đặt Lại Mật Khẩu')
@section('content')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title light-background">
            <div class="container d-lg-flex justify-content-between align-items-center">
                <h1 class="mb-2 mb-lg-0">Đặt Lại Mật Khẩu</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="{{ url('/') }}">Trang chủ</a></li>
                        <li class="current">Đặt Lại Mật Khẩu</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- End Page Title -->

        <section id="reset-password" class="login-register section">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="login-register-wraper">

                            <div class="tab-content">
                                <div class="tab-pane fade show active">

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            @foreach ($errors->all() as $error)
                                                <div>{{ $error }}</div>
                                            @endforeach
                                        </div>
                                    @endif

                                    <form method="POST" action="{{ route('password.update') }}">
                                        @csrf

                                        <input type="hidden" name="token" value="{{ $token }}">
                                        <input type="hidden" name="email" value="{{ $email }}">

                                        <div class="mb-4">
                                            <label for="password" class="form-label">Mật khẩu mới</label>
                                            <div class="input-group">
                                                <input type="password" name="password" id="password" class="form-control"
                                                    placeholder="Nhập mật khẩu mới" required>
                                                <button class="btn btn-outline-secondary" type="button"
                                                    onclick="togglePassword('password', this)">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </div>
                                            @error('password')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-4">
                                            <label for="password_confirmation" class="form-label">Xác nhận mật khẩu
                                                mới</label>
                                            <div class="input-group">
                                                <input type="password" name="password_confirmation"
                                                    id="password_confirmation" class="form-control"
                                                    placeholder="Xác nhận mật khẩu mới" required>
                                                <button class="btn btn-outline-secondary" type="button"
                                                    onclick="togglePassword('password_confirmation', this)">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary btn-lg">Đặt Lại Mật Khẩu</button>
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

@push('scripts')
    <script>
        function togglePasswordAll(btn) {
            const fields = [document.getElementById('password'), document.getElementById('password_confirmation')];
            let show = fields[0].type === "password";

            fields.forEach(field => {
                field.type = show ? "text" : "password";
            });

            const icon = btn.querySelector('i');
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        }
    </script>
@endpush
