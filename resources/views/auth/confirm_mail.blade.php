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

    <script>
      const btnResend = document.getElementById('btn-resend');
      const alertBox = document.getElementById('alert-invalid');
      const alertTitle = document.getElementById('alert-title');
      const alertDesc = document.getElementById('alert-desc');
      const emailDisplay = document.getElementById('email-display');
      const timerElement = document.getElementById('timer');

      let countdown = 60;
      let countdownInterval;

      function showAlert(title, desc) {
        alertTitle.textContent = title;
        alertDesc.textContent = desc;
        alertBox.classList.remove('hidden');
      }

      function hideAlert() {
        alertBox.classList.add('hidden');
      }

      // Giả lập việc gửi email xác thực
      function onResend() {
        // Giả lập việc gửi email thành công
        emailDisplay.textContent = "johndoe@example.com"; // Hiển thị email đã gửi
        hideAlert();
        alert('Demo only – Đã gửi email xác thực tới: johndoe@example.com');

        // Reset countdown
        countdown = 60;
        updateTimer();
        clearInterval(countdownInterval);
        startCountdown();
      }

      function startCountdown() {
        countdownInterval = setInterval(() => {
          countdown--;
          updateTimer();
          if (countdown <= 0) {
            clearInterval(countdownInterval);
            btnResend.disabled = false; // Kích hoạt lại nút gửi email sau khi hết thời gian
          }
        }, 1000);
      }

      function updateTimer() {
        timerElement.textContent = countdown;
      }

      // Bắt đầu countdown khi tải trang
      startCountdown();

      btnResend.addEventListener('click', onResend);
    </script>
  </body>
</html>
