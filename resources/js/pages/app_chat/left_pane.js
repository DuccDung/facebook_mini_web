const searchInput = document.getElementById("threadSearch");
const backIcon = document.getElementById("backIcon");

const threadListPane = document.getElementById("threadList");
const tabs = document.querySelector(".tabs");
const contactPane = document.getElementById("contactListPane");

// Khi bấm vào ô tìm kiếm -> hiện danh bạ
searchInput.addEventListener("focus", () => {
    backIcon.classList.remove("hidden");   // hiện ←

    threadListPane.classList.add("hidden");
    tabs.classList.add("hidden");
    contactPane.classList.remove("hidden");
});

// Khi nhấn nút ← -> quay lại giao diện thread list
backIcon.addEventListener("click", () => {
    backIcon.classList.add("hidden");
    searchInput.value = "";                // reset input

    contactPane.classList.add("hidden");
    threadListPane.classList.remove("hidden");
    tabs.classList.remove("hidden");
});
