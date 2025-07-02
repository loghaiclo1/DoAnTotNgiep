import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true,
    encrypted: true,
    authEndpoint: '/broadcasting/auth',
});

document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll("[id^='status-order-']").forEach((el) => {
        const orderId = el.dataset.statusFor;
        if (!orderId) return;

        window.Echo.private(`orders.${orderId}`)
            .listen('.order.status.updated', (e) => {
                const status = e.status;


                const classMap = {
                    'Đang chờ': 'processing',
                    'Đã xác nhận': 'confirmed',
                    'Đang giao hàng': 'shipped',
                    'Hoàn thành': 'completed',
                    'Hoàn tất': 'completed',
                    'Hủy đơn': 'cancelled',
                };

                el.textContent = status;
                el.className = 'status ' + (classMap[status] || 'processing');

                const trackingContainer = document.querySelector(`#tracking${orderId} .tracking-timeline`);
                if (trackingContainer) {
                    fetch(`/orders/${orderId}/tracking-html`)
                        .then((res) => {
                            if (!res.ok) throw new Error(`HTTP ${res.status}`);
                            return res.text();
                        })
                        .then((html) => {
                            trackingContainer.innerHTML = html;
                        })
                        .catch((err) => {
                            console.error(`❌ Không thể cập nhật timeline đơn hàng #${orderId}:`, err);
                        });
                }
            });
    });
});
