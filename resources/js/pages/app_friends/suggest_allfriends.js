document.addEventListener("DOMContentLoaded", () => {

    /* ===== ELEMENTS ===== */
    const sidebarDefault = document.getElementById("sidebarDefault");
    const sidebarSuggest = document.getElementById("sidebarSuggest");
    const sidebarAllFriends = document.getElementById("sidebarAllFriends");
    /*const friendsContent = document.getElementById("friendsContent");*/

    const friendsHomeHeader = document.getElementById("friendsHome");
    const friendsSearchInput = document.getElementById("friendsSearchInput");
    const friendsGrid = document.querySelector(".friends-grid");
    const friendsRequest = document.getElementById("friendsRequest");
    const gybb = document.getElementById("gybb");

    const suggests = document.querySelector('[data-page="suggestions"]');
    const allfriends = document.querySelector('[data-page="allfriends"]');
    const backBtn = document.getElementById("backToHome2");
    const backBtn3 = document.getElementById("backToHome3");

    /* ===== CLICK: Gợi ý KẾT BẠN ===== */
    suggests.addEventListener("click", () => {

        /* Sidebar */
        sidebarDefault.classList.add("hidden");
        /*friendsContent.classList.add("hidden");*/
        sidebarSuggest.classList.remove("hidden");

        /* Main content */
        friendsSearchInput.classList.add("hidden");
        friendsHomeHeader.classList.add("hidden");
        friendsGrid.classList.add("hidden");
        gybb.classList.add("hidden");

        friendsRequest.classList.remove("hidden");
        friendsRequest.innerHTML = renderRequestPlaceholder();
    });

    allfriends.addEventListener("click", () => {

        /* Sidebar */
        sidebarDefault.classList.add("hidden");
        sidebarAllFriends.classList.remove("hidden");

        /* Main content */
        friendsSearchInput.classList.add("hidden");
        friendsHomeHeader.classList.add("hidden");
        friendsGrid.classList.add("hidden");
        gybb.classList.add("hidden");

        friendsRequest.classList.remove("hidden");
        friendsRequest.innerHTML = renderRequestPlaceholder();
    });

    /* ===== CLICK: QUAY LẠI ===== */
    backBtn.addEventListener("click", () => {

        /* Sidebar */
        sidebarSuggest.classList.add("hidden");
        sidebarDefault.classList.remove("hidden");

        /* Main content */
        friendsRequest.classList.add("hidden");
        friendsRequest.innerHTML = "";
        gybb.classList.remove("hidden");

        friendsHomeHeader.classList.remove("hidden");
        friendsGrid.classList.remove("hidden");
        friendsSearchInput.classList.remove("hidden");
    });

    /* ===== CLICK: QUAY LẠI ===== */
    backBtn3.addEventListener("click", () => {

        /* Sidebar */
        sidebarAllFriends.classList.add("hidden");
        sidebarDefault.classList.remove("hidden");

        /* Main content */
        friendsRequest.classList.add("hidden");
        friendsRequest.innerHTML = "";
        gybb.classList.remove("hidden");

        friendsHomeHeader.classList.remove("hidden");
        friendsGrid.classList.remove("hidden");
        friendsSearchInput.classList.remove("hidden");
    });

});

/* ===== TEMPLATE: PLACEHOLDER REQUEST ===== */
function renderRequestPlaceholder() {
    return `
        <div class="request-layout">
            <div class="request-preview">
                <div class="request-center">
                    <i class="ri-group-line"></i>
                    <p>Chọn tên của người mà bạn muốn xem trước trang cá nhân.</p>
                </div>
            </div>
        </div>
    `;
}

document.addEventListener("click", (e) => {

    /* ===== THÊM BẠN ===== */
    const addBtn = e.target.closest(".btn-add");
    if (addBtn) {
        const user = addBtn.closest(".suggest-user");
        const avatar = user.querySelector("img").src;
        const name = user.querySelector("strong").innerText;

        user.classList.add("sent");
        user.innerHTML = `
            <img src="${avatar}">
            <div class="info">
                <strong>${name}</strong>
                <p class="status">Đã gửi lời mời</p>
                <div class="actions">
                    <button class="btn-cancel">Hủy lời mời</button>
                </div>
            </div>
        `;
    }

    /* ===== HỦY LỜI MỜI ===== */
    const cancelBtn = e.target.closest(".btn-cancel");
    if (cancelBtn) {
        const user = cancelBtn.closest(".suggest-user");
        const avatar = user.querySelector("img").src;
        const name = user.querySelector("strong").innerText;

        user.classList.remove("sent");
        user.innerHTML = `
            <img src="${avatar}">
            <div class="info">
                <strong>${name}</strong>
                <p class="mutual">51 bạn chung</p>
                <div class="actions">
                    <button class="btn-add">Thêm bạn bè</button>
                    <button class="btn-delete">Gỡ</button>
                </div>
            </div>
        `;
    }
});

let currentUnfriendId = null;
let currentUnfriendName = "";

// MỞ POPUP khi nhấn "Hủy kết bạn"
document.querySelectorAll(".btn-hkb").forEach(btn => {
    btn.addEventListener("click", function () {
        const user = this.closest(".friend-user");
        currentUnfriendId = user.dataset.userId;
        currentUnfriendName = user.querySelector("strong").innerText;

        document.getElementById("unfriendTitle").innerText =
            `Hủy kết bạn với ${currentUnfriendName}`;

        document.getElementById("unfriendText").innerText =
            `Bạn có chắc chắn muốn hủy kết bạn với ${currentUnfriendName} không?`;

        document.getElementById("unfriendPopup").classList.remove("hidden");
    });
});

// ĐÓNG POPUP
document.getElementById("closeUnfriendPopup").onclick = closeUnfriend;
document.getElementById("cancelUnfriendBtn").onclick = closeUnfriend;

function closeUnfriend() {
    document.getElementById("unfriendPopup").classList.add("hidden");
}

// XÁC NHẬN HỦY
document.getElementById("confirmUnfriendBtn").addEventListener("click", function () {

    // xoá node trong danh sách bạn bè
    const user = document.querySelector(`.friend-user[data-user-id="${currentUnfriendId}"]`);
    if (user) user.remove();

    // đóng popup
    closeUnfriend();

    // TODO: Gọi API thực tế nếu cần
    console.log("Đã hủy kết bạn:", currentUnfriendId);
});

