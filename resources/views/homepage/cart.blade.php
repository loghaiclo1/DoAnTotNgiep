```blade
@extends('layout.main')

@section('title', 'BookShop - Giỏ Hàng')
@section('content')
    <main class="main">
        <!-- Page Title -->
        <div class="page-title light-background">
            <div class="container d-lg-flex justify-content-between align-items-center">
                <h1 class="mb-2 mb-lg-0">Giỏ Hàng</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="{{ url('/') }}">Trang Chủ</a></li>
                        <li class="current">Giỏ Hàng</li>
                    </ol>
                </nav>
            </div>
        </div><!-- End Page Title -->

        <!-- Cart Section -->
        <section id="cart" class="cart section">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <div class="row g-4">
                    <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
                        <div class="cart-items">
                            <div class="cart-header d-none d-lg-block">
                                <div class="row align-items-center gy-4">
                                    <div class="col-lg-6">
                                        <h5>Sản phẩm</h5>
                                    </div>
                                    <div class="col-lg-2 text-center">
                                        <h5>Giá</h5>
                                    </div>
                                    <div class="col-lg-2 text-center">
                                        <h5>Số lượng</h5>
                                    </div>
                                    <div class="col-lg-2 text-center">
                                        <h5>Tổng</h5>
                                    </div>
                                </div>
                            </div>

                            @if (!is_array($cart))
                                <p>Giỏ hàng của bạn đang trống.</p>
                            @else
                                <form action="{{ route('cart.update') }}" method="POST" id="cartForm">
                                    @csrf
                                    @foreach ($cart as $id => $item)
                                        <div class="cart-item" data-aos="fade-up" data-aos-delay="100">
                                            <div class="row align-items-center gy-4">
                                                <div class="col-lg-6 col-12 mb-3 mb-lg-0">
                                                    <div class="product-info d-flex align-items-center">
                                                        <div class="product-image">
                                                            <img src="{{ asset('image/book/' . $item['image']) }}"
                                                                 alt="{{ $item['name'] }}" class="img-fluid"
                                                                 loading="lazy">
                                                        </div>
                                                        <div class="product-details">
                                                            <h6 class="product-title">{{ $item['name'] }}</h6>
                                                            <button type="button" class="remove-item btn btn-danger btn-sm"
                                                                    data-book-id="{{ $id }}">
                                                                <i class="bi bi-trash"></i> Xóa
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-12 text-center">
                                                    <div class="price-tag">
                                                        <span
                                                            class="current-price">{{ number_format($item['price'], 0, ',', '.') }}₫</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-12 text-center">
                                                    <div class="quantity-selector" data-book-id="{{ $id }}">
                                                        <button type="button" class="btn btn-sm btn-outline-secondary decrease-quantity"
                                                                data-book-id="{{ $id }}" data-quantity="{{ $item['quantity'] }}"
                                                                @if ($item['quantity'] <= 1) disabled @endif>-</button>
                                                        <input type="number" name="quantity[{{ $id }}]"
                                                               class="quantity-input form-control d-inline-block w-25 text-center"
                                                               value="{{ $item['quantity'] }}" min="1" max="10000">
                                                        <button type="button" class="btn btn-sm btn-outline-secondary increase-quantity"
                                                                data-book-id="{{ $id }}" data-quantity="{{ $item['quantity'] }}">+</button>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-12 text-center mt-3 mt-lg-0">
                                                    <div class="item-total">
                                                        <span class="item-total-value">{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}₫</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="cart-actions mt-4">
                                        <div class="row g-3">
                                            <div class="col-lg-6 col-md-6">
                                                <div class="coupon-form">
                                                    <div class="input-group">
                                                        <!-- Thêm mã giảm giá nếu cần -->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 text-md-end">
                                                <button type="submit" class="btn btn-outline-accent me-2">
                                                    <i class="bi bi-arrow-clockwise"></i> Cập nhật
                                                </button>
                                                <a href="{{ route('cart.clear') }}"
                                                   class="btn btn-outline-danger">
                                                    <i class="bi bi-trash"></i> Xóa tất cả
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                        <div class="cart-summary">
                            <h4 class="summary-title">Tổng đơn hàng</h4>

                            <div class="summary-item">
                                <span class="summary-label"></span>
                                <span class="summary-value" id="subtotal">{{ number_format($total, 0, ',', '.') }}₫</span>
                            </div>

                            <div class="summary-total">
                                <span class="summary-label">Tổng cộng</span>
                                <span class="summary-value" id="total">{{ number_format($total, 0, ',', '.') }}₫</span>
                            </div>

                            <div class="checkout-button">
                                <a href="#" class="btn btn-accent w-100">
                                    Thanh toán <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>

                            <div class="continue-shopping">
                                <a href="{{ url('/') }}" class="btn btn-link w-100">
                                    <i class="bi bi-arrow-left"></i> Tiếp tục mua sắm
                                </a>
                            </div>

                            <div class="payment-methods">
                                <p class="payment-title">Phương thức thanh toán</p>
                                <div class="payment-icons">
                                    <i class="bi bi-credit-card-2-front"></i>
                                    <i class="bi bi-paypal"></i>
                                    <i class="bi bi-wallet2"></i>
                                    <i class="bi bi-apple"></i>
                                    <i class="bi bi-google"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- /Cart Section -->
    </main>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const token = document.querySelector('meta[name="csrf-token"]')?.content;
            if (!token) {
                console.error('Không tìm thấy CSRF token!');
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: 'Không tìm thấy CSRF token. Vui lòng kiểm tra lại cấu hình.',
                    showConfirmButton: false,
                    timer: 3000
                });
                return;
            }

            function numberFormat(number) {
                return Math.floor(number).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
            }

            document.querySelectorAll('.remove-item').forEach(button => {
                button.replaceWith(button.cloneNode(true));
            });

            document.querySelectorAll('.remove-item').forEach(button => {
                button.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    const bookId = this.getAttribute('data-book-id');
                    const cartItem = this.closest('.cart-item');
                    console.log('Nút Xóa được nhấn với bookId:', bookId);

                    Swal.fire({
                        title: 'Xác nhận xóa',
                        text: 'Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Xóa',
                        cancelButtonText: 'Hủy',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            console.log('Xác nhận xóa, gửi yêu cầu đến server với bookId:', bookId);
                            fetch('/cart/remove/' + bookId, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-Token': token,
                                    'Accept': 'application/json',
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'Content-Type': 'application/json',
                                },
                                body: JSON.stringify({ _token: token, bookId: bookId })
                            })
                            .then(response => {
                                console.log('Phản hồi từ server - Status:', response.status);
                                if (!response.ok) {
                                    return response.json().then(data => {
                                        throw new Error(data.message || `Lỗi server: ${response.status} - ${response.statusText}`);
                                    });
                                }
                                return response.json();
                            })
                            .then(data => {
                                console.log('Dữ liệu phản hồi:', data);
                                if (data.status === 'success') {
                                    cartItem.remove();
                                    document.getElementById('subtotal').textContent = numberFormat(data.total) + '₫';
                                    document.getElementById('total').textContent = numberFormat(data.total) + '₫';
                                    if (document.querySelectorAll('.cart-item').length === 0) {
                                        document.querySelector('.cart-items').innerHTML = '<p>Giỏ hàng của bạn đang trống.</p>';
                                    }
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Thành công',
                                        text: data.message,
                                        timer: 1500,
                                        showConfirmButton: false,
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Lỗi',
                                        text: data.message || 'Xóa sản phẩm thất bại!',
                                    });
                                }
                            })
                            .catch(error => {
                                console.error('Lỗi xóa sản phẩm:', error);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Lỗi',
                                    text: 'Lỗi: ' + error.message,
                                });
                            });
                        } else {
                            console.log('Hủy xóa sản phẩm ID:', bookId);
                        }
                    });
                });
            });

            document.querySelectorAll('.increase-quantity, .decrease-quantity').forEach(button => {
                button.replaceWith(button.cloneNode(true));
            });

            document.querySelectorAll('.increase-quantity').forEach(button => {
                button.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    const bookId = this.getAttribute('data-book-id');
                    const quantityInput = this.closest('.quantity-selector').querySelector('.quantity-input');
                    let currentQuantity = parseInt(quantityInput.value);
                    const maxQuantity = parseInt(quantityInput.max);

                    if (currentQuantity < maxQuantity) {
                        currentQuantity += 1;
                        updateQuantity(bookId, currentQuantity, quantityInput, this.closest('.cart-item'));
                    }
                });
            });

            document.querySelectorAll('.decrease-quantity').forEach(button => {
                button.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    const bookId = this.getAttribute('data-book-id');
                    const quantityInput = this.closest('.quantity-selector').querySelector('.quantity-input');
                    let currentQuantity = parseInt(quantityInput.value);

                    if (currentQuantity > 1) {
                        currentQuantity -= 1;
                        updateQuantity(bookId, currentQuantity, quantityInput, this.closest('.cart-item'));
                    }
                });
            });

            function updateQuantity(bookId, newQuantity, quantityInput, cartItem) {
                console.log(`Cập nhật số lượng cho bookId: ${bookId}, số lượng mới: ${newQuantity}`);

                fetch('/cart/update', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-Token': token,
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        _token: token,
                        bookId: bookId,
                        quantity: newQuantity
                    })
                })
                .then(response => {
                    console.log('Phản hồi cập nhật số lượng - Status:', response.status);
                    if (!response.ok) {
                        return response.json().then(data => {
                            throw new Error(data.message || `Lỗi server: ${response.status} - ${response.statusText}`);
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Dữ liệu phản hồi cập nhật:', data);
                    if (data.status === 'success') {
                        quantityInput.value = newQuantity;
                        const price = parseFloat(cartItem.querySelector('.current-price').textContent.replace(/[^0-9]/g, ''));
                        const itemTotal = cartItem.querySelector('.item-total-value');
                        itemTotal.textContent = numberFormat(price * newQuantity) + '₫';
                        document.getElementById('subtotal').textContent = numberFormat(data.total) + '₫';
                        document.getElementById('total').textContent = numberFormat(data.total) + '₫';
                        const decreaseButton = cartItem.querySelector('.decrease-quantity');
                        decreaseButton.disabled = newQuantity <= 1;
                        Swal.fire({
                            icon: 'success',
                            title: 'Thành công',
                            text: 'Cập nhật số lượng thành công!',
                            timer: 1500,
                            showConfirmButton: false,
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi',
                            text: data.message || 'Cập nhật số lượng thất bại!',
                        });
                    }
                })
                .catch(error => {
                    console.error('Lỗi cập nhật số lượng:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi',
                        text: 'Lỗi: ' + error.message,
                    });
                });
            }
        });
    </script>
@endsection
```
