import { getImageDemo } from "../../services/media_service.js";

// === LOAD ẢNH TỪ API VÀO PHOTOS-GRID ===
async function loadProfilePhotos() {
    const profile = JSON.parse(sessionStorage.getItem("profile"));
    if (!profile) return;

    const list = await getImageDemo(profile.profileId);

    const grid = document.getElementById("profilePhotosGrid");
    if (!grid) return;

    // grid.innerHTML = list.map(item => `
    //     <div class="photo-thumb"
    //          data-media-id="${item.mediaId}"
    //          style="background-image: url('${item.mediaUrl}');">
    //     </div>
    // `).join("");
    grid.innerHTML = list.map(item => `
            <div class="photo-thumb" data-media-id="${item.mediaId}">
                <img src="${item.mediaUrl}" alt="">
            </div>
            `).join("");

}

document.addEventListener("DOMContentLoaded", () => {
    loadProfilePhotos();
});
