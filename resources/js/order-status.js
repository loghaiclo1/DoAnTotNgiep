import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true
});

document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll("[id^='status-order-']").forEach((el) => {
        const orderId = el.dataset.statusFor;
        if (!orderId) return;

        window.Echo.private(`orders.${orderId}`)
            .listen('.order.status.updated', (e) => {
                el.textContent = e.status;
                const classMap = {
                    'Đang chờ': 'processing',
                    'Đã xác nhận': 'confirmed',
                    'Đang giao hàng': 'shipped',
                    'Hoàn thành': 'completed',
                    'Hoàn tất': 'completed',
                    'Hủy đơn': 'cancelled',
                };
                el.className = 'status ' + (classMap[e.status] || 'processing');
            });
    });
});
