@extends('layout.main')

@section('title', 'BookShop - Tài khoản')

@section('content')
<main class="main">
    <!-- Page Title -->

    <div class="page-title light-background">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Tài khoản</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ url('/') }}">Trang chủ</a></li>
                    <li class="current">Tài khoản</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- Account Section -->
    <section id="account" class="account section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <!-- Hiển thị thông báo -->
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="row g-4">
                <!-- Profile Menu -->
                <div class="col-lg-3">
                    <div class="profile-menu d-lg-block" id="profileMenu">
                        <!-- User Info -->
                        <div class="user-info" data-aos="fade-right">
                            <div class="user-avatar">
                                <span class="status-badge">
                                    <i class="bi bi-shield-check"></i>
                                </span>
                            </div>
                            <h4>{{ $user->Ho . ' ' . $user->Ten }}</h4>
                            <div class="user-status">
                                <i class="bi bi-award"></i>
                                <span>{{ $user->membership_status ?? 'Thành viên thường' }}</span>
                            </div>
                        </div>

                        <!-- Navigation Menu -->
                        <nav class="menu-nav">
                            <ul class="nav flex-column" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="orders-tab" data-bs-toggle="tab" href="#orders" role="tab" aria-selected="true">
                                        <i class="bi bi-box-seam"></i>
                                        <span>Đơn hàng</span>
                                        <span class="badge">{{ $orders->count() }}</span>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="settings-tab" data-bs-toggle="tab" href="#addresses" role="tab" aria-selected="false">
                                        <i class="bi bi-geo-alt"></i>
                                        <span>Địa chỉ</span>
                                    </a>
                                </li>
                                <!-- Các tab khác -->
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="settings-tab" data-bs-toggle="tab" href="#settings" role="tab" aria-selected="false">
                                        <i class="bi bi-gear"></i>
                                        <span>Tùy chọn tài khoản</span>
                                    </a>
                                </li>
                            </ul>

                            <div class="menu-footer">
                                <a href="{{ url('/contact') }}" class="help-link">
                                    <i class="bi bi-question-circle"></i>
                                    <span>Hỗ trợ khách hàng</span>
                                </a>
                                <a href="{{ url('/logout') }}" class="logout-link">
                                    <i class="bi bi-box-arrow-right"></i>
                                    <span>Đăng xuất</span>
                                </a>
                            </div>
                        </nav>
                    </div>
                </div>


                <!-- Content Area -->
                <div class="col-lg-9">
                    <div class="content-area">
                        <div class="tab-content">
                            <!-- Orders Tab -->
                            <div class="tab-pane fade show active" id="orders" role="tabpanel">
                                <div class="section-header" data-aos="fade-up">
                                    <div class="header-actions">
                                        <div class="search-box">
                                            <i class="bi bi-search"></i>
                                            <input type="text" placeholder="Tìm kiếm đơn hàng...">
                                        </div>
                                        <div class="dropdown">
                                            <button class="filter-btn" data-bs-toggle="dropdown">
                                                <i class="bi bi-funnel"></i>
                                                <span>Lọc</span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#">Tất Cả Đơn Hàng</a></li>
                                                <li><a class="dropdown-item" href="#">Đang Xử Lý</a></li>
                                                <li><a class="dropdown-item" href="#">Đang Giao Hàng</a></li>
                                                <li><a class="dropdown-item" href="#">Hoàn Thành</a></li>
                                                <li><a class="dropdown-item" href="#">Hủy Đơn</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="orders-grid">
                                    @forelse ($orders as $order)
                                    <div class="order-card" data-order-id="{{ $order->MaHoaDon }}" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                                            <div class="order-header">
                                                <div class="order-id">
                                                    <span class="label">Mã Đơn Hàng:</span>
                                                    <span class="value">#ORD-{{ $order->NgayLap->format('Y') }}-{{ $order->MaHoaDon }}</span>
                                                </div>
                                                <div class="order-date">{{ $order->NgayLap->format('M d, Y') }}</div>
                                            </div>
                                            <div class="order-content">
                                                <div class="product-grid">
                                                    @foreach ($order->chitiethoadon->take(3) as $item)
                                                        <img src="{{ asset('image/book/' . ltrim($item->sach->HinhAnh, '/')) }}" alt="{{ $item->sach->TenSach }}" loading="lazy">
                                                    @endforeach
                                                    @if ($order->chitiethoadon->count() > 3)
                                                        <span class="more-items">+{{ $order->chitiethoadon->count() - 3 }}</span>
                                                    @endif
                                                </div>
                                                <div class="order-info">
                                                    <div class="info-row">
                                                        <span>Trạng Thái</span>
                                                        @php
                                                            $statusMap = [
                                                                'Đang chờ' => 'processing',
                                                                'Đã xác nhận' => 'confirmed',
                                                                'Đang giao hàng' => 'shipped',
                                                                'Hoàn thành' => 'completed',
                                                                'Hoàn tất' => 'completed',
                                                                'Hủy đơn' => 'cancelled',
                                                            ];
                                                            $statusClass = $statusMap[$order->TrangThai] ?? 'processing';
                                                        @endphp
                                               <span class="status {{ $statusClass }}" data-status-for="{{ $order->MaHoaDon }}">{{ $order->TrangThai }}</span>

                                                    </div>
                                                    <div class="info-row">
                                                        <span>Sản Phẩm</span>
                                                        <span>{{ $order->chitiethoadon->sum('SoLuong') }} sản phẩm</span>
                                                    </div>
                                                    <div class="info-row">
                                                        <span>Tổng Tiền</span>
                                                        <span class="price">{{ number_format($order->TongTien, 0, ',', '.') }} ₫</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="order-footer">
                                                <button type="button" class="btn-track" data-bs-toggle="collapse" data-bs-target="#tracking{{ $order->MaHoaDon }}" aria-expanded="false">Theo Dõi Đơn Hàng</button>
                                                <button type="button" class="btn-details" data-bs-toggle="collapse" data-bs-target="#details{{ $order->MaHoaDon }}" aria-expanded="false">Xem Chi Tiết</button>
                                            </div>

                                            <!-- Order Tracking -->
                                            <div class="collapse tracking-info" id="tracking{{ $order->MaHoaDon }}">
                                                <div class="tracking-timeline {{ $order->TrangThai === 'Hủy đơn' ? 'cancelled-timeline' : '' }}">
                                                    @php
                                                        $isCancelled = $order->TrangThai === 'Hủy đơn';

                                                        $trackingSteps = $isCancelled
                                                        ? [
                                                            ['status' => 'Hủy đơn', 'label' => 'Đơn Hàng Đã Hủy', 'desc' => 'Đơn hàng này đã bị hủy và không được xử lý', 'completed' => true]
                                                        ] : [
                                                            ['status' => 'Đang chờ', 'label' => 'Đơn Hàng Đã Đặt', 'desc' => 'Đơn hàng đang chờ xác nhận', 'completed' => true],
                                                            ['status' => 'Đã xác nhận', 'label' => 'Đã Xác Nhận', 'desc' => 'Đơn hàng đã được xác nhận', 'completed' => in_array($order->TrangThai, ['Đã xác nhận', 'Đang giao hàng', 'Hoàn thành', 'Hoàn tất'])],
                                                            ['status' => 'Đang giao hàng', 'label' => 'Đang Giao Hàng', 'desc' => 'Đơn hàng đang được vận chuyển', 'completed' => in_array($order->TrangThai, ['Đang giao hàng', 'Hoàn thành', 'Hoàn tất'])],
                                                            ['status' => 'Hoàn thành', 'label' => 'Đã Giao Hàng', 'desc' => 'Đơn hàng đã được giao thành công', 'completed' => in_array($order->TrangThai, ['Hoàn thành', 'Hoàn tất'])],
                                                        ];
                                                    @endphp
                                                    @foreach ($trackingSteps as $step)
                                                        <div class="timeline-item {{ $step['completed'] ? 'completed' : ($order->TrangThai === $step['status'] ? 'active' : '') }}">
                                                            <div class="timeline-icon">
                                                                <i class="bi 
                                                                    @if($step['status'] === 'Hủy đơn') bi-x-circle-fill
                                                                    @elseif($step['completed']) bi-check-circle-fill
                                                                    @elseif($step['status'] === 'Đang giao hàng') bi-truck
                                                                    @else bi-house-door
                                                                    @endif
                                                                "></i>
                                                            </div>
                                                            <div class="timeline-content">
                                                                <h5>{{ $step['label'] }}</h5>
                                                                <p>{{ $step['desc'] }}</p>
                                                                @if ($step['completed'] || $order->TrangThai === $step['status'])
                                                                    <span class="timeline-date">{{ $order->NgayLap->format('M d, Y - h:i A') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <!-- Order Details -->
                                            <div class="collapse order-details" id="details{{ $order->MaHoaDon }}">
                                                <div class="details-content">
                                                    <div class="detail-section">
                                                        <h5>Thông Tin Đơn Hàng</h5>
                                                        <div class="info-grid">
                                                            <div class="info-item">
                                                                <span class="label">Phương Thức Thanh Toán</span>
                                                                <span class="value">
                                                                    @if ($order->PT_ThanhToan == 1)
                                                                        Thanh toán khi nhận hàng (COD)
                                                                    @elseif ($order->PT_ThanhToan == 2)
                                                                        Thanh toán VNPay
                                                                    @else
                                                                        Không xác định
                                                                    @endif
                                                                </span>

                                                            </div>
                                                            <div class="info-item">
                                                                <span class="label">Phương Thức Vận Chuyển</span>
                                                                <span class="value">Giao Hàng Tiêu Chuẩn</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="detail-section">
                                                        <h5>Sản Phẩm ({{ $order->chitiethoadon->sum('SoLuong') }})</h5>
                                                        <div class="order-items">
                                                            @php
                                                                $groupedItems = $order->chitiethoadon->groupBy('MaSach');
                                                            @endphp

                                                            @foreach ($groupedItems as $maSach => $items)
                                                                @php
                                                                    $first = $items->first();
                                                                    $soLuong = $items->sum('SoLuong');
                                                                    $donGia = $first->DonGia ?? 0;
                                                                    $tongTien = $donGia * $soLuong;
                                                                    $tenSach = $first->sach->TenSach ?? 'Không tìm thấy sách';
                                                                    $hinhAnh = $first->sach->HinhAnh ?? 'no-image.png';
                                                                @endphp

                                                                <div class="item d-flex align-items-center mb-3">
                                                                    <img src="{{ asset('image/book/' . ltrim($hinhAnh, '/')) }}"
                                                                         alt="{{ $tenSach }}"
                                                                         loading="lazy"
                                                                         width="80"
                                                                         class="me-3 rounded shadow-sm border">

                                                                    <div class="item-info flex-grow-1">
                                                                        <h6 class="mb-1">{{ $tenSach }}</h6>
                                                                        <div class="item-meta text-muted small">
                                                                            <span class="d-block">Mã Sách: {{ $maSach }}</span>
                                                                            <span class="d-block">Số lượng: {{ $soLuong }}</span>
                                                                        </div>
                                                                    </div>

                                                                    <div class="item-price text-end fw-bold">
                                                                        {{ number_format($tongTien, 0, ',', '.') }} ₫
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>


                                                    <div class="detail-section">
                                                        <h5>Chi Tiết Giá</h5>
                                                        <div class="price-breakdown">
                                                            <div class="price-row">
                                                                <span>Tạm tính</span>
                                                                <span>{{ number_format($order->TongTien - session('shipping', 0), 0, ',', '.') }} ₫</span>
                                                            </div>
                                                            <div class="price-row">
                                                                <span>Phí vận chuyển</span>
                                                                <span>{{ number_format(session('shipping', 0), 0, ',', '.') }} ₫</span>
                                                            </div>
                                                            <div class="price-row total">
                                                                <span>Tổng cộng</span>
                                                                <span>{{ number_format($order->TongTien, 0, ',', '.') }} ₫</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="detail-section">
                                                        <h5>Địa Chỉ Giao Hàng</h5>
                                                        <div class="address-info">
                                                            <p>{{ $order->DiaChi }}</p>
                                                            <p class="contact">{{ $order->SoDienThoai }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <p>Chưa có đơn hàng nào.</p>
                                    @endforelse
                                </div>
                                
                            </div>
                                    <!-- Địa chỉ Tab -->

                                <div class="tab-pane fade" id="addresses" role="tabpanel">
                                    <div class="section-header" data-aos="fade-up">
                                        <h2>Địa Chỉ Giao Hàng</h2>
                                    </div>
                                    <div class="mb-3">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAddressModal">
                                            Thêm Địa Chỉ Mới
                                        </button>
                                    </div>
                                    @if ($addresses->isEmpty())
                                        <p>Bạn chưa thêm địa chỉ giao hàng nào.</p>
                                    @else
                                        <div class="address-list row">
                                            @foreach ($addresses as $address)
                                                <div class="col-md-6">
                                                    <div class="card mb-3" data-aos="fade-up">
                                                        <div class="card-body">
                                                            <h5 class="card-title">{{ $address->TenNguoiNhan }}</h5>
                                                            <p class="card-text">
                                                                {{ $address->DiaChi }}<br>
                                                                SĐT: {{ $address->SoDienThoai }}
                                                            </p>
                                                            @if ($address->MacDinh)
                                                                <span class="badge bg-success">Mặc định</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>

                            <!-- Settings Tab -->
                            <div class="tab-pane fade" id="settings" role="tabpanel">
                                <div class="section-header" data-aos="fade-up">
                                    <h2>Cài Đặt Tài Khoản</h2>
                                </div>
                                <div class="settings-content">
                                    <div class="settings-section" data-aos="fade-up">
                                        <h3>Thông Tin Cá Nhân</h3>
                                        {{-- <form class="settings-form" method="POST" action="{{ route('account.update') }}"> --}}
                                            @csrf
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label for="firstName" class="form-label">Họ</label>
                                                    <input type="text" class="form-control" id="firstName" name="Ho" value="{{ auth()->user()->Ho }}" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="lastName" class="form-label">Tên</label>
                                                    <input type="text" class="form-control" id="lastName" name="Ten" value="{{ auth()->user()->Ten }}" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="phone" class="form-label">Số Điện Thoại</label>
                                                    <input type="tel" class="form-control" id="phone" name="phone" value="{{ auth()->user()->SoDienThoai ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="form-buttons">
                                                <button type="submit" class="btn-save">Lưu Thay Đổi</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /Account Section -->
</main>

<script>
    // Lặp qua các đơn hàng của người dùng để đăng ký kênh
    @foreach ($orders as $order)
        Echo.private('orders.{{ $order->id }}')
            .listen('OrderStatusUpdated', (e) => {
                const statusSpan = document.querySelector('#status-order-{{ $order->id }}');
                if (statusSpan) {
                    statusSpan.textContent = e.status;

                    // Cập nhật class nếu cần
                    const classMap = {
                        'Đang chờ': 'processing',
                        'Đã xác nhận': 'confirmed',
                        'Đang giao': 'shipping',
                        'Hoàn tất': 'completed',
                        'Đã hủy': 'cancelled',
                    };

                    statusSpan.className = 'status ' + (classMap[e.status] || 'processing');
                }
            });
    @endforeach
</script>

@endsection
