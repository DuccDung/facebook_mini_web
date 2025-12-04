

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
    const memberInputs = document.querySelectorAll(".contact-item input[name='member']");


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
        if (count >= 2) {
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

    memberInputs.forEach(input => {
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

    updateCreateButton();


    /* ==========================
       SEARCH
    =========================== */

    function removeVietnamese(str) {
        return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
    }

    function runSearch() {
        const keyword = searchInput.value.trim().toLowerCase();
        const keywordNoAccent = removeVietnamese(keyword);

        const items = document.querySelectorAll(".contact-item");
        let shown = 0;

        items.forEach(item => {
            const name = item.querySelector("span").textContent.toLowerCase();
            const nameNoAccent = removeVietnamese(name);

            const email = removeVietnamese(item.querySelector("input").dataset.email || "");

            const match =
                name.includes(keyword) ||
                nameNoAccent.includes(keywordNoAccent) ||
                email.includes(keywordNoAccent);

            if (match) {
                item.style.display = "flex";
                shown++;
            } else {
                item.style.display = "none";
            }
        });

        noResult.style.display = shown === 0 ? "block" : "none";
    }

    searchInput.addEventListener("input", runSearch);


    /* ==========================
       CREATE GROUP: chưa làm đc
    =========================== */
    
    const showChat = () => app.classList.remove('show-list');

    createBtn.addEventListener("click", () => {
        const checked = [...document.querySelectorAll(".contact-item input:checked")];

        if (checked.length < 2) return;

        const members = checked.map(c => ({
            id: c.value,
            name: c.dataset.name,
            avatar: c.dataset.avatar
        }));

        let groupName = document.querySelector(".name-input").value.trim();
        if (!groupName) {
            groupName = members.map(m => m.name).join(", ");
        }

        const newThread = {
            id: Date.now(),
            name: groupName,
            avatar: members[0].avatar,
            snippet: "Bạn đã tạo nhóm",
            time: "vừa xong",
            active: true,
            is_group: true,
            messages: [],
            members,
        };

        threads.unshift(newThread);
        renderThreads(threads);
        setActiveThread(newThread.id);

        // ⚡ tự động chuyển sang giao diện chat (đặc biệt quan trọng cho mobile)
        if (typeof showChat === "function") {
            showChat();
        }

        modal.classList.add("hidden");
    });

});
