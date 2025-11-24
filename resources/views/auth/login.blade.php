<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Facebook – Đăng nhập hoặc đăng ký</title>
  @vite('resources/js/pages/login.js')  <!-- Đảm bảo bạn tham chiếu đúng tệp này -->
  <link rel="stylesheet" href="{{ mix('resources/css/pages/login.css') }}" />
</head>

<body>
  <div class="container" role="main">
    <div class="left" aria-hidden="false">
      <img class="fb-logo" src="https://static.xx.fbcdn.net/rsrc.php/y1/r/4lCu2zih0ca.svg" alt="Facebook">
      <h2>Facebook giúp bạn kết nối và chia sẻ với mọi người trong cuộc sống của bạn.</h2>
    </div>

    <div class="content-right">
        <div class="right" aria-labelledby="loginTitle">
        <form id="loginForm" novalidate>
            <input id="email" class="input" type="text" placeholder="Email hoặc số điện thoại" autocomplete="username" required>
            <!--nhập mật khẩu-->
            <div class="password-wrap">
            <input id="pass" class="input" type="password" placeholder="Mật khẩu" autocomplete="current-password" required>
            <button type="button" class="toggle-pass" id="togglePass" aria-pressed="false" style="display:none">
                <!-- Mắt mở -->
                <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="22" height="22">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 
                    8.268 2.943 9.542 7-1.274 4.057-5.065 
                    7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>

                <!-- Mắt đóng -->
                <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="22" height="22" style="display:none">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.956 
                    9.956 0 012.191-3.362m3.353-2.198A9.956 
                    9.956 0 0112 5c4.477 0 8.268 2.943 
                    9.542 7a9.96 9.96 0 01-4.303 
                    5.033M15 12a3 3 0 11-6 0 3 3 
                    0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 3l18 18" />
                </svg>
            </button>
            </div>

            <div class="msg" id="message" aria-live="polite"></div>

            <button id="loginBtn" class="login-btn" type="submit">Đăng nhập</button>

            <div class="links" style="text-align:center;">
            <a href="#" id="forgot">Quên mật khẩu?</a>
            </div>

            <hr>

            <a href="{{ route('register') }}" class="signup-btn" id="signup">Tạo tài khoản mới</a>
        </form>
        </div>
        <div class="page-msg" style="text-align:center; margin-top: 20px;">
            <a href="#" id="createPage">Tạo Trang</a> dành cho người nổi tiếng, thương hiệu hoặc doanh nghiệp.
        </div>
    </div>
  </div>
</body>
</html>
