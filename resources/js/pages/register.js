import { registerService } from "../services/auth_service.js";
import { domain } from "../utils/domain.js";
(
  function () {
    const qs = (s, el = document) => el.querySelector(s);
    const qsa = (s, el = document) => Array.from(el.querySelectorAll(s));

    const regForm = qs('#regForm');
    const alertBox = qs('#alert');
    const email = qs('#email');
    const emailConfirmWrap = qs('#emailConfirmWrap');
    const email2 = qs('#email_confirmation');
    const customGender = qs('#customGender');
    const spinner = qs('#spinner');
    const submitBtn = qs('#submitBtn');

    const daySel = qs('#daySelect');
    const monthSel = qs('#monthSelect');
    const yearSel = qs('#yearSelect');

    const months = [
      "Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6",
      "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"
    ];

    function populateDOB() {
      if (daySel.options.length) return;
      for (let d = 1; d <= 31; d++) {
        const opt = document.createElement('option');
        opt.value = String(d);
        opt.textContent = d;
        daySel.appendChild(opt);
      }
      months.forEach((m, i) => {
        const opt = document.createElement('option');
        opt.value = String(i + 1);
        opt.textContent = m;
        monthSel.appendChild(opt);
      });
      const now = new Date();
      const currentYear = now.getFullYear();
      for (let y = currentYear; y >= 1905; y--) {
        const opt = document.createElement('option');
        opt.value = String(y);
        opt.textContent = y;
        yearSel.appendChild(opt);
      }
      daySel.value = String(now.getDate());
      monthSel.value = String(now.getMonth() + 1);
      yearSel.value = String(currentYear);
    }
    populateDOB();

    function showAlert(msg) {
      alertBox.textContent = msg;
      alertBox.classList.remove('hidden');
    }
    function hideAlert() {
      alertBox.classList.add('hidden');
      alertBox.textContent = '';
    }

    function setFieldError(target, msg) {
      const field = target.classList?.contains('field') ? target : target.closest('.field');
      if (!field) return;
      field.classList.add('is-invalid');
      if (target.setAttribute) target.setAttribute('aria-invalid', 'true');
      let msgEl = field.querySelector('.error-msg');
      if (!msgEl) {
        msgEl = document.createElement('div');
        msgEl.className = 'error-msg';
        field.appendChild(msgEl);
      }
      msgEl.textContent = msg;
      if (!field.querySelector('.err-icon')) {
        const icon = document.createElement('span');
        icon.className = 'err-icon';
        icon.setAttribute('aria-hidden', 'true');
        icon.textContent = '!';
        field.appendChild(icon);
      }
    }

    function clearFieldError(target) {
      const field = target.classList?.contains('field') ? target : target.closest('.field');
      if (!field) return;
      field.classList.remove('is-invalid');
      if (target.removeAttribute) target.removeAttribute('aria-invalid');
      const msgEl = field.querySelector('.error-msg');
      if (msgEl) msgEl.remove();
      const icon = field.querySelector('.err-icon');
      if (icon) icon.remove();
    }

    function isEmail(str) {
      return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(str);
    }
    function isVNPhone(str) {
      return /^(?:\+?84|0)\d{9,10}$/.test(str);
    }

    email.addEventListener('input', () => {
      const val = email.value.trim();
      if (val.includes('@')) {
        emailConfirmWrap.classList.remove('hidden');
      } else {
        emailConfirmWrap.classList.add('hidden');
        email2.value = '';
      }
      clearFieldError(email);
    });

    qsa('input[name="sex"]').forEach(r => {
      r.addEventListener('change', () => {
        if (r.checked && r.value === '-1') {
          customGender.classList.remove('hidden');
        } else if (r.checked) {
          customGender.classList.add('hidden');
          qs('#pronounSelect').value = '';
          qs('#custom_gender').value = '';
        }
        clearFieldError(r);
        clearFieldError(customGender);
      });
    });

    function validateName(id, label) {
      const el = qs('#' + id);
      const val = el.value.trim();
      if (!val) {
        setFieldError(el, 'Vui lòng nhập ' + label.toLowerCase() + '.');
        return false;
      }
      clearFieldError(el);
      return true;
    }

    function validateEmailPhone() {
      const val = email.value.trim();
      if (!val) {
        setFieldError(email, 'Vui lòng nhập số di động hoặc email.');
        return false;
      }
      if (val.includes('@')) {
        if (!isEmail(val)) {
          setFieldError(email, 'Email không hợp lệ.');
          return false;
        }
        if (!emailConfirmWrap.classList.contains('hidden')) {
          if (!email2.value.trim()) {
            setFieldError(email2, 'Vui lòng nhập lại email.');
            return false;
          }
          if (email2.value.trim() !== val) {
            setFieldError(email2, 'Email nhập lại chưa khớp.');
            return false;
          } else {
            clearFieldError(email2);
          }
        }
      } else {
        if (!isVNPhone(val)) {
          setFieldError(email, 'Số điện thoại không hợp lệ (VD: 0xxxxxxxxx hoặc +84xxxxxxxxx).');
          return false;
        }
      }
      clearFieldError(email);
      return true;
    }

    function validatePassword() {
      const el = qs('#password');
      const val = el.value;
      const okLen = val.length >= 8;
      const hasLetter = /[A-Za-zÀ-ỹ]/.test(val);
      const hasDigit = /\d/.test(val);
      if (!(okLen && hasLetter && hasDigit)) {
        setFieldError(el, 'Mật khẩu tối thiểu 8 ký tự, gồm chữ và số.');
        return false;
      }
      clearFieldError(el);
      return true;
    }

    function validateDOB() {
      const field = daySel.closest('.field');
      const d = parseInt(daySel.value, 10);
      const m = parseInt(monthSel.value, 10);
      const y = parseInt(yearSel.value, 10);
      if (!d || !m || !y) {
        setFieldError(field, 'Vui lòng chọn đầy đủ ngày sinh.');
        return false;
      }
      const date = new Date(y, m - 1, d);
      const validDate = date && (date.getFullYear() === y) && (date.getMonth() === m - 1) && (date.getDate() === d);
      if (!validDate) {
        setFieldError(field, 'Ngày sinh không hợp lệ.');
        return false;
      }
      const today = new Date();
      let age = today.getFullYear() - y;
      const hadBDay = (today.getMonth() + 1 > m) || ((today.getMonth() + 1 === m) && (today.getDate() >= d));
      if (!hadBDay) age -= 1;
      if (age < 13) {
        setFieldError(field, 'Bạn phải đủ 13 tuổi để đăng ký.');
        return false;
      }
      if (age > 120) {
        setFieldError(field, 'Vui lòng kiểm tra lại năm sinh.');
        return false;
      }
      clearFieldError(field);
      return true;
    }

    function validateGender() {
      const checked = qsa('input[name="sex"]').find(r => r.checked);
      const field = qs('input[name="sex"]').closest('.field');
      if (!checked) {
        setFieldError(field, 'Vui lòng chọn giới tính.');
        return false;
      }
      if (checked.value === '-1') {
        const p = qs('#pronounSelect');
        if (!p.value) {
          setFieldError(customGender, 'Vui lòng chọn danh xưng.');
          return false;
        }
        clearFieldError(customGender);
      }
      clearFieldError(field);
      return true;
    }

    ['#lastname', '#firstname', '#password', '#email', '#email_confirmation'].forEach(sel => {
      const el = qs(sel);
      if (el) {
        el.addEventListener('input', () => clearFieldError(el));
        el.addEventListener('blur', () => {
          if (sel === '#lastname') validateName('lastname', 'Họ');
          if (sel === '#firstname') validateName('firstname', 'Tên');
          if (sel === '#password') validatePassword();
          if (sel === '#email' || sel === '#email_confirmation') validateEmailPhone();
        });
      }
    });
    [daySel, monthSel, yearSel].forEach(el => el.addEventListener('change', () => validateDOB()));

    regForm.addEventListener('submit', async (e) => {
      e.preventDefault();
      hideAlert();
      let ok = true;
      if (!validateName('lastname', 'Họ')) ok = false;
      if (!validateName('firstname', 'Tên')) ok = false;
      if (!validateDOB()) ok = false;
      if (!validateGender()) ok = false;
      if (!validateEmailPhone()) ok = false;
      if (!validatePassword()) ok = false;

      const firstInvalid = qs('.field.is-invalid input, .field.is-invalid select');
      if (!ok) {
        if (firstInvalid) firstInvalid.focus();
        showAlert('Vui lòng kiểm tra lại các trường được đánh dấu.');
        return;
      }

      // Thay cho đoạn:
      const data = {};
      new FormData(regForm).forEach((v, k) => data[k] = v);

      // Bằng đoạn sau:
      const form = new FormData(regForm);

      // ép kiểu số
      const d = Number(form.get('birthday_day'));
      const m = Number(form.get('birthday_month'));
      const y = Number(form.get('birthday_year'));

      // tính age
      const today = new Date();
      let age = today.getFullYear() - y;
      const hadBDay = (today.getMonth() + 1 > m) || ((today.getMonth() + 1 === m) && (today.getDate() >= d));
      if (!hadBDay) age -= 1;

      // build payload đúng schema
      const payload = {
        firstname: (form.get('firstname') || '').trim(),
        lastname: (form.get('lastname') || '').trim(),
        email: (form.get('email') || '').trim(),
        email_confirmation: (form.get('email_confirmation') || '').trim(), // đúng chính tả
        password: form.get('password') || '',
        birthday: { day: d, month: m, year: y, age },
        sex: Number(form.get('sex')),
        preferred_pronoun: form.get('preferred_pronoun') || '',
        custom_gender: form.get('custom_gender') || '',
        referrer: form.get('referrer') || ''
      };

      // gửi
      //const res1 = registerService(payload);
      // console.log({res1});
      // fetch('http://localhost:5000/api/sign-up', {
      //   method: 'POST',
      //   headers: { 'Content-Type': 'application/json' },
      //   body: JSON.stringify(payload)
      // }).then(async res => {
      //   if (res.ok) {
      //     hideAlert();
      //     alert('Đăng ký thành công!\n\n' + JSON.stringify(payload, null, 2));
      //     regForm.reset();
      //     emailConfirmWrap.classList.add('hidden');
      //     customGender.classList.add('hidden');
      //     daySel.value = String(today.getDate());
      //     monthSel.value = String(today.getMonth() + 1);
      //     yearSel.value = String(today.getFullYear());
      //   } else {
      //     let errMsg = 'Đã có lỗi xảy ra. Vui lòng thử lại.';
      //     try {
      //       const errData = await res.json();
      //       if (errData?.message) errMsg = errData.message;
      //     } catch (err) { }
      //     showAlert(errMsg);
      //   }
      // }).catch(err => {
      //   console.error(err);
      //   showAlert('Không thể kết nối đến máy chủ. Vui lòng thử lại.');
      // }).finally(() => {
      //   spinner.classList.add('hidden');
      //   submitBtn.disabled = false;
      //   submitBtn.classList.remove('disabled');
      // });


      try {
        const res = await registerService(payload);  // Gọi registerService thay cho fetch
        if (res && res.status == 200) {  // Kiểm tra nếu res hợp lệ và res.ok để xác nhận request thành công
          hideAlert();
          // Chuyển hướng và thay thế lịch sử trang hiện tại
          localStorage.setItem('email', JSON.stringify(payload.email));
          localStorage.setItem('userId', JSON.stringify(res.data.userId));
          localStorage.setItem('token_email', JSON.stringify(res.data.token));
          const domain_url = domain.url + 'confirm_mail'; // domain.url still domain.js
          window.location.replace(domain_url); // next page
          regForm.reset();
          emailConfirmWrap.classList.add('hidden');
          customGender.classList.add('hidden');
          daySel.value = String(today.getDate());
          monthSel.value = String(today.getMonth() + 1);
          yearSel.value = String(today.getFullYear());
        } else {
          let errMsg = 'Đã có lỗi xảy ra. Vui lòng thử lại.';
          if (res && res.json) {
            const errData = await res.json();  // Lấy dữ liệu lỗi từ response nếu có
            if (errData?.message) errMsg = errData.message;
          }
          showAlert(errMsg);  // Hiển thị lỗi
        }
      } catch (err) {
        console.error(err);
        showAlert('Không thể kết nối đến máy chủ. Vui lòng thử lại.');
      } finally {
        spinner.classList.add('hidden');
        submitBtn.disabled = false;
        submitBtn.classList.remove('disabled');
      }
      spinner.classList.remove('hidden');
      submitBtn.disabled = true;
      submitBtn.classList.add('disabled');
    });
  })();

  document.getElementById('signin').addEventListener('click', function(e){
    e.preventDefault();
    window.location.href = "/login";
  });
