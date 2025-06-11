
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

                            @if (empty($cart))
                                <p>Giỏ hàng của bạn đang trống.</p>
                            @else
                                <form action="{{ route('cart.update') }}" method="POST">
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
                                                            <a href="{{ route('cart.remove', $id) }}"
                                                                class="remove-item">
                                                                <i class="bi bi-trash"></i> Xóa
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-2 text-center">
                                                    <div class="price-tag">
                                                        <span
                                                            class="current-price">{{ number_format($item['price'], 0, ',', '.') }}₫</span>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-2 text-center">
                                                    <div class="quantity-selector">
                                                        <input type="number" name="quantity[{{ $id }}]"

                                                            class="quantity-input" value="{{ $item['quantity'] }}"
                                                            min="1" max="10">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-2 text-center mt-3 mt-lg-0">
                                                    <div class="item-total">
                                                        <span>{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}₫</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="cart-actions">
                                        <div class="row g-3">
                                            <div class="col-lg-6 col-md-6">
                                                <div class="coupon-form">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control"
                                                            placeholder="Mã giảm giá">
                                                        <button class="btn btn-accent" type="button">Áp dụng</button>
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
                                <span class="summary-label">Tạm tính</span>
                                <span class="summary-value">{{ number_format($total, 0, ',', '.') }}₫</span>
                            </div>

                            <div class="summary-item shipping-item">
                                <span class="summary-label">Phí vận chuyển</span>
                                <div class="shipping-options">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="shipping" id="standard"
                                            checked>
                                        <label class="form-check-label" for="standard">
                                            Giao hàng tiêu chuẩn - 30.000₫
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="shipping" id="express">
                                        <label class="form-check-label" for="express">
                                            Giao hàng nhanh - 50.000₫
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="shipping" id="free">
                                        <label class="form-check-label" for="free">
                                            Miễn phí (Đơn hàng trên 300.000₫)
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="summary-item">
                                <span class="summary-label">Thuế</span>
                                <span class="summary-value">0₫</span>
                            </div>

                            <div class="summary-item discount">
                                <span class="summary-label">Giảm giá</span>
                                <span class="summary-value">0₫</span>
                            </div>

                            <div class="summary-total">
                                <span class="summary-label">Tổng cộng</span>
                                <span class="summary-value">{{ number_format($total, 0, ',', '.') }}₫</span>
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

