  window.Echo.channel('books')
        .listen('.book.price.updated', (e) => {
            const bookId = e.bookId;
            const newPrice = parseInt(e.newPrice);
            const oldPrice = parseInt(e.oldPrice);
            const bookName = e.bookName;

            // ✅ Cập nhật các vị trí hiển thị giá (theo bookId)
            const priceElements = document.querySelectorAll(`.current-price[data-book-id="${bookId}"]`);
            priceElements.forEach(el => {
                el.textContent = formatPrice(newPrice) + '₫';

                // ✅ Cập nhật tổng tiền theo số lượng
                const quantityInput = el.closest('.cart-item')?.querySelector(`input.quantity-input[name="quantity[${bookId}]"]`);
                const totalElement = el.closest('.cart-item')?.querySelector('.item-total-value');

                if (quantityInput && totalElement) {
                    const qty = parseInt(quantityInput.value) || 0;
                    totalElement.textContent = formatPrice(qty * newPrice) + '₫';
                }
            });

            // ✅ Nếu đang ở trang giỏ hàng thì cập nhật tổng cộng
            if (window.location.pathname === '/cart') {
                // ✅ Cập nhật lại tổng giỏ hàng
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

                // ✅ Hiển thị Toastify thông báo
                Toastify({
                    text: `
                        <div>
                            <strong>Giá sách đã thay đổi!</strong><br>
                            ${bookName ? `Sách <strong>${bookName}</strong>` : `Sản phẩm ID #${bookId}`}<br>
                            từ <strong>${formatPrice(oldPrice)}₫</strong> thành <strong>${formatPrice(newPrice)}₫</strong>.<br>
                            <button style="margin-top:6px;padding:4px 10px;border:none;background:#e67e22;color:#fff;border-radius:4px;cursor:pointer;" onclick="this.closest('.toastify').remove()">Đã hiểu</button>
                        </div>
                    `,
                    escapeMarkup: false,
                    duration: -1, // Không tự ẩn
                    gravity: 'top',
                    position: 'right',
                    backgroundColor: "#e67e22"
                }).showToast();
            }
        });

    function formatPrice(price) {
        return new Intl.NumberFormat('vi-VN').format(price);
    }
