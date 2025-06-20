@extends('layout.main')

@section('title', 'BookShop - Thanh Toán')

@section('content')
<main class="main">
    <div class="page-title light-background">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Thanh Toán</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li class="current">Thanh Toán</li>
                </ol>
            </nav>
        </div>
    </div>

    <section id="checkout" class="checkout section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="row">
                <div class="col-lg-7">
                    <div class="checkout-container" data-aos="fade-up">
                        @auth
                            <form class="checkout-form" action="{{ route('checkout.store') }}" method="POST" id="checkoutForm" onsubmit="return validateForm(event)">
                                @csrf
                                <input type="hidden" name="khachhang_id" value="{{ auth()->id() }}">
                                <input type="hidden" name="subtotal" value="{{ $subtotal }}">
                                <input type="hidden" name="shipping" value="{{ $shipping }}">
                                <input type="hidden" name="total" value="{{ $total }}">

                                <div class="checkout-section" id="customer-info">
                                    <div class="section-header">
                                        <div class="section-number">1</div>
                                        <h3>Thông Tin Người Nhận</h3>
                                    </div>
                                    <div class="section-content">
                                        <div class="form-group mb-3">
                                            <label for="ten_nguoi_nhan">Họ và Tên <span class="text-danger">*</span></label>
                                            <input type="text" name="ten_nguoi_nhan" class="form-control" id="ten_nguoi_nhan" placeholder="Nhập họ và tên" value="{{ old('ten_nguoi_nhan', auth()->user()->Ho . ' ' . auth()->user()->Ten) }}" required>
                                            @error('ten_nguoi_nhan')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="so_dien_thoai">Số Điện Thoại <span class="text-danger">*</span></label>
                                            <input type="tel" class="form-control" name="so_dien_thoai" id="so_dien_thoai" placeholder="Nhập số điện thoại" value="{{ old('so_dien_thoai') }}" pattern="[0-9]{10}" required title="Vui lòng nhập số điện thoại 10 chữ số">
                                            <div id="so_dien_thoai_error" class="text-danger"></div>
                                            @error('so_dien_thoai')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="ghi_chu">Ghi Chú</label>
                                            <textarea name="ghi_chu" class="form-control" id="ghi_chu" placeholder="Nhập ghi chú (nếu có)" rows="4">{{ old('ghi_chu') }}</textarea>
                                            @error('ghi_chu')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="checkout-section" id="shipping-address">
                                    <div class="section-header">
                                        <div class="section-number">2</div>
                                        <h3>Địa Chỉ Giao Hàng</h3>
                                    </div>
                                    <div class="section-content">
                                        <div class="form-group mb-3">
                                            <label for="tinh_thanh_id">Tỉnh/Thành Phố <span class="text-danger">*</span></label>
                                            <select class="form-select" id="tinh_thanh_id" name="tinh_thanh_id" required>
                                                <option value="">Chọn Tỉnh/Thành Phố</option>
                                                @foreach ($tinhThanhs as $tinhThanh)
                                                    <option value="{{ $tinhThanh->id }}" {{ old('tinh_thanh_id') == $tinhThanh->id ? 'selected' : '' }}>{{ $tinhThanh->ten }}</option>
                                                @endforeach
                                            </select>
                                            @error('tinh_thanh_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="quan_huyen_id">Quận/Huyện <span class="text-danger">*</span></label>
                                            <select class="form-select" id="quan_huyen_id" name="quan_huyen_id" required>
                                                <option value="">Chọn Quận/Huyện</option>
                                            </select>
                                            @error('quan_huyen_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="phuong_xa_id">Phường/Xã <span class="text-danger">*</span></label>
                                            <select class="form-select" id="phuong_xa_id" name="phuong_xa_id" required>
                                                <option value="">Chọn Phường/Xã</option>
                                            </select>
                                            @error('phuong_xa_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="dia_chi_cu_the">Địa Chỉ Cụ Thể <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="dia_chi_cu_the" id="dia_chi_cu_the" placeholder="Số nhà, tên đường" value="{{ old('dia_chi_cu_the') }}" required>
                                            @error('dia_chi_cu_the')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" id="save-address" name="save-address">
                                            <label class="form-check-label" for="save-address">Lưu địa chỉ này cho các đơn hàng sau</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="checkout-section" id="payment-method">
                                    <div class="section-header">
                                        <div class="section-number">3</div>
                                        <h3>Phương Thức Thanh Toán</h3>
                                    </div>
                                    <div class="section-content">
                                        <div class="payment-options">
                                            <div class="payment-option active">
                                                <input type="radio" name="payment_method" id="cod" value="cod" checked>
                                                <label for="cod">
                                                    <span class="payment-icon"><i class="bi bi-cash"></i></span>
                                                    <span class="payment-label">Thanh toán khi nhận hàng (COD)</span>
                                                </label>
                                            </div>
                                            <div class="payment-option">
                                                <input type="radio" name="payment_method" id="vnpay" value="vnpay">
                                                <label for="vnpay">
                                                    <span class="payment-icon"><i class="bi bi-credit-card"></i></span>
                                                    <span class="payment-label">Thanh toán bằng VNPay</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="payment-details" id="cod-details">
                                            <p class="payment-info">Bạn sẽ thanh toán bằng tiền mặt khi nhận hàng.</p>
                                        </div>
                                        <div class="payment-details d-none" id="vnpay-details">
                                            <p class="payment-info">Bạn sẽ được chuyển hướng đến cổng thanh toán VNPay để hoàn tất giao dịch.</p>
                                            <ul>
                                                <li>Thanh toán an toàn và bảo mật</li>
                                                <li>Mã đơn hàng sẽ được tạo sau khi xác nhận</li>
                                            </ul>
                                        </div>
                                        @error('payment_method')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="checkout-section" id="order-review">
                                    <div class="section-header">
                                        <div class="section-number">4</div>
                                        <h3>Xác Nhận Đơn Hàng</h3>
                                    </div>
                                    <div class="section-content">
                                        <div class="place-order-container">
                                            <button type="submit" class="btn btn-primary place-order-btn w-100">
                                                <span class="btn-text">Đặt Hàng</span>
                                                <span class="btn-price">{{ number_format($total, 0, ',', '.') }} ₫</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @else
                            <div class="alert alert-warning">
                                Vui lòng đăng nhập để tiếp tục thanh toán.
                                <a href="#" class="btn btn-primary ms-2" onclick="showLoginPopup(event, '{{ route('login') }}')">Đăng nhập ngay</a>
                            </div>
                        @endauth
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="order-summary" data-aos="fade-left" data-aos-delay="200">
                        <div class="order-summary-header">
                            <h3>Tóm Tắt Đơn Hàng</h3>
                            <span class="item-count">{{ $groupedCartItems->sum('quantity') }} Sản phẩm</span>
                        </div>
                        <div class="order-summary-content">
                            <div class="order-items">
                                @foreach ($groupedCartItems as $item)
                                    <div class="order-item">
                                        <div class="order-item-image">
                                            <img src="{{ asset('image/book/' . ltrim($item['book']->HinhAnh, '/')) }}" alt="{{ $item['book']->TenSach }}">
                                        </div>
                                        <div class="order-item-details">
                                            <h4>{{ $item['book']->TenSach }}</h4>
                                            <div class="order-item-price">
                                                <span class="quantity">{{ $item['quantity'] }} ×</span>
                                                <span class="price">{{ number_format($item['book']->GiaBan, 0, ',', '.') }} ₫</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="promo-code mb-3">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="promo_code" placeholder="Mã khuyến mãi" aria-label="Mã khuyến mãi">
                                    <button class="btn btn-outline-primary" type="button" onclick="applyPromoCode()">Áp dụng</button>
                                </div>
                                @error('promo_code')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="order-totals">
                                <div class="order-subtotal d-flex justify-content-between">
                                    <span>Tạm tính</span>
                                    <span>{{ number_format($subtotal, 0, ',', '.') }} ₫</span>
                                </div>
                                <div class="order-shipping d-flex justify-content-between">
                                    <span>Phí vận chuyển</span>
                                    <span>{{ number_format($shipping, 0, ',', '.') }} ₫</span>
                                </div>
                                @if (session('promo'))
    <div class="order-discount d-flex justify-content-between text-success fw-semibold">
        <span>Giảm mã ({{ session('promo.MaCode') }})</span>
        <span>
            @if (session('promo.Kieu') === 'percent')
                -{{ session('promo.GiaTri') }}%
            @else
                -{{ number_format(session('promo.GiaTri'), 0, ',', '.') }} ₫
            @endif
        </span>
    </div>
@endif

                                <div class="order-total d-flex justify-content-between">
                                    <span>Tổng cộng</span>
                                    <span>{{ number_format($total, 0, ',', '.') }} ₫</span>
                                </div>
                            </div>
                            <div class="secure-checkout mt-3">
                                <div class="secure-checkout-header">
                                    <i class="bi bi-shield-lock"></i>
                                    <span>Thanh Toán An Toàn</span>
                                </div>
                                <div class="payment-icons">
                                    <i class="bi bi-cash"></i>
                                    <i class="bi bi-bank"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script>
    function validatePhone(phone) {
        const phonePattern = /^[0-9]{10}$/;
        const phoneError = document.getElementById('so_dien_thoai_error');
        if (!phonePattern.test(phone)) {
            phoneError.textContent = 'Số điện thoại phải là 10 chữ số.';
            return false;
        } else {
            phoneError.textContent = '';
            return true;
        }
    }

    document.getElementById('so_dien_thoai')?.addEventListener('input', function() {
        validatePhone(this.value);
    });

    document.getElementById('tinh_thanh_id')?.addEventListener('change', function() {
        const tinhThanhId = this.value;
        if (tinhThanhId) {
            fetch(`/api/quan-huyen/${tinhThanhId}`)
                .then(response => response.json())
                .then(data => {
                    const quanHuyenSelect = document.getElementById('quan_huyen_id');
                    quanHuyenSelect.innerHTML = '<option value="">Chọn Quận/Huyện</option>';
                    data.forEach(item => {
                        quanHuyenSelect.innerHTML += `<option value="${item.id}">${item.ten}</option>`;
                    });
                    document.getElementById('phuong_xa_id').innerHTML = '<option value="">Chọn Phường/Xã</option>';
                })
                .catch(error => console.error('Lỗi tải Quận/Huyện:', error));
        }
    });

    document.getElementById('quan_huyen_id')?.addEventListener('change', function() {
        const quanHuyenId = this.value;
        if (quanHuyenId) {
            fetch(`/api/phuong-xa/${quanHuyenId}`)
                .then(response => response.json())
                .then(data => {
                    const phuongXaSelect = document.getElementById('phuong_xa_id');
                    phuongXaSelect.innerHTML = '<option value="">Chọn Phường/Xã</option>';
                    data.forEach(item => {
                        phuongXaSelect.innerHTML += `<option value="${item.id}">${item.ten}</option>`;
                    });
                })
                .catch(error => console.error('Lỗi tải Phường/Xã:', error));
        }
    });

    document.querySelectorAll('input[name="payment_method"]').forEach(input => {
        input.addEventListener('change', function() {
            document.querySelectorAll('.payment-details').forEach(detail => detail.classList.add('d-none'));
            document.getElementById(`${this.id}-details`).classList.remove('d-none');
        });
    });

    function applyPromoCode() {
        const promoCode = document.querySelector('input[name="promo_code"]').value;
        if (promoCode) {
            Swal.fire('Thông báo', 'Chức năng áp dụng mã khuyến mãi đang được phát triển!', 'info');
        } else {
            Swal.fire('Lỗi', 'Vui lòng nhập mã khuyến mãi!', 'error');
        }
    }

    function validateForm(event) {
        event.preventDefault();
        let isValid = true;
        let errorMessages = [];

        const phone = document.getElementById('so_dien_thoai').value;
        if (!validatePhone(phone)) {
            errorMessages.push('Số điện thoại phải là 10 chữ số.');
            isValid = false;
        }

        const tenNguoiNhan = document.getElementById('ten_nguoi_nhan').value;
        const tinhThanhId = document.getElementById('tinh_thanh_id').value;
        const quanHuyenId = document.getElementById('quan_huyen_id').value;
        const phuongXaId = document.getElementById('phuong_xa_id').value;
        const diaChiCuThe = document.getElementById('dia_chi_cu_the').value;
        const paymentMethod = document.querySelector('input[name="payment_method"]:checked')?.value;

        if (!tenNguoiNhan) errorMessages.push('Vui lòng nhập Họ và Tên.');
        if (!tinhThanhId) errorMessages.push('Vui lòng chọn Tỉnh/Thành Phố.');
        if (!quanHuyenId) errorMessages.push('Vui lòng chọn Quận/Huyện.');
        if (!phuongXaId) errorMessages.push('Vui lòng chọn Phường/Xã.');
        if (!diaChiCuThe) errorMessages.push('Vui lòng nhập Địa Chỉ Cụ Thể.');
        if (!paymentMethod) errorMessages.push('Vui lòng chọn Phương Thức Thanh Toán.');

        if (!isValid) {
            Swal.fire({
                icon: 'error',
                title: 'Lỗi',
                html: errorMessages.join('<br>'),
                confirmButtonText: 'OK'
            });
            return false;
        }

        const form = document.getElementById('checkoutForm');

        if (paymentMethod === 'vnpay') {
            form.action = "{{ route('vnpay.payment') }}";
            form.method = "POST";
        } else {
            form.action = "{{ route('checkout.store') }}";
            form.method = "POST";
        }

        form.submit();
    }
    function applyPromoCode() {
    const code = document.querySelector('input[name="promo_code"]').value;

    fetch('{{ route('promo.apply') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ promo_code: code })
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            alert(data.message);
            location.reload(); // hoặc cập nhật lại giá tạm tính
        } else {
            alert(data.message);
        }
    })
    .catch(err => {
        alert('Đã xảy ra lỗi khi áp dụng mã.');
        console.error(err);
    });
}
</script>

@endsection
