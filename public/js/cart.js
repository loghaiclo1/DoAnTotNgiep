function bindAddToCartAjax(form) {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(form);
        const token = document.querySelector('meta[name="csrf-token"]')?.content;
        const quantityInput = form.querySelector('.quantity-input');
        const requestedQuantity = quantityInput ? parseInt(quantityInput.value) : 1;
        const errorContainer = form.querySelector('.error-message') || form.parentElement.querySelector('.error-message') || document.createElement('div');

        if (!form.contains(errorContainer)) {
            errorContainer.classList.add('error-message');
            form.appendChild(errorContainer);
        }

        errorContainer.textContent = '';

        if (!token) {
            Swal.fire({
                icon: 'error',
                title: 'Lỗi!',
                text: 'Không tìm thấy CSRF token!',
                showConfirmButton: false,
                timer: 3000
            });
            return;
        }

        if (requestedQuantity < 1) {
            errorContainer.textContent = 'Số lượng phải lớn hơn 0!';
            Swal.fire({
                icon: 'error',
                title: 'Lỗi!',
                text: 'Số lượng phải lớn hơn 0!',
                showConfirmButton: false,
                timer: 3000
            });
            return;
        }

        if (!quantityInput) {
            formData.append('quantity', requestedQuantity);
        }

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-Token': token,
                'Accept': 'application/json; charset=utf-8',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(data => {
                    throw new Error(data.message || 'Lỗi không xác định');
                });
            }
            return response.json();
        })
        .then(data => {
            Swal.fire({
                icon: data.status === 'success' ? 'success' : 'error',
                title: data.status === 'success' ? 'Thành công!' : 'Lỗi!',
                text: data.message,
                showConfirmButton: false,
                timer: 3000
            });

            if (data.status === 'success') {
                if (quantityInput) {
                    quantityInput.value = 1;
                }
                const cartCount = document.querySelector('.cart-count');
                if (cartCount && data.new_quantity) {
                    cartCount.textContent = parseInt(cartCount.textContent || 0) + requestedQuantity;
                }
            } else {
                errorContainer.textContent = data.message;
            }
        })
        .catch(error => {
            console.error('AJAX Error:', error.message);
            errorContainer.textContent = error.message;
            Swal.fire({
                icon: 'error',
                title: 'Lỗi!',
                text: 'Đã có lỗi xảy ra: ' + error.message,
                showConfirmButton: false,
                timer: 3000
            });
        });
    });
}

// Xử lý quantity selector
document.querySelectorAll('.quantity-selector').forEach(selector => {
    const bookId = selector.getAttribute('data-book-id');
    const quantityInput = selector.querySelector('.quantity-input');
    const decreaseBtn = selector.querySelector('.quantity-btn.decrease');
    const increaseBtn = selector.querySelector('.quantity-btn.increase');
    const errorContainer = selector.parentElement.querySelector('.error-message');

    if (bookId && quantityInput && decreaseBtn && increaseBtn) {
        quantityInput.addEventListener('input', () => {
            let value = parseInt(quantityInput.value) || 1;
            if (value < 1) {
                quantityInput.value = 1;
                errorContainer.textContent = 'Số lượng phải lớn hơn 0!';
            } else {
                errorContainer.textContent = '';
            }
        });

        decreaseBtn.addEventListener('click', () => {
            let value = parseInt(quantityInput.value) || 1;
            if (value > 1) {
                quantityInput.value = value - 1;
                errorContainer.textContent = '';
            }
        });

        increaseBtn.addEventListener('click', () => {
            let value = parseInt(quantityInput.value) || 0;
            quantityInput.value = value + 1;
            errorContainer.textContent = '';

        });
    }
});

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.add-to-cart-form').forEach(form => {
        bindAddToCartAjax(form);
    });
});
