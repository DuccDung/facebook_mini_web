document.addEventListener("DOMContentLoaded", () => {

    /* ===== ELEMENTS ===== */
    const sidebarDefault = document.getElementById("sidebarDefault");
    const sidebarRequest = document.getElementById("sidebarRequest");

    const friendsHomeHeader = document.getElementById("friendsHome");
    const friendsGrid = document.querySelector(".friends-grid");
    const friendsRequest = document.getElementById("friendsRequest");

    const requestMenu = document.querySelector('[data-page="requests"]');
    const backBtn = document.getElementById("backToHome");

    /* ===== CLICK: LỜI MỜI KẾT BẠN ===== */
    requestMenu.addEventListener("click", () => {

        /* Sidebar */
        sidebarDefault.classList.add("hidden");
        sidebarRequest.classList.remove("hidden");

        /* Main content */
        friendsHomeHeader.classList.add("hidden");
        friendsGrid.classList.add("hidden");

        friendsRequest.classList.remove("hidden");
        friendsRequest.innerHTML = renderRequestPlaceholder();
    });

    /* ===== CLICK: QUAY LẠI ===== */
    backBtn.addEventListener("click", () => {

        /* Sidebar */
        sidebarRequest.classList.add("hidden");
        sidebarDefault.classList.remove("hidden");

        /* Main content */
        friendsRequest.classList.add("hidden");
        friendsRequest.innerHTML = "";

        friendsHomeHeader.classList.remove("hidden");
        friendsGrid.classList.remove("hidden");
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
    const item = e.target.closest(".request-user");
    if (!item) return;

    const userId = item.dataset.userId;
    const user = FAKE_USERS[userId];
    if (!user) return;

    const friendsRequest = document.getElementById("friendsRequest");
    friendsRequest.classList.remove("hidden");
    friendsRequest.innerHTML = renderProfilePreview(user);
});


document.addEventListener("DOMContentLoaded", () => {
    const viewSentBtn = document.querySelector("#sidebarRequest .view-sent");
    const sentPopup = document.getElementById("sentPopup");
    const closeBtn = document.getElementById("closeSentPopup");
    const overlay = sentPopup.querySelector(".sent-overlay");

    if (!viewSentBtn) return;

    // MỞ POPUP
    viewSentBtn.addEventListener("click", (e) => {
        e.preventDefault();
        sentPopup.classList.remove("hidden");
        document.body.style.overflow = "hidden"; // khóa nền
    });

    // ĐÓNG
    const closePopup = () => {
        sentPopup.classList.add("hidden");
        document.body.style.overflow = "";
    };

    closeBtn.addEventListener("click", closePopup);
    overlay.addEventListener("click", closePopup);
});

document.addEventListener("click", (e) => {
    const btn = e.target.closest(".btn-cancel");
    if (!btn) return;

    const item = btn.closest(".sent-item");

    item.classList.add("canceled");
    item.innerHTML = `
        <img src="https://i.pravatar.cc/100?1" class="avatar">

        <div class="sent-info">
            <div class="name">Nguyễn Mai Anh</div>
            <div class="status">Đã hủy lời mời</div>
        </div>
    `;
});

document.addEventListener("click", function (e) {

    /* ===== GỠ (XÓA HẲN USER) ===== */
    const removeBtn = e.target.closest(".btn-delete");
    if (removeBtn) {
        const userItem = removeBtn.closest(".request-user, .suggest-user, .friend-card");
        if (userItem) {
            userItem.remove(); // xóa khỏi giao diện
        }
    }

});
