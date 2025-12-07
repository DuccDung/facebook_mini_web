document.addEventListener("DOMContentLoaded", () => {

    /* ===== ELEMENTS ===== */
    const sidebarDefault = document.getElementById("sidebarDefault");
    const sidebarRequest = document.getElementById("sidebarRequest");
    const gybb = document.getElementById("gybb");

    const friendsHomeHeader = document.getElementById("friendsHome");
    const friendsSearchInput = document.getElementById("friendsSearchInput");
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
        sidebarRequest.classList.add("hidden");
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
    const item = e.target.closest(".request-user");
    if (!item) return;

    const userId = item.dataset.userId;
    const user = FAKE_USERS[userId];
    if (!user) return;

    const friendsRequest = document.getElementById("friendsRequest");
    friendsRequest.classList.remove("hidden");
    friendsRequest.innerHTML = renderProfilePreview(user);
});


//POP-UP HỦY KẾT BẠN
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

//TẤT CẢ BẠN BÈ
import { getFriends } from "../../services/friend_service";


document.addEventListener("DOMContentLoaded", async () => {
    await loadFriendList();
});

async function loadFriendList() {
    const container = document.getElementById("friendsSidebarList");
    const userId = localStorage.getItem("userId");
    const friendCountEl = document.getElementById("friendCount");

    if (!container|| !friendCountEl) {
        console.error("Không tìm thấy #friendsSidebarList trong HTML");
        return;
    }

    if (!userId) {
        console.error("Không có userId trong localStorage");
        return;
    }

    try {
        const data = await getFriends(userId);
        console.log("Danh sách bạn bè API trả về:", data);

        friendCountEl.textContent = `${data.count} người bạn`;

        const friends = data?.info;

        if (!Array.isArray(friends)) {
            console.error("friends không phải mảng:", friends);
            return;
        }

        container.innerHTML = ""; // Xóa danh sách cũ

        friends.forEach(friend => {
            const friendDiv = document.createElement("div");
            friendDiv.classList.add("friend-user");
            friendDiv.setAttribute("data-user-id", friend.userId);

            friendDiv.innerHTML = `
                <img src="${friend.avatarUrl}" alt="${friend.userName}">
                <div class="info">
                    <strong>${friend.userName}</strong>
                    <p>${friend.mutualFriends} bạn chung</p>
                    <div class="actions">
                        <button class="btn-hkb" data-id="${friend.userId}">Hủy kết bạn</button>
                        <button class="btn-mess" data-id="${friend.userId}">Nhắn tin</button>
                    </div>
                </div>
            `;

            container.appendChild(friendDiv);
        });

    } catch (error) {
        console.error("Lỗi tải danh sách bạn bè:", error);
    }
}

/*khi nhấn vào nhắn tin ở TẤT CẢ BẠN BÈ*/

document.addEventListener("click", async (e) => {
    const btn = e.target.closest(".btn-mess");
    if (!btn) return;

    const friendId = Number(btn.dataset.id);
    await openOrCreateChat(friendId);
});

import { createGroupChat } from "../../services/friend_service";
import { GetConversations } from "../../services/conversation_service";

async function openOrCreateChat(friendId) {
    const userId = Number(localStorage.getItem("userId"));

    // 1️⃣ Lấy danh sách conversation của user
    const res = await GetConversations(userId);
    const conversations = res.data || [];

    // 2️⃣ Kiểm tra xem đã có conversation 1-1 với friend chưa
    let existing = conversations.find(c =>
        c.is_group === false &&
        c.participants?.some(p => p.userId === friendId)
    );

    // 3️⃣ Nếu đã có → mở đoạn chat đó
    if (existing) {
        console.log("ĐÃ CÓ đoạn chat:", existing.id);

        // Lưu ID để trang Messenger đọc được
        localStorage.setItem("activeThreadId", existing.id);

        // Điều hướng sang Messenger
        window.location.href = "/chat";
        return;
    }

    // 4️⃣ Nếu CHƯA có → tạo conversation mới
    console.log("CHƯA CÓ đoạn chat → tạo mới");

    const createdAt = new Date().toISOString();

    const newChat = await createGroupChat(
        userId,
        [friendId],
        false,      // isGroup = false
        "",         // title = rỗng (chat 1-1)
        createdAt
    );

    console.log("Tạo thành công:", newChat);

    // 5️⃣ Lưu ID đoạn chat mới để Messenger mở đúng
    localStorage.setItem("activeThreadId", newChat.id);

    // 6️⃣ Điều hướng sang Messenger
    window.location.href = "/chat";
}

document.addEventListener("click", async (e) => {
    const card = e.target.closest(".friend-user, .suggest-user, .friend-card");
    if (!card) return;

    const userId = card.dataset.userId;
    if (!userId) return;

    // Gọi tới route trả về HTML giao diện profile
    const res = await fetch(`/profile-panel/${userId}`);
    const html = await res.text();

    // Gắn giao diện profile vào main
    const content = document.getElementById("friendsContent");
    content.innerHTML = html;

    // Ẩn sidebar
    document.getElementById("sidebarDefault")?.classList.add("hidden");
});
