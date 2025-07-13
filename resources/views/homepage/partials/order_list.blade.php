<div class="orders-grid">
    @forelse ($orders as $order)
        <div class="order-card" data-order-id="{{ $order->MaHoaDon }}" data-aos="fade-up"
            data-aos-delay="{{ $loop->iteration * 100 }}">
            <div class="order-header">
                <div class="order-id">
                    <span class="label">Mã Đơn Hàng:</span>
                    <span class="value">#ORD-{{ $order->NgayLap->format('Y') }}-{{ $order->MaHoaDon }}</span>
                </div>
                <div class="order-date">{{ $order->NgayLap->format('M d, Y') }}</div>
            </div>
            <div class="order-content">
                <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 20px;">
                    <div class="product-grid">
                        @foreach ($order->chitiethoadon->take(5) as $item)
                            <img src="{{ asset('image/book/' . ltrim($item->sach->HinhAnh, '/')) }}"
                                alt="{{ $item->sach->TenSach }}" loading="lazy">
                        @endforeach
                        @if ($order->chitiethoadon->count() > 5)
                            <span class="more-items">+{{ $order->chitiethoadon->count() - 5 }}</span>
                        @endif
                    </div>
                    @if (in_array($order->TrangThai, ['Đang chờ', 'Đã xác nhận']))
                        <div class="order-actions mt-2">
                            <button type="button" class="btn btn-outline-danger btn-sm btn-cancel-order"
                                data-order-id="{{ $order->MaHoaDon }}" data-toggle="modal"
                                data-target="#cancelOrderModal">
                                Hủy đơn hàng
                            </button>
                        </div>
                    @endif
                </div>
                <div class="order-info">
                    <div class="info-row">
                        <span>Trạng Thái</span>
                        @php
                            $statusMap = [
                                'Đang chờ' => 'processing',
                                'Đã xác nhận' => 'confirmed',
                                'Đang giao hàng' => 'shipping',
                                'Hoàn tất' => 'completed',
                                'Hủy đơn' => 'cancelled',
                            ];
                            $statusClass = $statusMap[$order->TrangThai] ?? 'processing';
                        @endphp
                        <span class="status {{ $statusClass }}" id="status-order-{{ $order->MaHoaDon }}"
                            data-status-for="{{ $order->MaHoaDon }}">
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
                <button type="button" class="btn-track" data-bs-toggle="collapse"
                    data-bs-target="#tracking{{ $order->MaHoaDon }}" aria-expanded="false">Theo Dõi Đơn Hàng</button>
                <button type="button" class="btn-details" data-bs-toggle="collapse"
                    data-bs-target="#details{{ $order->MaHoaDon }}" aria-expanded="false">Xem Chi Tiết</button>

            </div>
            <!-- Order Tracking -->
            <div class="collapse tracking-info" id="tracking{{ $order->MaHoaDon }}">
                <div class="tracking-timeline {{ $order->TrangThai === 'Đã hủy' ? 'cancelled-timeline' : '' }}">
                    @php
                        $isCancelled = $order->TrangThai === 'Hủy đơn';
                        $trackingSteps = $isCancelled
                            ? [
                                [
                                    'status' => 'Đã hủy',
                                    'label' => 'Đơn Hàng Đã Hủy',
                                    'desc' => 'Đơn hàng này đã bị hủy và không được xử lý',
                                    'completed' => true,
                                ],
                            ]
                            : [
                                [
                                    'status' => 'Đang chờ',
                                    'label' => 'Đơn Hàng Đã Đặt',
                                    'desc' => 'Đơn hàng đang chờ xác nhận',
                                    'completed' => true,
                                ],
                                [
                                    'status' => 'Đã xác nhận',
                                    'label' => 'Đã Xác Nhận',
                                    'desc' => 'Đơn hàng đã được xác nhận',
                                    'completed' => in_array($order->TrangThai, [
                                        'Đã xác nhận',
                                        'Đang giao',
                                        'Hoàn tất',
                                    ]),
                                ],
                                [
                                    'status' => 'Đang giao hàng',
                                    'label' => 'Đang Giao Hàng',
                                    'desc' => 'Đơn hàng đang được vận chuyển',
                                    'completed' => in_array($order->TrangThai, ['Đang giao', 'Hoàn tất']),
                                ],
                                [
                                    'status' => 'Hoàn tất',
                                    'label' => 'Đã Giao Hàng',
                                    'desc' => 'Đơn hàng đã được giao thành công',
                                    'completed' => in_array($order->TrangThai, ['Hoàn tất']),
                                ],
                            ];
                    @endphp
                    @foreach ($trackingSteps as $step)
                        <div
                            class="timeline-item {{ $step['completed'] ? 'completed' : ($order->TrangThai === $step['status'] ? 'active' : '') }}">
                            <div class="timeline-icon {{ $step['status'] === 'Đã hủy' ? 'bg-light border-danger text-danger' : '' }}">
                                <i
                                    class="bi
                                    @if ($step['status'] === 'Đã hủy') bi-x-circle-fill text-danger
                                    @elseif($step['completed']) bi-check-circle-fill
                                    @elseif($step['status'] === 'Đang giao') bi-truck
                                    @else bi-house-door @endif
                                "></i>
                            </div>
                            <div class="timeline-content">
                                <h5>{{ $step['label'] }}</h5>
                                <p>{{ $step['desc'] }}</p>
                                @if ($step['completed'] || $order->TrangThai === $step['status'])
                                    <span class="timeline-date"
                                        id="timeline-date-{{ $order->MaHoaDon }}-{{ \Illuminate\Support\Str::slug($step['status']) }}">
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
                                        alt="{{ $tenSach }}" loading="lazy" width="80"
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
                                <span>{{ number_format($order->TongTien - session('shipping', 0), 0, ',', '.') }}
                                    ₫</span>
                            </div>
                            <div class="price-row">
                                <span>Phí vận chuyển</span>
                                <span>{{ number_format(session('shipping', 0), 0, ',', '.') }} ₫</span>
                            </div>
                            @if (session()->has('promo'))
                                <div class="price-row text-success">
                                    <span>Giảm giá ({{ session('promo.MaCode') }})</span>
                                    <span>-{{ number_format(session('promo.discount'), 0, ',', '.') }} ₫</span>
                                </div>
                            @endif

                            <div class="price-row total">
                                <span>Tổng cộng</span>
                                <span>
                                    @php
                                        $discount = session('promo.discount', 0);
                                        $shipping = session('shipping', 0);
                                        $totalAfterDiscount = $order->TongTien + $shipping - $discount;
                                    @endphp
                                    {{ number_format($totalAfterDiscount, 0, ',', '.') }} ₫
                                </span>
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
    <div class="card-footer" style="display: flex; justify-content: center;">
        {{-- Pagination --}}
        {{ $orders->appends(request()->query())->links('vendor.pagination.bootstrap-5') }}
    </div>
</div>
<!-- Modal Hủy đơn -->
<div class="modal fade" id="cancelOrderModal" tabindex="-1" role="dialog" aria-labelledby="cancelOrderModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" action="{{ route('orders.cancel') }}">
            @csrf
            <input type="hidden" name="order_id" id="cancelOrderId">
            <div class="modal-content">
                <div class="modal-header" style="justify-content: space-between">
                    <h5 class="modal-title">Xác nhận hủy đơn hàng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Đóng"
                        style="border: 0; background: 0;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc chắn muốn hủy đơn hàng này không?</p>
                    <div class="form-group">
                        <label>Lý do hủy đơn</label>
                        @php
                            $reasons = [
                                'Tôi muốn thay đổi sản phẩm',
                                'Tôi đặt nhầm đơn hàng',
                                'Tôi tìm được giá tốt hơn',
                                'Thời gian giao hàng quá lâu',
                                'Lý do khác',
                            ];
                        @endphp
                        @foreach ($reasons as $reason)
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="selected_reason"
                                    value="{{ $reason }}" id="reason_{{ \Str::slug($reason) }}">
                                <label class="form-check-label" for="reason_{{ \Str::slug($reason) }}">
                                    {{ $reason }}
                                </label>
                            </div>
                        @endforeach
                    </div>

                    <div class="form-group mt-3" id="otherReasonGroup" style="display: none;">
                        <label for="cancelReason">Nhập lý do cụ thể</label>
                        <textarea name="reason" id="cancelReason" class="form-control" rows="3" placeholder="Nhập lý do cụ thể..."></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-danger">Xác nhận hủy</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.btn-cancel-order').forEach(button => {
            button.addEventListener('click', function() {
                const orderId = this.getAttribute('data-order-id');
                document.getElementById('cancelOrderId').value = orderId;
            });
        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cancelForm = document.querySelector('#cancelOrderModal form');
        const orderIdInput = document.getElementById('cancelOrderId');
        const reasonTextarea = document.getElementById('cancelReason');
        const reasonRadios = document.querySelectorAll('input[name="selected_reason"]');
        const otherReasonGroup = document.getElementById('otherReasonGroup');

        // Mở modal
        document.querySelectorAll('.btn-cancel-order').forEach(button => {
            button.addEventListener('click', function() {
                orderIdInput.value = this.getAttribute('data-order-id');
                reasonTextarea.value = '';
                reasonRadios.forEach(r => r.checked = false);
                otherReasonGroup.style.display = 'block'; // ✅ Luôn hiển thị textarea
            });
        });

        // Khi chọn radio
        reasonRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                // ✅ Không ẩn textarea nữa
                if (this.value !== 'Lý do khác') {
                    reasonTextarea.value = ''; // clear nếu không phải lý do khác
                }
            });
        });

        // Khi người dùng nhập textarea → auto chọn "Lý do khác"
        reasonTextarea.addEventListener('input', function() {
            const otherReasonRadio = document.querySelector(
                'input[name="selected_reason"][value="Lý do khác"]');
            if (this.value.trim() !== '') {
                otherReasonRadio.checked = true;
            }
        });

        // Validate khi submit
        cancelForm.addEventListener('submit', function(e) {
            const selected = document.querySelector('input[name="selected_reason"]:checked');
            if (!selected) {
                alert('Vui lòng chọn lý do hủy đơn hàng.');
                e.preventDefault();
                return;
            }

            if (selected.value === 'Lý do khác') {
                if (!reasonTextarea.value.trim()) {
                    alert('Vui lòng nhập lý do cụ thể.');
                    reasonTextarea.focus();
                    e.preventDefault();
                    return;
                }
            }
        });
    });
</script>
