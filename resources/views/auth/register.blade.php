<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Đăng ký Facebook — demo clone</title>
    @vite('resources/js/pages/register.js')  <!-- Đảm bảo bạn tham chiếu đúng tệp này -->
    <link rel="stylesheet" href="{{ mix('resources/css/pages/register.css') }}" />
</head>
<body>
    <main class="page">
        <section class="brand">
            <div class="logo" aria-label="Facebook">facebook</div>
        </section>

        <section class="card" role="region" aria-labelledby="form-title">
            <header class="card__header">
                <h1 id="form-title">Tạo tài khoản mới</h1>
                <div class="subtitle">Nhanh chóng và dễ dàng.</div>
            </header>

            <div id="alert" class="alert hidden" role="alert" aria-live="assertive"></div>

            <form id="regForm" novalidate>
                <div class="row two">
                    <div class="field">
                        <input type="text" name="lastname" id="lastname" placeholder="Họ" required />
                    </div>
                    <div class="field">
                        <input type="text" name="firstname" id="firstname" placeholder="Tên" required />
                    </div>
                </div>

                <div class="field">
                    <input type="text" name="email" id="email" placeholder="Số di động hoặc email" required />
                </div>

                <div class="field hidden" id="emailConfirmWrap">
                    <input type="text" name="email_confirmation" id="email_confirmation"
                        placeholder="Nhập lại email" />
                </div>

                <div class="field">
                    <input type="password" name="password" id="password" placeholder="Mật khẩu mới" required />
                </div>

                <div class="field">
                    <label for="daySelect" class="label">Ngày sinh</label>
                    <div class="row three">
                        <select id="daySelect" name="birthday_day" title="Ngày" required></select>
                        <select id="monthSelect" name="birthday_month" title="Tháng" required></select>
                        <select id="yearSelect" name="birthday_year" title="Năm" required></select>
                    </div>
                </div>

                <div class="field">
                    <span class="label">Giới tính</span>
                    <div class="row radios" role="radiogroup" aria-label="Giới tính">
                        <label class="radio">
                            <span>Nữ</span>
                            <input type="radio" name="sex" value="1" required />
                        </label>
                        <label class="radio">
                            <span>Nam</span>
                            <input type="radio" name="sex" value="2" />
                        </label>
                        <label class="radio">
                            <span>Tùy chỉnh</span>
                            <input type="radio" name="sex" value="-1" />
                        </label>
                    </div>
                </div>

                <div class="field hidden" id="customGender">
                    <select name="preferred_pronoun" id="pronounSelect">
                        <option value="">Chọn danh xưng</option>
                        <option value="1">Cô ấy: "Chúc cô ấy sinh nhật vui vẻ!"</option>
                        <option value="2">Anh ấy: "Chúc anh ấy sinh nhật vui vẻ!"</option>
                        <option value="6">Họ: "Chúc họ sinh nhật vui vẻ!"</option>
                    </select>
                    <input type="text" name="custom_gender" id="custom_gender"
                        placeholder="Giới tính (không bắt buộc)" />
                </div>

                <p class="legal">
                    Người khác có thể đã tải thông tin liên hệ của bạn lên Facebook.
                    <a href="#" role="link">Tìm hiểu thêm</a>.
                </p>
                <p class="legal">
                    Khi nhấn <strong>Đăng ký</strong>, bạn đồng ý với
                    <a href="#" role="link">Điều khoản</a>,
                    <a href="#" role="link">Chính sách quyền riêng tư</a> và
                    <a href="#" role="link">Chính sách cookie</a>. Bạn có thể nhận thông báo qua SMS và hủy bất
                    cứ lúc nào.
                </p>

                <div class="actions">
                    <button class="btn btn--primary" type="submit" id="submitBtn">Đăng ký</button>
                    <span class="spinner hidden" id="spinner" aria-hidden="true"></span>
                </div>

                <div class="signin">
                    <a href="#" id="signin" aria-label="Bạn đã có tài khoản ư?">Bạn đã có tài khoản ư?</a>
                </div>
            </form>
        </section>
    </main>
</body>
</html>
