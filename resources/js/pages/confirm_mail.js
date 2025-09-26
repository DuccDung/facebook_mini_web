import { resendConfirmMailService } from "../services/auth_service.js";

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

var storedEmail = localStorage.getItem('email');
if (storedEmail) {
    var email = JSON.parse(storedEmail);
    emailDisplay.textContent = email;
}

// Giả lập việc gửi email xác thực
async function onResend() {
    if (storedEmail) {

        // processing async send mail...
        var storedUserId = localStorage.getItem('userId');
        var storedToken = localStorage.getItem('token_email');
        var email = JSON.parse(storedEmail);
        var userId = JSON.parse(storedUserId);
        var token = JSON.parse(storedToken);

        const res = await resendConfirmMailService(userId, email, token);
        if (res && res.status === 200) {
            try {
                localStorage.setItem('email', JSON.stringify(email));
                localStorage.setItem('userId', JSON.stringify(userId));
                localStorage.setItem('token_email', JSON.stringify(res.data.token));

                // Email sent successfully
                btnResend.disabled = true; // disable btn send email
                var email = JSON.parse(storedEmail);
                emailDisplay.textContent = email;
                hideAlert();
                alert('Facebook – Đã gửi email xác thực tới:' + email);
                // Reset countdown
                countdown = 60;
                updateTimer();
                clearInterval(countdownInterval);
                startCountdown();
            } catch (error) {
                console.error('Error resending confirm mail:');
                showAlert('Lỗi gửi lại email', 'Đã có lỗi xảy ra khi gửi lại email xác thực. Vui lòng thử lại sau.');
            }
        }
        else {
            console.error('Error resending confirm mail:');
            showAlert('Lỗi gửi lại email', 'Đã có lỗi xảy ra khi gửi lại email xác thực. Vui lòng thử lại sau.');
        }
    }
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