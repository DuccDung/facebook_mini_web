document.getElementById("logoutBtn").addEventListener("click", function () {
    // Xóa toàn bộ dữ liệu lưu trong trình duyệt
    localStorage.removeItem("accessToken");
    localStorage.removeItem("refreshToken");
    localStorage.removeItem("tokenExpiresAt");
    localStorage.removeItem("account");
    localStorage.removeItem("userId");
    localStorage.removeItem("email");
    localStorage.removeItem("token_email");

    // Nếu bạn muốn giữ theme thì không xóa
    // localStorage.removeItem("theme");

    // Chuyển hướng về trang đăng nhập
    window.location.href = "/"; 
    // hoặc route của bạn:
    // window.location.href = "{{ route('login') }}";
});
