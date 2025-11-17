import { getProfile } from "../../services/profile_service.js";

document.addEventListener("DOMContentLoaded", async () => {
    const coverPhoto = document.querySelector(".cover-photo");
    const userName = document.getElementById("personal_profile-name");
    const avatarImg = document.getElementById("avatar__img-main");

    if (!coverPhoto) {
        console.error("Không tìm thấy .cover-photo");
        return;
    }

    try {
        const userId = localStorage.getItem("userId");
        if (!userId) {
            console.warn("Không tìm thấy userId trong localStorage");
            return;
        }

        let profile;

        const profileSession = sessionStorage.getItem("profile");

        // if (profileSession) {
        //     profile = JSON.parse(profileSession);
        //     console.log("Thông tin profile từ sessionStorage:", profile);
        // } else {
        profile = await getProfile(userId);
        console.log("Thông tin profile từ API:", profile);
        sessionStorage.setItem("profile", JSON.stringify(profile));
        // }

        userName.textContent = profile?.fullName ?? "Người dùng Facebook";


        const mediaUrl = profile?.coverImgUrl || "";

        if (mediaUrl) {
            coverPhoto.style.backgroundImage = `url('${mediaUrl}')`;
            coverPhoto.style.backgroundSize = "cover";
            coverPhoto.style.backgroundPosition = "center";
            coverPhoto.style.backgroundRepeat = "no-repeat";
        } else {
            console.warn("Profile không có URL ảnh bìa");
        }

        const profilePic = document.querySelector(".profile-pic");
        if (profilePic && profile.backgroundImgUrl) {
            profilePic.innerHTML = `
            <img src="${profile.backgroundImgUrl}"
                 style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
        `;
            setAvatar(profile.backgroundImgUrl);
        }
    } catch (err) {
        console.error("Lỗi khi lấy thông tin profile:", err);
    }
    async function setAvatar(url) {
        if (!avatarImg) return;

        if (url && url.trim() !== "") {
            // có link mới từ API → đổi avatar
            avatarImg.src = url;
        } else {
            // không có link → quay về ảnh mặc định
            avatarImg.src = avatarImg.dataset.defaultSrc;
        }
    }

});
