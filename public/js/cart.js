

// Xử lý form thêm vào giỏ hàng bằng AJAX
document.querySelectorAll('.add-to-cart-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(form);
        const token = document.querySelector('meta[name="csrf-token"]')?.content;

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

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-Token': token,
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                return response.text().then(text => {
                    throw new Error(`HTTP error ${response.status}: ${text}`);
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
        })
        .catch(error => {
            console.error('AJAX Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Lỗi!',
                text: 'Đã có lỗi xảy ra: ' + error.message,
                showConfirmButton: false,
                timer: 3000
            });
        });
    });
});
