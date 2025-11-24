import { loginService } from "../services/auth_service.js";
import { domain } from "../utils/domain.js";
    (function(){
      // Elements
      const form = document.getElementById('loginForm');
      const emailInput = document.getElementById('email');
      const passInput = document.getElementById('pass');
      const toggleBtn = document.getElementById('togglePass');
      const loginBtn = document.getElementById('loginBtn');
      const msgEl = document.getElementById('message');

      // Small helper: show message (type: 'error'|'info'|'success')
      function showMessage(text, type){
        msgEl.textContent = text || '';
        if(!text) { msgEl.style.color=''; return; }
        if(type === 'error') msgEl.style.color = '#e53935';
        else if(type === 'success') msgEl.style.color = '#2e7d32';
        else msgEl.style.color = '#374151';
      }

     // Ẩn/hiện nút mắt khi có/không có ký tự
      passInput.addEventListener('input', () => {
        if(passInput.value.length > 0){
          toggleBtn.style.display = 'block';
          if(passInput.type === 'password'){
            eyeClosed.style.display = 'block';
            eyeOpen.style.display = 'none';
          }
        } else {
          toggleBtn.style.display = 'none';
        }
      });

      //ẩn/hiện mật khẩu
      toggleBtn.addEventListener('click', () => {
        if(passInput.type === 'password'){
          passInput.type = 'text';
          eyeOpen.style.display = 'block';
          eyeClosed.style.display = 'none';
          toggleBtn.setAttribute('aria-pressed','true');
        } else {
          passInput.type = 'password';
          eyeOpen.style.display = 'none';
          eyeClosed.style.display = 'block';
          toggleBtn.setAttribute('aria-pressed','false');
        }
        // giữ con trỏ ở cuối
        passInput.focus();
        const val = passInput.value;
        passInput.value = '';
        passInput.value = val;
      });

      // Validate email hoặc số điện thoại
      function validateEmailLike(value){
        if(!value) return false;
        const isPhone = /^\+?\d[\d\s\-]{5,}$/.test(value);
        const isEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
        return isPhone || isEmail;
      }

      // Set trạng thái loading cho nút login
      function setLoading(loading){
        if(loading){
          loginBtn.disabled = true;
          loginBtn.innerHTML = '<span class="spinner" aria-hidden="true"></span>Đang kiểm tra...';
        } else {
          loginBtn.disabled = false;
          loginBtn.textContent = 'Đăng nhập';
        }
      }

      // Xử lý submit form
        form.addEventListener('submit', async function(e){
          e.preventDefault();
          showMessage('', '');
          const identifier = emailInput.value.trim();
          const password = passInput.value;

          // Validate
          if(!identifier){
            showMessage('Vui lòng nhập Email hoặc số điện thoại.', 'error');
            emailInput.focus();
            return;
          }
          if(!validateEmailLike(identifier)){
            showMessage('Vui lòng nhập định dạng email hoặc số điện thoại hợp lệ.', 'error');
            emailInput.focus();
            return;
          }
          if(!password){
            showMessage('Vui lòng nhập mật khẩu.', 'error');
            passInput.focus();
            return;
          }

          setLoading(true);

          try {
            const data = await loginService({
            acc_info: identifier,
            password: password
          });

            if (data.accessToken && data.refreshToken) {

              // Lưu token vào localStorage
              localStorage.setItem('accessToken', data.accessToken);
              localStorage.setItem('refreshToken', data.refreshToken);
              localStorage.setItem('tokenExpiresAt', data.expiration);
              // Lưu account vào localStorage
              localStorage.setItem('account', JSON.stringify(data.account));
              localStorage.setItem('userId', data.account.accountId);
              localStorage.setItem('email', data.account.email);
              console.log("login.js - login thành công:", data.account.accountName);
              // Đăng nhập tcong chuyển sang Home
              setTimeout(() => {
                window.location.href = "/personal"; // Laravel route
              }, 800);
            } else {
              showMessage('Sai email hoặc mật khẩu.', 'error');
              shake(loginBtn);
            }

          } catch (err) {
            console.error(err);
            showMessage('Không thể kết nối đến server hoặc thông tin sai.', 'error');
            shake(loginBtn);
          } finally {
            setLoading(false);
          }
        });


      // Hiệu ứng rung nút login khi lỗi
      function shake(el){
        el.animate([
          { transform:'translateX(0)' },
          { transform:'translateX(-6px)' },
          { transform:'translateX(6px)' },
          { transform:'translateX(-4px)' },
          { transform:'translateX(4px)' },
          { transform:'translateX(0)' }
        ], { duration: 420, easing: 'ease' });
      }

      //cho phép Enter/Space toggle hiển thị mật khẩu
      toggleBtn.addEventListener('keydown', function(e){
        if(e.key === 'Enter' || e.key === ' ') { e.preventDefault(); toggleBtn.click(); }
      });

      // Nhấn Enter trong input mật khẩu = submit
      passInput.addEventListener('keydown', function(e){
        if(e.key === 'Enter' && !loginBtn.disabled) loginBtn.click();
      });

      // focus vào ô email khi load trang
      window.addEventListener('load', function(){ emailInput.focus(); });
    })();


