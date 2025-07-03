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
                                    <img src="{{ asset('image/' . Auth::user()->avatar) }}" alt="Avatar"
                                        class="rounded-circle" width="40">
                                    <span class="status-badge">
                                        <i class="bi bi-shield-check"></i>
                                    </span>
                                </div>
                                <h4>{{ $user->Ho . ' ' . $user->Ten }}</h4>
                                <div class="user-status">
                                    <i class="bi bi-award"></i>
                                    <span>{{ $user->role ?? 'Thành viên thường' }}</span>
                                </div>
                            </div>
                            <!-- Navigation Menu -->
                            <nav class="menu-nav">
                                <ul class="nav flex-column" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="orders-tab" data-bs-toggle="tab" href="#orders"
                                            role="tab" aria-selected="true">
                                            <i class="bi bi-box-seam"></i>
                                            <span>Đơn hàng</span>
                                            <span class="badge">{{ $orders->count() }}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="addresses-tab" data-bs-toggle="tab" href="#addresses"
                                            role="tab" aria-selected="false">
                                            <i class="bi bi-geo-alt"></i>
                                            <span>Địa chỉ</span>
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="reviews-tab" data-bs-toggle="tab" href="#reviews"
                                            tabindex="-1" role="tab" aria-selected="false">
                                            <i class="bi bi-star"></i>
                                            <span>Đánh giá</span>
                                        </a>
                                    </li>
                                    <!-- Các tab khác -->
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="settings-tab" data-bs-toggle="tab" href="#settings"
                                            role="tab" aria-selected="false">
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
                                   <a href="{{ route('logout') }}"
   class="logout-link d-flex align-items-center mb-1 py-2 px-3 rounded-3 text-danger" style="height: 54px">
    <i class="bi bi-box-arrow-right me-2"></i>
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
                                <div class="tab-pane fade show active" id="orders" role ="tabpanel">
                                    <div class="section-header" data-aos="fade-up">
                                        <div class="header-actions">
                                            <form id="orderFilterForm" method="GET" action="{{ route('account') }}">
                                                <div class="search-box">
                                                    <i class="bi bi-search"></i>
                                                    <input type="text" name="order_search" id="orderSearchInput"
                                                        placeholder="Tìm kiếm đơn hàng..." class="form-control"
                                                        value="{{ request('order_search') }}">
                                                </div>
                                                <div class="dropdown">
                                                    <select name="status" id="statusFilter" class="form-select">
                                                        <option value="Tất Cả Đơn Hàng" {{ request('status', 'Tất Cả Đơn Hàng') == 'Tất Cả Đơn Hàng' ? 'selected' : '' }}>Tất Cả Đơn Hàng</option>
                                                        <option value="Đang chờ" {{ request('status') == 'Đang chờ' ? 'selected' : '' }}>Đang chờ</option>
                                                        <option value="Đã xác nhận" {{ request('status') == 'Đã xác nhận' ? 'selected' : '' }}>Đã xác nhận</option>
                                                        <option value="Đang giao hàng" {{ request('status') == 'Đang giao hàng' ? 'selected' : '' }}>Đang giao hàng</option>
                                                        <option value="Hoàn tất" {{ request('status') == 'Hoàn tất' ? 'selected' : '' }}>Hoàn tất</option>
                                                        <option value="Đã hủy" {{ request('status') == 'Đã hủy' ? 'selected' : '' }}>Đã hủy</option>
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-primary ms-2">Tìm</button>
                                                <a href="{{ route('account') }}" class="btn btn-secondary ms-2">Xóa bộ lọc</a>
                                            </form>
                                        </div>
                                    </div>
                                    <div id="filterInfo"></div>
                                    <div class="orders-grid">
                                        @include('homepage.partials.order_list')
                                    </div>
                                </div>

                                <!-- Addresses Tab -->
                                <div class="tab-pane fade" id="addresses" role="tabpanel">
                                    <div class="section-header" data-aos="fade-up">
                                        <h2>Địa Chỉ Giao Hàng</h2>
                                    </div>
                                    <div class="mb-3">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#addAddressModal">
                                            Thêm Địa Chỉ Mới
                                        </button>
                                    </div>
                                    @if ($addresses->isEmpty())
                                        <p>Bạn chưa thêm địa chỉ giao hàng nào.</p>
                                    @else
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover" data-aos="fade-up">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Người nhận</th>
                                                        <th>Địa chỉ</th>
                                                        <th>SĐT</th>
                                                        <th>Mặc định</th>
                                                        <th>Hành động</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($addresses as $address)
                                                        <tr>
                                                            <td>{{ $address->ten_nguoi_nhan }}</td>
                                                            <td>
                                                                {{ $address->dia_chi_cu_the }},
                                                                {{ optional($address->phuongXa)->ten }},
                                                                {{ optional($address->quanHuyen)->ten }},
                                                                {{ optional($address->tinhThanh)->ten }}
                                                            </td>
                                                            <td>{{ $address->so_dien_thoai }}</td>
                                                            <td>
                                                                @if ($address->mac_dinh)
                                                                    <span class="badge bg-success">Mặc định</span>
                                                                @else
                                                                    <form
                                                                        action="{{ route('address.setDefault', $address->id) }}"
                                                                        method="POST" style="display:inline;">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <button type="submit"
                                                                            class="btn btn-sm btn-outline-primary">Chọn</button>
                                                                    </form>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <button type="button"
                                                                    class="btn btn-sm btn-warning edit-address-btn"
                                                                    data-id="{{ $address->id }}"
                                                                    data-ten="{{ $address->ten_nguoi_nhan }}"
                                                                    data-sdt="{{ $address->so_dien_thoai }}"
                                                                    data-diachi="{{ $address->dia_chi_cu_the }}"
                                                                    data-tinh="{{ $address->tinh_thanh_id }}"
                                                                    data-quan="{{ $address->quan_huyen_id }}"
                                                                    data-phuong="{{ $address->phuong_xa_id }}">
                                                                    Sửa
                                                                </button>
                                                                <form
                                                                    action="{{ route('user.addresses.destroy', $address->id) }}"
                                                                    method="POST" style="display:inline-block;"
                                                                    onsubmit="return confirm('Bạn có chắc muốn xóa địa chỉ này không?');">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-sm btn-danger">Xóa</button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
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
                                                    <input type="text" class="form-control" id="firstName"
                                                        name="Ho" value="{{ auth()->user()->Ho }}" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="lastName" class="form-label">Tên</label>
                                                    <input type="text" class="form-control" id="lastName"
                                                        name="Ten" value="{{ auth()->user()->Ten }}" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="email"
                                                        name="email" value="{{ auth()->user()->email }}" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="phone" class="form-label">Số Điện Thoại</label>
                                                    <input type="tel" class="form-control" id="phone"
                                                        name="phone" value="{{ auth()->user()->SoDienThoai ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="form-buttons">
                                                <button type="submit" class="btn-save">Lưu Thay Đổi</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>

                                <!-- Reviews Tab -->
                               <div class="tab-pane fade" id="reviews" role="tabpanel">

    {{-- 1. Chưa đánh giá trước --}}
    <div class="section-header mt-2" data-aos="fade-up">
        <h2>Chưa đánh giá</h2>
    </div>

    <div class="reviews-grid">
        @forelse($unreviewedBooks as $book)
            @php
                $bookModel = $book['book'];
            @endphp
            <div class="review-card" data-aos="fade-up">
                <div class="review-header">
                    <img src="{{ asset('image/book/' . ltrim($bookModel->HinhAnh ?? 'no-image.png', '/')) }}"
                        alt="{{ $bookModel->TenSach ?? 'Sách' }}" class="product-image"
                        loading="lazy">
                    <div class="review-meta">
                        <h4>
                            <a href="{{ route('product.detail', $bookModel->slug) }}"
                                class="text-decoration-none">
                                {{ $bookModel->TenSach ?? 'Sách không tồn tại' }}
                            </a>
                        </h4>
                        <div class="review-date">
                            Đã mua:
                            {{ \Carbon\Carbon::parse($book['order_date'])->format('d/m/Y') }}
                        </div>
                    </div>
                </div>
                <div class="review-footer">
                    <a href="{{ route('review.create', ['MaSach' => $bookModel->MaSach]) }}"
                        class="btn btn-primary">Viết đánh giá</a>
                </div>
            </div>
        @empty
            <p>Bạn đã đánh giá hết các sách đã mua.</p>
        @endforelse
        <div class="d-flex justify-content-center">
            {{ $unreviewedBooks->links('pagination::bootstrap-5') }}
        </div>
    </div>

    <hr class="my-4">

    {{-- 2. Đánh giá của tôi sau --}}
    <div class="section-header" data-aos="fade-up">
        <h2>Đánh giá của tôi</h2>
        <div class="header-actions">
            <div class="dropdown">
                <button class="filter-btn" data-bs-toggle="dropdown">
                    <i class="bi bi-funnel"></i>
                    <span>Sắp xếp:
                        <span id="review-sort-text">
                            @if (request('sort') === 'high')
                                Từ cao đến thấp
                            @elseif(request('sort') === 'low')
                                Từ thấp đến cao
                            @else
                                Gần đây
                            @endif
                        </span>
                    </span>
                </button>
                <ul class="dropdown-menu">
                    <a href="#" class="dropdown-item review-sort" data-sort="recent">Gần đây</a>
                    <a href="#" class="dropdown-item review-sort" data-sort="high">Từ cao đến thấp</a>
                    <a href="#" class="dropdown-item review-sort" data-sort="low">Từ thấp đến cao</a>
                </ul>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div id="review-list-container">
        @include('homepage.partials.review_list', ['reviews' => $reviews])
    </div>

</div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="addAddressModal" tabindex="-1" aria-labelledby="addAddressLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('user.addresses.store') }}" method="POST">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title" id="addAddressLabel">Thêm địa chỉ mới</h5>
                                    <button type="button" class="btn-close btn-close-white"
                                        data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="ten_nguoi_nhan" class="form-label">Tên người nhận</label>
                                        <input type="text" name="ten_nguoi_nhan" id="ten_nguoi_nhan"
                                            class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="so_dien_thoai" class="form-label">Số điện thoại</label>
                                        <input type="text" name="so_dien_thoai" id="so_dien_thoai"
                                            class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="tinh_thanh_id" class="form-label">Tỉnh / Thành phố</label>
                                        <select name="tinh_thanh_id" id="tinh_thanh_id" class="form-select" required>
                                            <option value="">-- Chọn Tỉnh / Thành --</option>
                                            @foreach ($tinhThanhs as $tinh)
                                                <option value="{{ $tinh->id }}">{{ $tinh->ten }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="quan_huyen_id" class="form-label">Quận / Huyện</label>
                                        <select name="quan_huyen_id" id="quan_huyen_id" class="form-select" required>
                                            <option value="">-- Chọn Quận / Huyện --</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="phuong_xa_id" class="form-label">Phường / Xã</label>
                                        <select name="phuong_xa_id" id="phuong_xa_id" class="form-select" required>
                                            <option value="">-- Chọn Phường / Xã --</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="dia_chi_cu_the" class="form-label">Địa chỉ cụ thể</label>
                                        <input type="text" name="dia_chi_cu_the" id="dia_chi_cu_the"
                                            class="form-control" required placeholder="Số nhà, tên đường...">
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Hủy</button>
                                        <button type="submit" class="btn btn-success">Lưu địa chỉ</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Edit Address Modal -->
                <div class="modal fade" id="editAddressModal" tabindex="-1" aria-labelledby="editAddressModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <form method="POST" action="" id="editAddressForm">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title" id="editAddressModalLabel">Sửa địa chỉ</h5>
                                    <button type="button" class="btn-close btn-close-white"
                                        data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="text" name="ten_nguoi_nhan" id="edit_ten_nguoi_nhan"
                                        class="form-control mb-2" placeholder="Tên người nhận" required>
                                    <input type="text" name="so_dien_thoai" id="edit_so_dien_thoai"
                                        class="form-control mb-2" placeholder="SĐT" required>
                                    <input type="text" name="dia_chi_cu_the" id="edit_dia_chi_cu_the"
                                        class="form-control mb-2" placeholder="Địa chỉ cụ thể" required>
                                    <select name="tinh_thanh_id" id="edit_tinh_thanh_id" class="form-select mb-2"
                                        required>
                                        <option value="">-- Chọn Tỉnh / Thành --</option>
                                        @foreach ($tinhThanhs as $tinh)
                                            <option value="{{ $tinh->id }}">{{ $tinh->ten }}</option>
                                        @endforeach
                                    </select>
                                    <select name="quan_huyen_id" id="edit_quan_huyen_id" class="form-select mb-2"
                                        required></select>
                                    <select name="phuong_xa_id" id="edit_phuong_xa_id" class="form-select mb-2"
                                        required></select>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Lưu thay đổi</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Modal chỉnh sửa đánh giá -->
                <div class="modal fade" id="editReviewModal" tabindex="-1" aria-labelledby="editReviewModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form method="POST" id="editReviewForm">
                    @csrf
                    @method('PUT')
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="editReviewModalLabel">Sửa đánh giá</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                        </div>
                        <div class="modal-body">
                        <input type="hidden" id="editReviewId" name="review_id">
                        <div class="mb-3">
                            <label class="form-label d-block">Số sao</label>
                            <div id="editStarContainer">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="bi bi-star star-edit" data-value="{{ $i }}" style="font-size: 1.5rem; cursor: pointer; color: #ccc;"></i>
                                @endfor
                            </div>
                            <input type="hidden" id="editSoSao" name="SoSao" required>
                        </div>
                        <div class="mb-3">
                            <label for="editNoiDung" class="form-label">Nội dung</label>
                            <textarea id="editNoiDung" name="NoiDung" class="form-control" rows="4" required></textarea>
                        </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                        </div>
                    </div>
                    </form>
                </div>
                </div>
            </div>

        </section><!-- /Account Section -->

    </main>

    <!-- Toastify CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <!-- Toastify JS -->
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <script>
      document.addEventListener('DOMContentLoaded', function() {
    if (window.location.hash === '#reviews') {
        const reviewsTab = document.querySelector('a[href="#reviews"]');
        if (reviewsTab) {
            new bootstrap.Tab(reviewsTab).show();
        }
    }

    // Các hàm load địa chỉ (Giữ nguyên không thay đổi)
    function loadDistricts(provinceId, districtSelectId, resetWard = true, selectedId = null) {
        fetch(`/api/quan-huyen/${provinceId}`)
            .then(response => response.json())
            .then(data => {
                const districtSelect = document.getElementById(districtSelectId);
                districtSelect.innerHTML = '<option value="">Chọn Quận/Huyện</option>';
                data.forEach(item => {
                    districtSelect.innerHTML +=
                        `<option value="${item.id}" ${selectedId == item.id ? 'selected' : ''}>${item.ten}</option>`;
                });

                if (resetWard) {
                    const wardSelect = document.getElementById(districtSelectId.replace('quan_huyen',
                        'phuong_xa'));
                    if (wardSelect) wardSelect.innerHTML = '<option value="">Chọn Phường/Xã</option>';
                }
            })
            .catch(err => {
                console.error('Lỗi tải Quận/Huyện:', err);
                Toastify({
                    text: "Lỗi khi tải Quận/Huyện. Vui lòng thử lại!",
                    duration: 3000,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#dc3545",
                }).showToast();
            });
    }

    function loadWards(districtId, wardSelectId, selectedId = null) {
        fetch(`/api/phuong-xa/${districtId}`)
            .then(response => response.json())
            .then(data => {
                const wardSelect = document.getElementById(wardSelectId);
                wardSelect.innerHTML = '<option value="">Chọn Phường/Xã</option>';
                data.forEach(item => {
                    wardSelect.innerHTML +=
                        `<option value="${item.id}" ${selectedId == item.id ? 'selected' : ''}>${item.ten}</option>`;
                });
            })
            .catch(err => {
                console.error('Lỗi tải Phường/Xã:', err);
                Toastify({
                    text: "Lỗi khi tải Phường/Xã. Vui lòng thử lại!",
                    duration: 3000,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#dc3545",
                }).showToast();
            });
    }

    // Modal địa chỉ (Không thay đổi)
    const editModal = new bootstrap.Modal(document.getElementById('editAddressModal'));
    const form = document.getElementById('editAddressForm');

    document.querySelectorAll('.edit-address-btn').forEach(button => {
        button.addEventListener('click', async function() {
            const {
                id,
                ten,
                sdt,
                diachi,
                tinh,
                quan,
                phuong
            } = this.dataset;

            form.action = `/user/addresses/${id}`;
            document.getElementById('edit_ten_nguoi_nhan').value = ten;
            document.getElementById('edit_so_dien_thoai').value = sdt;
            document.getElementById('edit_dia_chi_cu_the').value = diachi;
            document.getElementById('edit_tinh_thanh_id').value = tinh;

            try {
                await loadDistricts(tinh, 'edit_quan_huyen_id', false, quan);
                await loadWards(quan, 'edit_phuong_xa_id', phuong);
                console.log('Gọi modal');
                editModal.show();
            } catch (err) {
                console.error('Lỗi khi tải địa chỉ:', err);
                Toastify({
                    text: "Không thể tải dữ liệu địa chỉ. Vui lòng thử lại!",
                    duration: 3000,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#dc3545",
                }).showToast();
            }
        });
    });

    document.getElementById('edit_tinh_thanh_id')?.addEventListener('change', function() {
        loadDistricts(this.value, 'edit_quan_huyen_id');
    });

    document.getElementById('edit_quan_huyen_id')?.addEventListener('change', function() {
        loadWards(this.value, 'edit_phuong_xa_id');
    });
});
</script>


@endsection

