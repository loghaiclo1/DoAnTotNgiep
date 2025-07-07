
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
                <!-- Debug session -->
                <div style="display: none;">Debug session: {{ print_r(session()->all(), true) }}</div>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                @if (session('cart_errors'))
                    <div class="alert alert-warning">
                        <strong>Thông báo giỏ hàng:</strong>
                        <ul>
                            @foreach (session('cart_errors') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
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

                            @if (!is_array($cart) || empty($cart))
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
                                                        <span class="current-price" data-book-id="{{ $id }}">
                                                            {{ number_format($item['price'], 0, ',', '.') }}₫
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-12 text-center">
                                                    <div class="quantity-selector" data-book-id="{{ $id }}">
                                                        <button type="button" class="btn btn-sm btn-outline-secondary decrease-quantity"
                                                                data-book-id="{{ $id }}" data-quantity="{{ $item['quantity'] }}"
                                                                @if ($item['quantity'] <= 0) disabled @endif>-</button>
                                                        <input type="number" name="quantity[{{ $id }}]"
                                                               class="quantity-input form-control d-inline-block w-25 text-center"
                                                               value="{{ $item['quantity'] }}" min="0" max="10000">
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
                                                <a href="{{ route('cart.clear') }}" id="clear-cart-btn" class="btn btn-outline-danger">
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
                            <div class="summary-item" hidden>
                                <span class="summary-label"></span>
                                <span  class="summary-value" id="subtotal">{{ number_format($total, 0, ',', '.') }}₫</span>
                            </div>
                            <div class="summary-total">
                                <span class="summary-label">Tổng cộng</span>
                                <span class="summary-value" id="total">{{ number_format($total, 0, ',', '.') }}₫</span>
                            </div>
                            <div class="checkout-button">
                                @auth
                                    <!-- Đã đăng nhập: chuyển đến trang checkout -->
                                    <a href="{{ route('checkout') }}" class="btn btn-accent w-100">
                                        Thanh toán <i class="bi bi-arrow-right"></i>
                                    </a>
                                @endauth

                                @guest
                                    <!-- Chưa đăng nhập: popup cảnh báo -->
                                    <a href="#" class="btn btn-accent w-100" onclick="showLoginPopup(event, '{{ route('login') }}')">
                                        Thanh toán <i class="bi bi-arrow-right"></i>
                                    </a>
                                @endauth
                            </div>
                            <div class="continue-shopping">
                                <a href="{{ url('/') }}" class="btn btn-link w-100">
                                    <i class="bi bi-arrow-left"></i> Tiếp tục mua sắm
                                </a>
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

            // Xử lý xóa từng sản phẩm
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

            // Xử lý tăng/giảm số lượng
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

                    if (currentQuantity > 0) {
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
                        decreaseButton.disabled = newQuantity <= 0;
                        Swal.fire({
                            icon: 'success',
                            title: 'Thành công',
                            text: 'Cập nhật số lượng thành công!',
                            timer: 1500,
                            showConfirmButton: false,
                        });
                    } else {
                        if (data.needs_reload) {
                            console.log('Phát hiện needs_reload từ update, reload trang');
                            Swal.fire({
                                icon: 'warning',
                                title: 'Cập nhật giỏ hàng',
                                text: 'Số lượng vượt tồn kho, trang sẽ reload để cập nhật.',
                                timer: 2000,
                                showConfirmButton: false,
                            }).then(() => {
                                window.location.href = window.location.href;
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Lỗi',
                                text: data.message || 'Cập nhật số lượng thất bại!',
                            });
                        }
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

            // Xử lý nút Xóa tất cả
            const clearCartBtn = document.querySelector('#clear-cart-btn');
            if (clearCartBtn) {
                clearCartBtn.addEventListener('click', function (e) {
                    e.preventDefault();
                    console.log('Nút Xóa tất cả được nhấn');

                    Swal.fire({
                        title: 'Xác nhận xóa tất cả',
                        text: 'Bạn có chắc muốn xóa toàn bộ sản phẩm khỏi giỏ hàng không?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Xóa tất cả',
                        cancelButtonText: 'Hủy',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            console.log('Xác nhận xóa tất cả, chuyển hướng đến /cart/clear');
                            window.location.href = '{{ route('cart.clear') }}';
                        } else {
                            console.log('Hủy xóa tất cả giỏ hàng');
                        }
                    });
                });
            } else {
                console.error('Không tìm thấy nút #clear-cart-btn');
            }

            // Ngăn nhập số âm
            document.querySelectorAll('.quantity-input').forEach(input => {
                input.addEventListener('change', function () {
                    if (this.value < 0) {
                        this.value = 0;
                    }
                });
            });
            function checkStock() {
                const bookIds = Array.from(document.querySelectorAll('.cart-item')).map(item => {
                    const id = item.querySelector('.quantity-selector').getAttribute('data-book-id');
                    return id ? parseInt(id) : null;
                }).filter(id => id !== null);

                console.log('Bắt đầu kiểm tra tồn kho, bookIds:', bookIds);
                if (bookIds.length === 0) {
                    console.log('Giỏ hàng trống, không kiểm tra tồn kho');
                    return;
                }

                fetch('/cart/check-stock', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-Token': token,
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        _token: token,
                        book_ids: bookIds
                    })
                })
                .then(response => {
                    console.log('Phản hồi kiểm tra tồn kho - Status:', response.status, 'URL:', response.url);
                    if (!response.ok) {
                        return response.text().then(text => {
                            throw new Error(`Lỗi server: ${response.status} - ${response.statusText}. Response: ${text}`);
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Dữ liệu phản hồi kiểm tra tồn kho:', data);
                    if (data.needs_reload) {
                        console.log('Phát hiện thay đổi tồn kho, chuẩn bị reload trang');
                        Swal.fire({
                            icon: 'warning',
                            title: 'Cập nhật giỏ hàng',
                            text: 'Tồn kho đã thay đổi, trang sẽ reload để cập nhật giỏ hàng.',
                            timer: 2000,
                            showConfirmButton: false,
                        }).then(() => {
                            console.log('Thực hiện reload trang từ checkStock');
                            window.location.href = window.location.href;
                        });
                    } else {
                        console.log('Tồn kho không thay đổi, không reload');
                    }
                })
                .catch(error => {
                    console.error('Lỗi kiểm tra tồn kho:', error.message);
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi kiểm tra tồn kho',
                        text: error.message,
                        timer: 3000,
                        showConfirmButton: false,
                    });
                });
            }

            // Khởi tạo polling
            console.log('Khởi tạo polling kiểm tra tồn kho');
            const pollingInterval = setInterval(() => {
                console.log('Chạy polling kiểm tra tồn kho');
                checkStock();
            }, 10000);
            // Chạy lần đầu sau 5 giây
            setTimeout(() => {
                console.log('Chạy kiểm tra tồn kho lần đầu');
                checkStock();
            }, 5000);

            // Dừng polling khi rời trang
            window.addEventListener('beforeunload', () => {
                console.log('Dừng polling khi rời trang');
                clearInterval(pollingInterval);
            });
        });
function showLoginPopup(event, loginUrl) {
    event.preventDefault();

    // Lấy URL hiện tại (ví dụ: /gio-hang)
    const currentUrl = window.location.pathname;

    Swal.fire({
        icon: 'warning',
        title: 'Chưa đăng nhập',
        text: 'Bạn cần đăng nhập trước khi thanh toán!',
        confirmButtonText: 'Đăng nhập ngay',
        showCancelButton: true,
        cancelButtonText: 'Hủy'
    }).then((result) => {
        if (result.isConfirmed) {
            // Gắn returnUrl vào URL đăng nhập
            window.location.href = loginUrl + "?returnUrl=" + encodeURIComponent(currentUrl);
        }
    });
}

    </script>
@endsection
