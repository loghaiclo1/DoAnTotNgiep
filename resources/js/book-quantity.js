window.Echo.channel('books')
    .listen('.book.quantity.updated', (e) => {
        const bookId = e.bookId;
        const quantity = parseInt(e.newQuantity);

        // 1. Xử lý nút trong .add-to-cart-container
        const addToCartContainers = document.querySelectorAll(`.add-to-cart-container[data-book-id="${bookId}"]`);
        addToCartContainers.forEach(container => {
            container.innerHTML = '';

            if (quantity <= 0) {
                const button = document.createElement('button');
                button.className = 'btn btn-secondary btn-add-to-cart btn-disabled';
                button.disabled = true;
                button.innerHTML = '<i class="bi bi-bag-plus me-2"></i>Hết hàng';
                container.appendChild(button);
            } else {
                const form = document.createElement('form');
                form.action = '/cart/add';
                form.method = 'POST';
                form.className = 'add-to-cart-form';

                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                form.innerHTML = `
                    <input type="hidden" name="_token" value="${token}">
                    <input type="hidden" name="book_id" value="${bookId}">
                    <button type="submit" class="btn btn-primary btn-add-to-cart">
                        <i class="bi bi-bag-plus me-2"></i>Thêm vào giỏ
                    </button>
                `;
                container.appendChild(form);
                bindAddToCartAjax(form);
            }
        });

        // 2. Xử lý nút trong .product-overlay
        const overlays = document.querySelectorAll(`.product-overlay[data-book-id="${bookId}"]`);
        overlays.forEach(overlay => {
            overlay.innerHTML = '';

            if (quantity <= 0) {
                const button = document.createElement('button');
                button.className = 'btn btn-secondary btn-add-to-cart btn-disabled';
                button.disabled = true;
                button.innerHTML = '<i class="bi bi-bag-plus me-2"></i>Hết hàng';
                overlay.appendChild(button);
            } else {
                const form = document.createElement('form');
                form.action = '/cart/add';
                form.method = 'POST';
                form.className = 'add-to-cart-form';

                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                form.innerHTML = `
                    <input type="hidden" name="_token" value="${token}">
                    <input type="hidden" name="book_id" value="${bookId}">
                    <button type="submit" class="btn btn-primary btn-add-to-cart">
                        <i class="bi bi-bag-plus me-2"></i>Thêm vào giỏ hàng
                    </button>
                `;
                overlay.appendChild(form);
                bindAddToCartAjax(form);
            }
        });
        document.querySelectorAll(`.product-card[data-book-id="${bookId}"]`).forEach(card => {
            const target = card.querySelector('.add-to-cart-form, .btn-add-to-cart')?.parentElement;
            if (!target) return;
            target.innerHTML = '';

            if (quantity <= 0) {
                target.innerHTML = `
                    <button class="btn btn-secondary btn-add-to-cart btn-disabled" disabled>
                        <i class="bi bi-bag-plus me-2"></i>Hết hàng
                    </button>
                `;
            } else {
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
        // 3. Cập nhật số lượng hiển thị
        const quantityDisplays = document.querySelectorAll(`.book-quantity[data-book-id="${bookId}"]`);
        quantityDisplays.forEach(el => {
            el.textContent = quantity > 0 ? quantity : '';
        });
    });
