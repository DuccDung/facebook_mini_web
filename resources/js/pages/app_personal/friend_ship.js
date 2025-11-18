import { findFriend } from "../../services/friend_service.js";
document.addEventListener("DOMContentLoaded", () => {

    const input = document.getElementById("searchUserInput");
    const btn = document.getElementById("searchUserBtn");
    const resultBox = document.getElementById("searchUserResult");

    if (!input || !btn || !resultBox) return;

    btn.addEventListener("click", searchUser);

    async function searchUser() {
        const keyword = input.value.trim();
        if (!keyword) return;

        const currentUserId = localStorage.getItem("userId");
        // https://localhost:7202/api/FriendShip/find?userId=12&email=sd
        try {
            const res = await findFriend(currentUserId, keyword);
            renderUsers(res.data);
        } catch (err) {
            console.error("Search error:", err);
        }
    }

    function renderUsers(list) {
        resultBox.innerHTML = "";

        if (list.length === 0) {
            resultBox.innerHTML = "<p style='color:gray'>Không tìm thấy người dùng.</p>";
            return;
        }

        list.forEach(u => {

            let buttonHtml = "";

            if (u.isFriend && u.status === "accept") {
                // Đã là bạn bè
                buttonHtml = `
                <button class="btn btn-secondary" disabled>
                    ✔ Bạn bè
                </button>
            `;
            }
            else if (!u.isFriend && u.status === "pending") {
                // Đang chờ xác nhận
                buttonHtml = `
                <button class="btn btn-secondary" disabled>
                    ⏳ Đang chờ xác nhận
                </button>
            `;
            }
            else {
                // Chưa là bạn → có thể gửi lời mời kết bạn
                buttonHtml = `
                <button class="btn btn-primary btn-add-friend" data-id="${u.userId}">
                    ➕ Thêm bạn bè
                </button>
            `;
            }

            resultBox.innerHTML += `
            <div class="search-user-item">
                <div class="search-user-avatar"
                    style="background-image:url('${u.avatarUrl || "/default-avatar.png"}')">
                </div>
                <div style="flex:1">
                    <div><strong>${u.userName}</strong></div>
                    <div style="color:gray">${u.email}</div>
                </div>

                ${buttonHtml}
            </div>
        `;
        });

        attachAddFriendEvent();
    }

    async function attachAddFriendEvent() {
        const buttons = document.querySelectorAll(".btn-add-friend");

        buttons.forEach(btn => {
            btn.addEventListener("click", async () => {
                const friendId = btn.dataset.id;
                await sendFriendRequest(friendId);

                // Đổi nút sau khi gửi lời mời
                btn.textContent = "⏳ Đang chờ xác nhận";
                btn.classList.remove("btn-primary");
                btn.classList.add("btn-secondary");
                btn.disabled = true;
            });
        });
    }

    async function sendFriendRequest(friendId) {
        const currentUserId = localStorage.getItem("userId");

        // try {
        //     await API.post("/api/friendship/request", {
        //         userId: currentUserId,
        //         friendId
        //     });

        //     alert("Đã gửi lời mời kết bạn!");
        // } catch (err) {
        //     console.error("Error:", err);
        // }
    }
});
