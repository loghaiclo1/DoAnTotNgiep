window.Echo.private(`user.${authUserId}`)
    .listen('.account.locked', async () => {
        console.log("📥 Nhận sự kiện account.locked");

        // Đăng xuất ngay lập tức
        await fetch('/logout', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            },
            credentials: 'same-origin'
        });

        // Ghi flag vào localStorage để hiển thị thông báo sau khi redirect
        localStorage.setItem('account_locked', 'true');

        // Chuyển về trang đăng nhập
        window.location.href = '/login';
    });
