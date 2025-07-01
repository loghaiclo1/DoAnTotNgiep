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
                                'Đang giao' => 'shipping',
                                'Hoàn tất' => 'completed',
                                'Hủy đơn' => 'cancelled',
                            ];
                            $statusClass = $statusMap[$order->TrangThai] ?? 'processing';
                        @endphp
                        <span class="status {{ $statusClass }}" id="status-order-{{ $order->MaHoaDon }}" data-status-for="{{ $order->MaHoaDon }}">
                            {{ $order->TrangThai }}
                        </span>
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
                <div class="tracking-timeline {{ $order->TrangThai === 'Đã hủy' ? 'cancelled-timeline' : '' }}">
                    @php
                        $isCancelled = $order->TrangThai === 'Đã hủy';
                        $trackingSteps = $isCancelled
                            ? [
                                ['status' => 'Đã hủy', 'label' => 'Đơn Hàng Đã Hủy', 'desc' => 'Đơn hàng này đã bị hủy và không được xử lý', 'completed' => true]
                            ] : [
                                ['status' => 'Đang chờ', 'label' => 'Đơn Hàng Đã Đặt', 'desc' => 'Đơn hàng đang chờ xác nhận', 'completed' => true],
                                ['status' => 'Đã xác nhận', 'label' => 'Đã Xác Nhận', 'desc' => 'Đơn hàng đã được xác nhận', 'completed' => in_array($order->TrangThai, ['Đã xác nhận', 'Đang giao', 'Hoàn tất'])],
                                ['status' => 'Đang giao', 'label' => 'Đang Giao Hàng', 'desc' => 'Đơn hàng đang được vận chuyển', 'completed' => in_array($order->TrangThai, ['Đang giao', 'Hoàn tất'])],
                                ['status' => 'Hoàn tất', 'label' => 'Đã Giao Hàng', 'desc' => 'Đơn hàng đã được giao thành công', 'completed' => in_array($order->TrangThai, ['Hoàn tất'])],
                            ];
                    @endphp
                    @foreach ($trackingSteps as $step)
                        <div class="timeline-item {{ $step['completed'] ? 'completed' : ($order->TrangThai === $step['status'] ? 'active' : '') }}">
                            <div class="timeline-icon">
                                <i class="bi
                                    @if($step['status'] === 'Đã hủy') bi-x-circle-fill
                                    @elseif($step['completed']) bi-check-circle-fill
                                    @elseif($step['status'] === 'Đang giao') bi-truck
                                    @else bi-house-door
                                    @endif
                                "></i>
                            </div>
                            <div class="timeline-content">
                                <h5>{{ $step['label'] }}</h5>
                                <p>{{ $step['desc'] }}</p>
                                @if ($step['completed'] || $order->TrangThai === $step['status'])
                                    <span class="timeline-date" id="timeline-date-{{ $order->MaHoaDon }}-{{ \Illuminate\Support\Str::slug($step['status']) }}">
                                        {{ $order->NgayLap->format('M d, Y - h:i A') }}
                                    </span>
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
