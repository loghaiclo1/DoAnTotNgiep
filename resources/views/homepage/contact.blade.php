@extends('layout.main')

@section('title', 'eStore - Liên hệ')

@section('content')
<main class="main">
    <div class="page-title light-background">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Liên hệ</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li>Trang chủ</li>
                    <li class="current">Liên hệ</li>
                </ol>
            </nav>
        </div>
    </div>

    <section id="contact-2" class="contact-2 section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4">
                <div class="col-lg-6">
                    <div class="info-item text-center" data-aos="fade-up" data-aos-delay="200">
                        <i class="bi bi-geo-alt d-block mx-auto"></i>
                        <h3>Địa chỉ</h3>
                        <p>{{ $thongTinChung->dia_chi ?? 'Không có dữ liệu' }}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="info-item text-center" data-aos="fade-up" data-aos-delay="300">
                        <i class="bi bi-geo-alt d-block mx-auto"></i>
                        <h3>Gọi cho chúng tôi</h3>
                        <p>{{ $thongTinChung->dien_thoai ?? 'Không có dữ liệu' }}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="info-item text-center" data-aos="fade-up" data-aos-delay="400">
                        <i class="bi bi-geo-alt d-block mx-auto"></i>
                        <h3>Email</h3>
                        <p>{{ $thongTinChung->email ?? 'Không có dữ liệu' }}</p>
                    </div>
                </div>
            </div>

            <div class="row gy-4 mt-4">
                <div class="col-12 text-center">
                    <form id="contactForm" action="{{ route('contact.store') }}" method="POST" class="php-email-form" data-aos="fade-up" data-aos-delay="400" novalidate>
                        @csrf
                        <div class="row gy-4">
                            <div class="col-md-6">
                                <input type="text" name="ho_ten" id="ho_ten" class="form-control" placeholder="Tên của bạn" required>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-6">
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email của bạn" required>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-12">
                                <input type="text" name="chu_de" id="chu_de" class="form-control" placeholder="Chủ đề" required>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-12">
                                <textarea name="noi_dung" id="noi_dung" rows="6" class="form-control" placeholder="Nội dung tin nhắn" required></textarea>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary" id="submitBtn">Gửi tin nhắn</button>
                            </div>
                        </div>
                        <div id="sendMessage" class="alert alert-success text-center mt-3" style="display:none;">
                            Thông tin liên hệ của bạn đã được gửi. Cảm ơn bạn!
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('contactForm');
        const sendMessage = document.getElementById('sendMessage');

        form.addEventListener('submit', function (e) {
            e.preventDefault(); // Ngăn gửi form theo cách truyền thống

            let isValid = true;

            // Kiểm tra các trường bắt buộc
            const inputs = form.querySelectorAll('input[required], textarea[required]');
            inputs.forEach(input => {
                const feedback = input.nextElementSibling;
                if (!input.value.trim()) {
                    input.classList.add('is-invalid');
                    feedback.style.display = 'block';
                    feedback.textContent = 'Trường này không được để trống.';
                    isValid = false;
                } else {
                    input.classList.remove('is-invalid');
                    feedback.style.display = 'none';
                }
            });

            // Kiểm tra định dạng email
            const emailInput = form.querySelector('input[type="email"]');
            const emailFeedback = emailInput.nextElementSibling;
            const emailValue = emailInput.value.trim();

            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (emailValue && !emailPattern.test(emailValue)) {
                emailInput.classList.add('is-invalid');
                emailFeedback.style.display = 'block';
                emailFeedback.textContent = 'Email không đúng định dạng.';
                isValid = false;
            } else if(emailValue) {
                emailInput.classList.remove('is-invalid');
                emailFeedback.style.display = 'none';
            }

            if (!isValid) {
                return; // Nếu có lỗi, dừng gửi
            }

            // Tạo dữ liệu gửi đi
            const formData = new FormData(form);

            // Gửi AJAX với fetch API
            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json',
                },
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    // Nếu server trả lỗi, ném ra để catch bắt
                    throw new Error('Lỗi khi gửi form');
                }
                return response.json();
            })
            .then(data => {
                // Hiển thị thông báo thành công
                sendMessage.style.display = 'block';

                // Reset form
                form.reset();

                // Ẩn thông báo sau 5 giây
                setTimeout(() => {
                    sendMessage.style.display = 'none';
                }, 5000);
            })
            .catch(error => {
                alert('Đã xảy ra lỗi khi gửi thông tin. Vui lòng thử lại.');
                console.error(error);
            });
        });
    });
    </script>

@endsection
