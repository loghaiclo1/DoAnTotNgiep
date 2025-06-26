import './bootstrap';

document.addEventListener("DOMContentLoaded", function () {
    // Lặp qua các span có id bắt đầu bằng status-order-
    document.querySelectorAll("[id^='status-order-']").forEach((el) => {
        const orderId = el.dataset.statusFor;

        if (!orderId) return;

        window.Echo.private(`orders.${orderId}`)
            .listen('.order.status.updated', (e) => {
                const statusSpan = document.querySelector(`#status-order-${orderId}`);
                if (statusSpan) {
                    statusSpan.textContent = e.status;

                    const classMap = {
                        'Đang chờ': 'processing',
                        'Đã xác nhận': 'confirmed',
                        'Đang giao hàng': 'shipped',
                        'Hoàn thành': 'completed',
                        'Hoàn tất': 'completed',
                        'Hủy đơn': 'cancelled',
                    };

                    statusSpan.className = 'status ' + (classMap[e.status] || 'processing');
                }
            });
    });
});
