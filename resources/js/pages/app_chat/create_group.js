import { at } from "lodash";
import { getFriends, findFriend, createGroupChat } from "../../services/friend_service.js";

document.addEventListener("DOMContentLoaded", () => {

    /* ==========================
       DOM ELEMENTS
    =========================== */

    const openBtn = document.getElementById("newMsgBtn1");
    const modal = document.getElementById("groupModal");
    const closeBtn = document.getElementById("closeGroupModal");
    const selectedList = document.getElementById("selectedList");
    const searchInput = document.querySelector(".search-input");
    const noResult = document.getElementById("noResult");
    const createBtn = document.querySelector(".create-btn");
    const listContainer = document.getElementById("popup__contact-friends");
    const memberInputs = document.querySelectorAll(".contact-item input[name='member']");
    const inputSearchFriend = document.getElementById('popup__search-friend');
    const userId = localStorage.getItem("userId");
    const nameGroupChat = document.getElementById('popup_name-inp');

    createBtn.addEventListener('click', (e) => {
        const count = document.querySelectorAll(".contact-item input:checked").length;
        if (count < 1) return;
        const selectedIds = [...document.querySelectorAll(".contact-item input:checked")]
            .map(input => input.value);
        if (count == 1) {
            const data = createGroupChat(userId, selectedIds, false, nameGroupChat.value, new Date());
            window.location.reload();

        }
        else if (count >= 2) {
            const data = createGroupChat(userId, selectedIds, true, nameGroupChat.value, new Date());
            window.location.reload();
        }
    });

    inputSearchFriend.addEventListener('input', (e) => {
        findFriends(userId, e.data);
        if (inputSearchFriend.value == "") {
            loadFriends();
        }
    });

    async function findFriends(userId, email) {
        try {
            const friends = await findFriend(userId, email);
            listContainer.innerHTML = `
            <div class="contact-title">Danh sách tìm kiếm</div>
        `;

            friends.data.forEach(friend => {

                const item = document.createElement("label");
                item.classList.add("contact-item");

                item.innerHTML = `
                <input type="checkbox" name="member"
                    value="${friend.userId}"
                    data-name="${friend.userName}"
                    data-email="${friend.email}"
                    data-avatar="${friend.avatarUrl || "/assets/app_chat/images/user-default.png"}">

                <div class="avatar-wrapper">
                    <img src="${friend.avatarUrl || "/assets/app_chat/images/user-default.png"}">
                    <span class="online-dot"></span>
                </div>

                <span>${friend.userName}</span>
            `;

                listContainer.appendChild(item);
            });
            attachMemberEvents();
        } catch (e) {
            console.log("bug call api in file create_group.js" + e);
        }
    }
    async function loadFriends() {
        try {
            const friendsData = await getFriends(userId);
            listContainer.innerHTML = `
            <div class="contact-title">Danh sách bạn bè</div>
        `;

            friendsData.info.forEach(friend => {

                const item = document.createElement("label");
                item.classList.add("contact-item");

                item.innerHTML = `
                <input type="checkbox" name="member"
                    value="${friend.userId}"
                    data-name="${friend.userName}"
                    data-avatar="${friend.avatarUrl || "/assets/app_chat/images/user-default.png"}">

                <div class="avatar-wrapper">
                    <img src="${friend.avatarUrl || "/assets/app_chat/images/user-default.png"}">
                    <span class="online-dot"></span>
                </div>

                <span>${friend.userName}</span>
            `;

                listContainer.appendChild(item);
            });
            attachMemberEvents();
        }
        catch (error) {
            console.error("Error:", error);
        }
    }
    loadFriends();


    function attachMemberEvents() {
        const inputs = document.querySelectorAll(".contact-item input[name='member']");
        updateCreateButton();
        inputs.forEach(input => {
            input.addEventListener("change", function () {
                const id = this.value;
                const name = this.dataset.name;
                const avatar = this.dataset.avatar;

                if (this.checked) {
                    addSelectedUser(id, name, avatar, this);
                } else {
                    removeSelectedUser(id);
                }
                updateCreateButton();
            });
        });
    }


    /* ==========================
       RESET MODAL
    =========================== */
    function resetModal() {
        selectedList.innerHTML = "";
        document.querySelectorAll(".contact-item input").forEach(i => (i.checked = false));

        document.querySelector(".name-input").value = "";
        if (searchInput) searchInput.value = "";

        document.querySelectorAll(".contact-item").forEach(item => {
            item.style.display = "flex";
        });

        if (noResult) noResult.style.display = "none";

        createBtn.disabled = true;
        createBtn.style.opacity = "0.6";
        createBtn.style.cursor = "not-allowed";
    }


    /* ==========================
       OPEN / CLOSE MODAL
    =========================== */

    openBtn.addEventListener("click", () => {
        resetModal();
        modal.classList.remove("hidden");
    });

    closeBtn.addEventListener("click", () => {
        modal.classList.add("hidden");
    });

    modal.querySelector(".modal-overlay").addEventListener("click", () => {
        modal.classList.add("hidden");
    });


    /* ==========================
       UPDATE CREATE BUTTON
    =========================== */
    function updateCreateButton() {
        const count = document.querySelectorAll(".contact-item input:checked").length;
        if (count >= 1) {
            createBtn.disabled = false;
            createBtn.style.opacity = "1";
            createBtn.style.cursor = "pointer";
        } else {
            createBtn.disabled = true;
            createBtn.style.opacity = "0.6";
            createBtn.style.cursor = "not-allowed";
        }
    }


    /* ==========================
       SELECT USERS
    =========================== */

    function addSelectedUser(id, name, avatar, inputEl) {
        const div = document.createElement("div");
        div.classList.add("selected-item");
        div.dataset.id = id;

        div.innerHTML = `
            <img src="${avatar}">
            <button class="remove-selected">×</button>
            <div>${name}</div>
        `;

        selectedList.appendChild(div);

        div.querySelector(".remove-selected").addEventListener("click", () => {
            inputEl.checked = false;
            div.remove();
            updateCreateButton();
        });
    }

    function removeSelectedUser(id) {
        const item = selectedList.querySelector(`[data-id="${id}"]`);
        if (item) item.remove();
    }

    updateCreateButton();


    /* ==========================
       SEARCH
    =========================== */

    function removeVietnamese(str) {
        return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
    }

    /* ==========================
       CREATE GROUP: chưa làm đc
    =========================== */

    const showChat = () => app.classList.remove('show-list');
});
