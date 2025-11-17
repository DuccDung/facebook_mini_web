import { uploadOnceImage, uploadImageProfile } from "../../services/media_service.js";
//============================ cover photo =========================//
document.addEventListener("DOMContentLoaded", () => {

    // ====== TẠO INPUT FILE ẨN (để không cần thêm vào HTML) ======
    const coverInput = document.createElement("input");
    coverInput.type = "file";
    coverInput.accept = "image/*";
    coverInput.style.display = "none";
    document.body.appendChild(coverInput);

    const addCoverBtn = document.querySelector(".add-cover-btn");
    const coverPhoto = document.querySelector(".cover-photo");
    const profile = JSON.parse(sessionStorage.getItem("profile"));
    // ===================== CLICK NÚT THÊM ẢNH BÌA =====================
    addCoverBtn.addEventListener("click", () => {
        coverInput.click();
    });

    // ===================== KHI CHỌN ẢNH =====================
    coverInput.addEventListener("change", async () => {
        const file = coverInput.files[0];
        if (!file) return;

        // ======= XEM TRƯỚC ẢNH BÌA =======
        const previewURL = URL.createObjectURL(file);
        coverPhoto.style.backgroundImage = `url('${previewURL}')`;

        // ======= TẠO FORM DATA ĐỂ UPLOAD API =======
        const formData = new FormData();
        formData.append("cover_photo", file);

        if (!profile) return;
        try {
            const data = await uploadImageProfile(
                file,
                "cover_image",
                "social_network",
                profile.profileId
            );

            console.log("Ảnh bìa đã được tải lên:", data);

            // cập nhật dữ liệu profile trong sessionStorage
            profile.coverImgUrl = data.mediaUrl;
            sessionStorage.setItem("profile", JSON.stringify(profile));

            showToast("Ảnh bìa đã được cập nhật thành công!");
        } catch (err) {
            console.error("Lỗi khi tải ảnh lên:", err);
            showToast("Lỗi khi tải ảnh lên, vui lòng thử lại!");
        }


    });

    // ===== HÀM HIỂN THỊ TOAST =====
    function showToast(msg) {
        const box = document.getElementById("toastContainer");
        const t = document.createElement("div");
        t.className = "toast";
        t.textContent = msg;
        box.appendChild(t);
        setTimeout(() => t.remove(), 2500);
    }
});