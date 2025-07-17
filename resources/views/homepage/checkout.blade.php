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

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

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
                                <form class="checkout-form" action="{{ route('checkout.store') }}" method="POST"
                                    id="checkoutForm" onsubmit="return validateForm(event)">
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
                                                <input type="text" name="ten_nguoi_nhan" class="form-control"
                                                    id="ten_nguoi_nhan" placeholder="Nhập họ và tên"
                                                    value="{{ old('ten_nguoi_nhan', auth()->user()->Ho . ' ' . auth()->user()->Ten) }}"
                                                    required>
                                                @error('ten_nguoi_nhan')
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
                                            @if ($addresses->isNotEmpty())
                                                {{-- Nếu có địa chỉ --}}
                                                <div class="form-group mb-3">
                                                    <label for="dia_chi_id">Chọn địa chỉ giao hàng <span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-select" id="dia_chi_id" name="dia_chi_id" required>
                                                        @foreach ($addresses as $address)
                                                            <option value="{{ $address->id }}"
                                                                data-sdt="{{ $address->SoDienThoai }}">
                                                                {{ $address->khachhang->Ho }} {{ $address->khachhang->Ten }} -
                                                                {{ $address->dia_chi_cu_the }},
                                                                {{ optional($address->phuongXa)->ten }},
                                                                {{ optional($address->quanHuyen)->ten }},
                                                                {{ optional($address->tinhThanh)->ten }} -
                                                                {{ $address->so_dien_thoai }}
                                                                @if ($address->MacDinh)
                                                                    (Mặc định)
                                                                @endif
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                {{-- Nút thêm địa chỉ mới --}}
                                                <div class="mb-3">
                                                    <button type="button" class="btn btn-outline-primary btn-sm"
                                                        id="show-new-address">
                                                        + Thêm địa chỉ mới
                                                    </button>
                                                </div>

                                                {{-- Form thêm địa chỉ mới (ẩn ban đầu) --}}
                                                <div id="new-address-form" style="display: none;">
                                                    @include('homepage.partials.address-form', [
                                                        'isFirst' => false,
                                                    ])
                                                </div>
                                            @else
                                                {{-- Nếu chưa có địa chỉ, hiện nút để thêm địa chỉ đầu tiên --}}
                                                <div class="mb-3">
                                                    <button type="button" class="btn btn-outline-success"
                                                        id="show-new-address">
                                                        + Thêm địa chỉ giao hàng
                                                    </button>
                                                </div>

                                                {{-- Form nhập địa chỉ đầu tiên (ẩn ban đầu) --}}
                                                <div id="new-address-form" style="display: none;">
                                                    @include('homepage.partials.address-form', [
                                                        'isFirst' => true,
                                                    ])
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Phương thức thanh toán --}}

                                    <div class="checkout-section" id="payment-method">
                                        <div class="section-header">
                                            <div class="section-number">3</div>
                                            <h3>Phương Thức Thanh Toán</h3>
                                        </div>
                                        <div class="section-content">
                                            <div class="payment-options">
                                                <div class="payment-option active">
                                                    <input type="radio" name="phuong_thuc_thanh_toan" id="cod"
                                                        value="cod" checked>
                                                    <label for="cod">
                                                        <span class="payment-icon"><i class="bi bi-cash"></i></span>
                                                        <span class="payment-label">Thanh toán khi nhận hàng (COD)</span>
                                                    </label>
                                                </div>
                                                <div class="payment-option">
                                                    <input type="radio" name="phuong_thuc_thanh_toan" id="vnpay"
                                                        value="vnpay">
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
                                                <p class="payment-info">Bạn sẽ được chuyển hướng đến cổng thanh toán VNPay để
                                                    hoàn tất giao dịch.</p>
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
                                    <a href="#" class="btn btn-primary ms-2"
                                        onclick="showLoginPopup(event, '{{ route('login') }}')">Đăng nhập ngay
                                    </a>
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
                                                <img src="{{ asset('image/book/' . ltrim($item['book']['HinhAnh'], '/')) }}"
                                                    alt="{{ $item['book']['TenSach'] }}">
                                            </div>
                                            <div class="order-item-details">
                                                <h4>{{ $item['book']['TenSach'] }}</h4>
                                                <div class="order-item-price">
                                                    <span class="quantity">{{ $item['quantity'] }} ×</span>
                                                    <span
                                                        class="price">{{ number_format($item['book']['GiaBan'], 0, ',', '.') }}
                                                        ₫</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
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
                                    <div class="order-new-total d-flex justify-content-between fw-bold">
                                        <span>Tổng cộng</span>
                                        <span id="new_total_display">{{ number_format($total, 0, ',', '.') }} ₫</span>
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
                if (phoneError) phoneError.textContent = 'Số điện thoại phải là 10 chữ số.';
                return false;
            } else {
                if (phoneError) phoneError.textContent = '';
                return true;
            }
        }
        document.addEventListener('DOMContentLoaded', function() {
            const diaChiIdSelect = document.getElementById('dia_chi_id');
            const sdtInput = document.getElementById('so_dien_thoai');

            if (diaChiIdSelect && sdtInput) {
                const selectedOption = diaChiIdSelect.options[diaChiIdSelect.selectedIndex];
                const phone = selectedOption.getAttribute('data-sdt');
                if (phone) {
                    sdtInput.value = phone;
                }
            }
        });
        document.getElementById('so_dien_thoai')?.addEventListener('input', function() {
            validatePhone(this.value);
        });

        document.getElementById('tinh_thanh_id')?.addEventListener('change', function() {
            const tinhThanhId = this.value;
            if (tinhThanhId) {
                fetch(`/api/quan-huyen/${tinhThanhId}`)
                    .then(res => res.json())
                    .then(data => {
                        const quanHuyenSelect = document.getElementById('quan_huyen_id');
                        quanHuyenSelect.innerHTML = '<option value="">Chọn Quận/Huyện</option>';
                        data.forEach(item => {
                            quanHuyenSelect.innerHTML +=
                                `<option value="${item.id}">${item.ten}</option>`;
                        });
                        document.getElementById('phuong_xa_id').innerHTML =
                            '<option value="">Chọn Phường/Xã</option>';
                    })
                    .catch(err => console.error('Lỗi tải Quận/Huyện:', err));
            }
        });

        document.getElementById('quan_huyen_id')?.addEventListener('change', function() {
            const quanHuyenId = this.value;
            if (quanHuyenId) {
                fetch(`/api/phuong-xa/${quanHuyenId}`)
                    .then(res => res.json())
                    .then(data => {
                        const phuongXaSelect = document.getElementById('phuong_xa_id');
                        phuongXaSelect.innerHTML = '<option value="">Chọn Phường/Xã</option>';
                        data.forEach(item => {
                            phuongXaSelect.innerHTML +=
                                `<option value="${item.id}">${item.ten}</option>`;
                        });
                    })
                    .catch(err => console.error('Lỗi tải Phường/Xã:', err));
            }
        });

        document.querySelectorAll('input[name="phuong_thuc_thanh_toan"]').forEach(input => {
            input.addEventListener('change', function() {
                document.querySelectorAll('.payment-details').forEach(detail => detail.classList.add(
                    'd-none'));
                document.getElementById(`${this.id}-details`)?.classList.remove('d-none');
            });
        });

        document.getElementById('show-new-address')?.addEventListener('click', () => {
            const newForm = document.getElementById('new-address-form');
            const diaChiId = document.getElementById('dia_chi_id');
            const toggleBtn = document.getElementById('show-new-address');

            if (!window._prevSelectedIndex) window._prevSelectedIndex = 0;

            if (newForm.style.display === 'block') {
                newForm.style.display = 'none';
                newForm.querySelectorAll('input, select, textarea').forEach(el => {
                    if (el.type === 'checkbox' || el.type === 'radio') {
                        el.checked = false;
                    } else {
                        el.value = '';
                    }
                });
                ['tinh_thanh_id', 'quan_huyen_id', 'phuong_xa_id'].forEach(id => {
                    const el = document.getElementById(id);
                    if (el) el.selectedIndex = 0;
                });
                const phoneError = document.getElementById('so_dien_thoai_error');
                if (phoneError) phoneError.textContent = '';

                if (diaChiId) {
                    diaChiId.disabled = false;
                    diaChiId.setAttribute('required', 'required');
                    diaChiId.selectedIndex = window._prevSelectedIndex; // Khôi phục lựa chọn trước đó
                }

                toggleAddressValidation();
                toggleBtn.textContent = '+ Thêm địa chỉ mới';
            } else {
                if (diaChiId) {
                    window._prevSelectedIndex = diaChiId.selectedIndex;
                    diaChiId.value = '';
                    diaChiId.removeAttribute('required');
                    diaChiId.disabled = true;
                }

                newForm.style.display = 'block';
                toggleAddressValidation();
                toggleBtn.textContent = 'Đóng';
            }
        });

        function toggleAddressValidation() {
            const isNewAddress = document.getElementById('new-address-form')?.style.display === 'block';
            const requiredFields = ['tinh_thanh_id', 'quan_huyen_id', 'phuong_xa_id', 'dia_chi_cu_the', 'so_dien_thoai'];

            requiredFields.forEach(field => {
                const el = document.getElementById(field);
                if (el) {
                    if (isNewAddress) {
                        el.setAttribute('required', 'required');
                    } else {
                        el.removeAttribute('required');
                    }
                }
            });
        }

        function validateForm(event) {
            event.preventDefault();
            let errorMessages = [];

            const newAddressFormVisible = document.getElementById('new-address-form')?.style.display === 'block';
            const paymentMethod = document.querySelector('input[name="phuong_thuc_thanh_toan"]:checked')?.value;
            const diaChiIdSelect = document.getElementById('dia_chi_id');
            const form = document.getElementById('checkoutForm');
            const showNewAddressBtn = document.getElementById('show-new-address');

            console.log('Validating form...');
            console.log('newAddressFormVisible:', newAddressFormVisible);
            console.log('diaChiId value:', diaChiIdSelect ? diaChiIdSelect.value : 'null');
            console.log('paymentMethod:', paymentMethod);

            if (newAddressFormVisible) {
                const tenNguoiNhan = document.getElementById('ten_nguoi_nhan').value;
                const phone = document.getElementById('so_dien_thoai').value;
                const tinhThanhId = document.getElementById('tinh_thanh_id').value;
                const quanHuyenId = document.getElementById('quan_huyen_id').value;
                const phuongXaId = document.getElementById('phuong_xa_id').value;
                const diaChiCuThe = document.getElementById('dia_chi_cu_the').value;

                if (!tenNguoiNhan) errorMessages.push('Vui lòng nhập Họ và Tên.');
                if (!validatePhone(phone)) errorMessages.push('Số điện thoại phải là 10 chữ số.');
                if (!tinhThanhId) errorMessages.push('Vui lòng chọn Tỉnh/Thành Phố.');
                if (!quanHuyenId) errorMessages.push('Vui lòng chọn Quận/Huyện.');
                if (!phuongXaId) errorMessages.push('Vui lòng chọn Phường/Xã.');
                if (!diaChiCuThe) errorMessages.push('Vui lòng nhập Địa Chỉ Cụ Thể.');
            } else if (diaChiIdSelect && !diaChiIdSelect.value) {
                errorMessages.push(
                    'Vui lòng chọn địa chỉ giao hàng từ danh sách hoặc thêm địa chỉ mới bằng cách nhấn vào nút "+ Thêm địa chỉ mới".'
                );
            }

            if (!paymentMethod) {
                errorMessages.push('Vui lòng chọn Phương Thức Thanh Toán.');
            }

            if (errorMessages.length > 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi khi đặt hàng',
                    html: errorMessages.join('<br>'),
                    confirmButtonText: 'OK',
                    didOpen: () => {
                        // Thêm nút "Thêm địa chỉ" trong popup
                        const addAddressBtn = document.createElement('button');
                        addAddressBtn.id = 'add-address-btn';
                        addAddressBtn.className = 'btn btn-primary mt-2';
                        addAddressBtn.textContent = 'Thêm địa chỉ mới';
                        addAddressBtn.addEventListener('click', () => {
                            showNewAddressBtn.click();
                            Swal.close();
                        });
                        Swal.getHtmlContainer().appendChild(addAddressBtn);
                    }
                }).then(() => {
                    console.log('Popup closed, restoring UI...');
                    if (newAddressFormVisible) {
                        document.getElementById('new-address-form').style.display = 'block';
                    } else if (diaChiIdSelect) {
                        diaChiIdSelect.disabled = false;
                        if (showNewAddressBtn && showNewAddressBtn.textContent === 'Đóng') {
                            showNewAddressBtn.click();
                        }
                        if (diaChiIdSelect.options.length > 0) {
                            diaChiIdSelect.selectedIndex = window._prevSelectedIndex || 0;
                        }
                    }
                    toggleAddressValidation();
                });
                return false;
            }

            form.submit();
        }
    </script>
    <script>
function applyPromoCode() {
    const codeInput = document.getElementById('promo_code_input');
    if (!codeInput) {
        console.error('Không tìm thấy input promo_code_input.');
        return;
    }

    const code = codeInput.value.trim();
    if (!code) {
        alert('Vui lòng nhập mã khuyến mãi trước khi áp dụng.');
        return;
    }

    const orderTotal = {{ $tongTien ?? 0 }};

    fetch('{{ route('khuyenmai.apply') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            code: code,
            order_total: orderTotal
        })
    })
    .then(async response => {
        const text = await response.text();
        let data;
        try {
            data = JSON.parse(text);
        } catch (e) {
            console.error('Server returned invalid JSON:', text);
            throw new Error('Máy chủ trả về dữ liệu không hợp lệ.');
        }

        if (!response.ok) {
            throw new Error(data.error || `Lỗi ${response.status}: ${response.statusText}`);
        }
        return data;
    })
    .then(data => {
        alert(data.message);

        const discountEl = document.getElementById('discount_display');
        if (discountEl) {
            discountEl.innerText = data.discount.toLocaleString() + ' ₫';
        }

        const newTotalEl = document.getElementById('new_total_display');
        if (newTotalEl) {
            newTotalEl.innerText = data.new_total.toLocaleString() + ' ₫';
        }

        const promoSection = document.getElementById('promo_code_section');
        if (promoSection) {
            promoSection.style.display = 'flex';
        }

        const promoLabel = document.getElementById('promo_code_label');
        if (promoLabel) {
            promoLabel.innerText = data.code;
        }

        const promoValue = document.getElementById('promo_code_value');
        if (promoValue) {
            promoValue.innerText = (data.kieu === 'phantram')
                ? `-${data.giatri}%`
                : `-${parseInt(data.giatri).toLocaleString()} ₫`;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert(error.message || 'Có lỗi xảy ra khi áp dụng mã.');
    });
}

function removePromoCode() {
    fetch('{{ route('khuyenmai.remove') }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(async response => {
        const text = await response.text();
        let data;
        try {
            data = JSON.parse(text);
        } catch (e) {
            console.error('Server returned:', text);
            throw new Error('Đã xảy ra lỗi không mong muốn.');
        }

        if (!response.ok) {
            throw new Error(data.error || 'Có lỗi xảy ra khi hủy mã.');
        }
        return data;
    })
    .then(data => {
        alert(data.message);

        const promoSection = document.getElementById('promo_code_section');
        if (promoSection) {
            promoSection.style.display = 'none';
        }

        const discountEl = document.getElementById('discount_display');
        if (discountEl) {
            discountEl.innerText = '0 ₫'; // Hoặc '--' nếu bạn muốn
        }

        const newTotalEl = document.getElementById('new_total_display');
        if (newTotalEl) {
            newTotalEl.innerText = '{{ number_format($total, 0, ",", ".") }} ₫';
        }
        const promoLabel = document.getElementById('promo_code_label');
        if (promoLabel) {
            promoLabel.innerText = '--'; // hoặc ''
        }

        const promoValue = document.getElementById('promo_code_value');
        if (promoValue) {
            promoValue.innerText = '--'; // hoặc '0 ₫'
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert(error.message || 'Có lỗi xảy ra khi hủy mã.');
    });
}
</script>

@endsection
