window.Echo.channel('books')
    .listen('.book.price.updated', (e) => {
        const bookId = e.bookId;
        const newPrice = parseInt(e.newPrice);
        const oldPrice = parseInt(e.oldPrice);
        const bookName = e.bookName;

        // Cập nhật các vị trí hiển thị giá
        const priceElements = document.querySelectorAll(`.current-price[data-book-id="${bookId}"]`);
        priceElements.forEach(el => {
            el.textContent = formatPrice(newPrice) + '₫';

            const quantityInput = el.closest('.cart-item')?.querySelector(`input.quantity-input[name="quantity[${bookId}]"]`);
            const totalElement = el.closest('.cart-item')?.querySelector('.item-total-value');

            if (quantityInput && totalElement) {
                const qty = parseInt(quantityInput.value) || 0;
                totalElement.textContent = formatPrice(qty * newPrice) + '₫';
            }
        });

        if (window.location.pathname === '/cart') {
            let totalAmount = 0;
            document.querySelectorAll('.cart-item').forEach(item => {
                const priceText = item.querySelector('.current-price')?.textContent.replace(/[^\d]/g, '') || '0';
                const qtyInput = item.querySelector('.quantity-input');
                if (!qtyInput) return;

                const price = parseInt(priceText);
                const qty = parseInt(qtyInput.value);
                totalAmount += price * qty;
            });

            const subtotalEl = document.querySelector('#subtotal');
            const totalEl = document.querySelector('#total');
            if (subtotalEl) subtotalEl.textContent = formatPrice(totalAmount) + '₫';
            if (totalEl) totalEl.textContent = formatPrice(totalAmount) + '₫';

            const toastContainer = document.getElementById('custom-toast');
            if (toastContainer) {
                const toast = document.createElement('div');
                toast.style.cssText = `
                padding: 16px 20px;
                background-color: #fff;
                color: #333;
                border-left: 5px solid #e67e22;
                border-radius: 8px;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
                max-width: 420px;
                font-size: 14px;
                margin-bottom: 10px;
                animation: fadeIn 0.3s ease;
            `;
            toast.innerHTML = `
            <div style="font-weight: bold; color: #e67e22;">Giá sách đã thay đổi!</div>
            <div style="margin: 4px 0;"><strong>Sách:</strong> ${bookName}</div>
            <div><strong>Giá cũ:</strong> ${formatPrice(oldPrice)}₫ → <strong>Giá mới:</strong> ${formatPrice(newPrice)}₫</div>
            <button style="
                margin-top: 10px;
                padding: 6px 12px;
                border: 1px solid #e67e22;
                background: transparent;
                color: #e67e22;
                border-radius: 4px;
                font-size: 13px;
                cursor: pointer;
                transition: all 0.2s;
            " onmouseover="this.style.background='#e67e22'; this.style.color='#fff'"
              onmouseout="this.style.background='transparent'; this.style.color='#e67e22'">
                Đã hiểu
            </button>
        `;


                // Gắn sự kiện xoá khi nhấn "Đã hiểu"
                toast.querySelector('button').addEventListener('click', () => toast.remove());

                toastContainer.appendChild(toast);
            }
        }
    });

function formatPrice(price) {
    return new Intl.NumberFormat('vi-VN').format(price);
}
