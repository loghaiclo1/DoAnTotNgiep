window.Echo.channel('books')
    .listen('.book.quantity.updated', (e) => {
        const bookId = e.bookId;
        const quantity = parseInt(e.newQuantity);

        // Cập nhật các khối thêm giỏ hàng theo số lượng mới
        document.querySelectorAll(`.add-to-cart-container[data-book-id="${bookId}"]`).forEach(container => {
            container.innerHTML = '';

            if (quantity <= 0) {
                container.innerHTML = `
                    <button class="btn btn-secondary btn-add-to-cart btn-disabled" disabled>
                        <i class="bi bi-bag-plus me-2"></i>Hết hàng
                    </button>
                `;
            } else {
                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                container.innerHTML = `
                    <form action="/cart/add" method="POST" class="add-to-cart-form">
                        <input type="hidden" name="_token" value="${token}">
                        <input type="hidden" name="book_id" value="${bookId}">
                        <button type="submit" class="btn btn-primary btn-add-to-cart">
                            <i class="bi bi-bag-plus me-2"></i>Thêm vào giỏ
                        </button>
                    </form>
                `;
                const form = container.querySelector('form');
                if (typeof bindAddToCartAjax === 'function') bindAddToCartAjax(form);
            }
        });

        document.querySelectorAll(`.product-overlay[data-book-id="${bookId}"]`).forEach(overlay => {
            overlay.innerHTML = '';

            if (quantity <= 0) {
                overlay.innerHTML = `
                    <button class="btn btn-secondary btn-add-to-cart btn-disabled" disabled>
                        <i class="bi bi-bag-plus me-2"></i>Hết hàng
                    </button>
                `;
            } else {
                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                overlay.innerHTML = `
                    <form action="/cart/add" method="POST" class="add-to-cart-form">
                        <input type="hidden" name="_token" value="${token}">
                        <input type="hidden" name="book_id" value="${bookId}">
                        <button type="submit" class="btn btn-primary btn-add-to-cart">
                            <i class="bi bi-bag-plus me-2"></i>Thêm vào giỏ hàng
                        </button>
                    </form>
                `;
                const form = overlay.querySelector('form');
                if (typeof bindAddToCartAjax === 'function') bindAddToCartAjax(form);
            }
        });

        document.querySelectorAll(`.product-card[data-book-id="${bookId}"]`).forEach(card => {
            const target = card.querySelector('.add-to-cart-form, .btn-add-to-cart')?.parentElement;
            if (!target) return;

            if (quantity <= 0) {
                target.innerHTML = `
                    <button class="btn btn-secondary btn-add-to-cart btn-disabled" disabled>
                        <i class="bi bi-bag-plus me-2"></i>Hết hàng
                    </button>
                `;
            } else {
                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                target.innerHTML = `
                    <form action="/cart/add" method="POST" class="add-to-cart-form">
                        <input type="hidden" name="_token" value="${token}">
                        <input type="hidden" name="book_id" value="${bookId}">
                        <button type="submit" class="btn btn-primary btn-add-to-cart">
                            <i class="bi bi-bag-plus me-2"></i>Thêm vào giỏ
                        </button>
                    </form>
                `;
                const form = target.querySelector('form');
                if (typeof bindAddToCartAjax === 'function') bindAddToCartAjax(form);
            }
        });

        // Cập nhật hiển thị số lượng
        document.querySelectorAll(`.book-quantity[data-book-id="${bookId}"]`).forEach(el => {
            el.textContent = quantity > 0 ? quantity : '';
        });
    });
