document.addEventListener("DOMContentLoaded", function () {
    const btn = document.getElementById("notiBtn");
    const dropdown = document.getElementById("notiDropdown");
    // Nút 3 chấm trong header
    const moreBtn = document.getElementById("notiHeaderMoreBtn");
    const moreMenu = document.getElementById("notiHeaderMoreMenu");

    if (!btn || !dropdown) return;

    btn.addEventListener("click", function (e) {
        e.stopPropagation();
        dropdown.classList.toggle("show");
    });

    document.addEventListener("click", function (e) {
        if (!dropdown.contains(e.target) && !btn.contains(e.target)) {
            dropdown.classList.remove("show");
        }
    });

    if (moreBtn && moreMenu) {
        moreBtn.addEventListener("click", (e) => {
            e.stopPropagation();
            moreMenu.classList.toggle("show");
        });
    }
    // Ẩn cả dropdown & menu nhỏ khi click ra ngoài
    document.addEventListener("click", function () {
        dropdown?.classList.remove("show");
        moreMenu?.classList.remove("show");
    });
});
document.addEventListener("DOMContentLoaded", function () {

    const olderNoti = document.getElementById("olderNoti");
    const btnMore = document.getElementById("showMoreNoti");

    if (btnMore && olderNoti) {
        btnMore.addEventListener("click", function (e) {
            e.stopPropagation();              // NGĂN dropdown đóng lại
            olderNoti.classList.remove("d-none"); 
            btnMore.style.display = "none";
        });
    }
});
