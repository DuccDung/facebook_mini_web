<!doctype html>
<html lang="vi">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Xác thực email – Demo</title>
     @vite('resources/js/pages/confirm_mail.js')  
    <link rel="stylesheet" href="{{ mix('resources/css/pages/confirm_mail.css') }}" />
  </head>

  <body>
    <header>
      <div class="brand">facebook</div>
    </header>

    <main class="main">
      <section class="card" role="region" aria-label="Xác thực email">
        <div class="card-header">Xác thực email</div>

        <div class="card-body">
          <!-- Alert lỗi (ẩn mặc định). Sẽ hiện khi có lỗi trong quá trình gửi email xác thực -->
          <div id="alert-invalid" class="alert hidden" role="alert" aria-live="polite">
            <div class="alert-icon" aria-hidden="true">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                <path d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2V9h2v5z" />
              </svg>
            </div>
            <div>
              <h4 id="alert-title">Có lỗi xảy ra!</h4>
              <p id="alert-desc">Vui lòng thử lại sau.</p>
            </div>
          </div>

          <p class="desc">
            Vui lòng kiểm tra hộp thư email của bạn và nhấn vào liên kết xác thực để tiếp tục.
          </p>

          <div class="hint" aria-live="polite">
            <div>Chúng tôi đã gửi email xác thực đến:</div>
            <b id="email-display">j**@******</b> <!-- Đây là email người dùng sẽ thấy -->
          </div>

          <div class="actions">
            <div class="btns">
              <button type="button" class="btn btn-primary" id="btn-resend" disabled>Gửi lại email xác thực</button>
            </div>
            <div id="countdown" class="tiny-link">Còn lại: <span id="timer">60</span> giây</div>
          </div>
        </div>
      </section>
    </main>

  
  </body>
</html>
