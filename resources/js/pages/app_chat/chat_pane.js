document.addEventListener("DOMContentLoaded", () => {

    const newMsgBtn       = document.getElementById("newMsgBtn");
    const chatHeader      = document.querySelector(".chat-header");
    const toBar           = document.getElementById("toBar");
    const messageScroller = document.getElementById("messageScroller");
    const composer        = document.querySelector(".composer");

    const toSearch        = document.getElementById("toSearch");
    const toDropdown      = document.getElementById("toDropdown");
    const toContactList   = document.getElementById("toContactList");
    const selectedList    = document.getElementById("selectedList");

    let selectedUsers = []; // nhiều người được chọn


    // ========== 1. Nhấn nút tạo tin nhắn mới ==========
    newMsgBtn.addEventListener("click", () => {
        chatHeader.classList.add("hidden");
        messageScroller.classList.add("hidden");
        composer.classList.add("hidden");

        toBar.hidden = false;
        toSearch.value = "";
        toSearch.focus();
    });


    // ========== 2. Fake danh bạ + tự tạo ID ==========
    const contacts = [
        { id: 1, name: "Tú Đỗ", avatar: "https://i.pravatar.cc/51" },
        { id: 2, name: "Anh Thu", avatar: "https://i.pravatar.cc/52" },
        { id: 3, name: "Nguyen Anh Thu", avatar: "https://i.pravatar.cc/53" },
        { id: 4, name: "Nguyễn Văn Đạt", avatar: "https://i.pravatar.cc/54" },
        { id: 5, name: "Lê Tường", avatar: "https://i.pravatar.cc/55" },
        { id: 6, name: "Hương Giang", avatar: "https://i.pravatar.cc/56" },
    ];



    // ========== 3. Render dropdown ==========
    function renderContacts(list) {
        toContactList.innerHTML = "";

        list.forEach(c => {
            const div = document.createElement("div");
            div.className = "contact-item";
            div.innerHTML = `
                <img src="${c.avatar}">
                <span>${c.name}</span>
            `;

            // CLICK CHỌN 1 NGƯỜI
            div.addEventListener("click", (e) => {
                e.stopPropagation();    // ❗ GIỮ dropdown không bị tắt
                addSelectedUser(c);
                toSearch.value = "";
                renderContacts(contacts); // reset list
            });

            toContactList.appendChild(div);
        });
    }
    renderContacts(contacts);



    // ========== 4. Focus input → mở dropdown ==========
    toSearch.addEventListener("focus", () => {
        toDropdown.classList.remove("hidden");
    });



    // ========== 5. Nhập chữ → lọc ==========
    toSearch.addEventListener("input", () => {
        const keyword = toSearch.value.toLowerCase();
        const filtered = contacts.filter(
            c => c.name.toLowerCase().includes(keyword) &&
                 !selectedUsers.some(sel => sel.id === c.id)
        );
        renderContacts(filtered);
        toDropdown.classList.remove("hidden");
    });


    // ========== 6. Click ngoài → đóng ==========
    document.addEventListener("click", (e) => {
        if (!e.target.closest("#toInput")) {
            toDropdown.classList.add("hidden");
        }
    });



    // ========== 7. Thêm user vào danh sách đã chọn ==========
    function addSelectedUser(user) {
        // Không cho chọn trùng
        if (selectedUsers.some(u => u.id === user.id)) return;

        selectedUsers.push(user);
        renderSelectedUsers();
    
    }



    // ========== 8. Render các badge ==========
    function renderSelectedUsers() {
        selectedList.innerHTML = "";

        selectedUsers.forEach(user => {
            const div = document.createElement("div");
            div.className = "selected-item";
            div.innerHTML = `
                ${user.name}
                <span class="remove" data-id="${user.id}">×</span>
            `;
            selectedList.appendChild(div);
        });

        // ========== HIỆN / ẨN COMPOSER ==========
        if (selectedUsers.length >= 1) {
            composer.classList.remove("hidden");    // hiện footer
        } else {
            composer.classList.add("hidden");       // ẩn footer
        }
    }



    // ========== 9. Xoá người đã chọn ==========
    selectedList.addEventListener("click", (e) => {
        if (e.target.classList.contains("remove")) {
            const id = parseInt(e.target.dataset.id);
            selectedUsers = selectedUsers.filter(u => u.id !== id);
            renderSelectedUsers();
        }
    });

});
