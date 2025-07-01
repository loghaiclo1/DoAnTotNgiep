window.Echo.private(`user.${authUserId}`)
    .listen('.account.locked', () => {
        console.log("📥 Nhận sự kiện account.locked");
        alert("🔒 Tài khoản đã bị khóa. Đang đăng xuất...");

        fetch('/logout', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            },
            credentials: 'same-origin'
        })
        .then(response => {
            console.log("✅ Response logout", response.status);
            if (response.ok) {
                window.location.href = '/login';
            } else {
                console.error("❌ Logout thất bại:", response.status);
            }
        })
        .catch(err => {
            console.error("❌ Lỗi fetch logout:", err);
        });
    });
