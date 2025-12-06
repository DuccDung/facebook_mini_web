// ======================= IMPORT =======================
import { getProfile } from "../../services/profile_service.js";
import { getAllPostsApi } from "../../services/post_service.js";
import {getFriends} from "../../services/friend_service.js";
import API from "../../utils/api.js";   // axios instance bạn đang dùng



document.addEventListener("DOMContentLoaded", () => {
    loadContacts();
});

async function loadContacts() {
    const listEl = document.getElementById("contactsList");
    if (!listEl) return;

    listEl.innerHTML = "<p style='color:gray;padding:8px'>Đang tải...</p>";

    try {
        const userId = localStorage.getItem("userId");   // bạn đang dùng ở chỗ khác rồi
        if (!userId) {
            listEl.innerHTML = "<p style='color:gray;padding:8px'>Chưa đăng nhập.</p>";
            return;
        }

        const friends = await getFriends(userId);

        if (!friends || friends.length === 0) {
            listEl.innerHTML = "<p style='color:gray;padding:8px'>Chưa có bạn bè nào.</p>";
            return;
        }

        listEl.innerHTML = "";

        friends.forEach(friend => {
            const item = createContactItem(friend);
            listEl.appendChild(item);
        });

    } catch (err) {
        console.error("Lỗi load friends:", err);
        listEl.innerHTML = "<p style='color:red;padding:8px'>Không tải được danh sách bạn bè.</p>";
    }
}

function createContactItem(friend) {
    const a = document.createElement("a");
    a.href = "#";
    a.className = "contact-item";
    a.dataset.accountId = friend.accountId;

    const avatarUrl = friend.avatarUrl || "messenger-clone/assets/images/contact-1.png";
    const isOnline = !!friend.isOnline;

    a.innerHTML = `
        <div class="contact-avatar">
            <img src="${avatarUrl}" alt="">
            ${isOnline ? '<span class="online-dot"></span>' : ""}
        </div>
        <span class="contact-name">${friend.fullName || "Người dùng"}</span>
    `;

    // Nếu bạn muốn click mở chat:
    // a.addEventListener("click", (e) => {
    //     e.preventDefault();
    //     openChatWith(friend.accountId);
    // });

    return a;
}


// ======================= GLOBAL STATE =======================
let currentUserId = null;
let currentProfile = null;
let postsCache = [];          // Lưu toàn bộ posts (kèm comments) từ API
let currentPost = null;       // Post đang mở modal comment
const userId = localStorage.getItem("userId");
// ======================= INIT MAIN =======================
document.addEventListener("DOMContentLoaded", () => {
    initHomePage();
});
const sendBtn = document.getElementById('sendComment');
async function initHomePage() {
    await initProfile();
    await loadPosts();
    initCommentsModal();
}

// ======================= PROFILE =======================
async function initProfile() {
    const userNameEl = document.getElementById("sidebar-name");
    const avatarMain = document.getElementById("avatar__img-main");
    const commentAvatarLeft = document.getElementById("comment_avatar-left");
    const sidebarAvatar = document.getElementById("sidebar-avatar");
    const avatarCenterCard = document.getElementById("imgAvartar-center-card");
    const avatarCreatePost = document.getElementById("avatarCreatePost-card");

    try {
        const userId = localStorage.getItem("userId");
        if (!userId) {
            console.warn("Không tìm thấy userId trong localStorage");
            return;
        }
        currentUserId = parseInt(userId, 10);

        const profile = await getProfile(userId);
        currentProfile = profile;
        sessionStorage.setItem("profile", JSON.stringify(profile));

        userNameEl.textContent = profile?.fullName ?? "Người dùng Facebook";

        const avatarUrl =
            profile?.backgroundImgUrl ||
            "messenger-clone/assets/images/avatar-default.png";

        if (avatarMain) avatarMain.src = avatarUrl;
        if (sidebarAvatar) sidebarAvatar.src = avatarUrl;
        if (avatarCenterCard) avatarCenterCard.src = avatarUrl;
        if (avatarCreatePost) avatarCreatePost.src = avatarUrl;
        if (commentAvatarLeft) commentAvatarLeft.src = avatarUrl;
    } catch (err) {
        console.error("Lỗi khi lấy thông tin profile:", err);
    }
}

// ======================= LOAD & RENDER POSTS =======================
async function loadPosts() {
    const feed = document.querySelector(".center-feed");
    if (!feed) return;

    try {
        // Xoá các post-card tĩnh trong HTML (nếu có)
        const staticPosts = feed.querySelectorAll(".post-card");
        staticPosts.forEach(p => p.remove());

        const posts = await getAllPostsApi(userId);
        postsCache = posts || [];

        postsCache.forEach(post => {
            const card = renderPostCard(post);
            feed.appendChild(card);
        });
    } catch (error) {
        console.error("Load posts error:", error);
    }
}

// function renderPostCard(post) {
//     const postCard = document.createElement("article");
//     postCard.className = "post-card";
//     postCard.dataset.postId = post.postId;

//     const avatar =
//         post.avatar || "messenger-clone/assets/images/avatar-default.png";
//     const userName = post.userName || "Người dùng";
//     const postTime = formatTime(post.createAt);
//     const content = post.content || "";
//     const imageUrl = post.mediaUrl || null;

//     const commentCount = post.comments ? post.comments.length : 0;
//     const shareCount = post.postShares ? post.postShares.length : 0;

//     postCard.innerHTML = `
//         <div class="post-header">
//           <img src="${avatar}" alt="" class="post-avatar">
//           <div class="post-author-info">
//             <div class="post-author">${userName}</div>
//             <div class="post-time">${postTime} · 🌍</div>
//           </div>
//         </div>

//         ${content
//             ? `<div class="post-content"><p>${escapeHtml(content)}</p></div>`
//             : ""}

//         ${imageUrl
//             ? `
//           <div class="post-image">
//             <img src="${imageUrl}" alt="Post image">
//           </div>`
//             : ""
//         }

//         <div class="post-stats">
//           <div class="post-reactions">
//             <div class="reaction-icons">
//               <span class="reaction-icon like">👍</span>
//               <span class="reaction-icon love">❤️</span>
//               <span class="reaction-icon care">🤗</span>
//             </div>
//             <span class="reaction-count">0</span>
//           </div>
//           <div class="post-engagement">
//             <span>${commentCount} bình luận</span>
//             <span>${shareCount} lượt chia sẻ</span>
//           </div>
//         </div>

//         <div class="post-actions">
//           <button class="action-btn js-like-btn">
//             <span>Thích</span>
//           </button>
//           <button class="action-btn js-comment-btn">
//             <span>Bình luận</span>
//           </button>
//           <button class="action-btn js-share-btn">
//             <span>Chia sẻ</span>
//           </button>
//         </div>
//     `;

//     // Gán event cho nút Bình luận (mở modal comment)
//     const commentBtn = postCard.querySelector(".js-comment-btn");
//     if (commentBtn) {
//         commentBtn.addEventListener("click", () => {
//             openCommentsModal(post.postId);
//         });
//     }

//     // Bạn có thể gán thêm event cho Like / Share sau

//     return postCard;
// }

// ======================= COMMENTS MODAL =======================
// HTML đang dùng: #commentsModal, #closeCommentsModal, #commentsList,
// #commentInput, #sendComment
function renderPostCard(post) {
    const postCard = document.createElement("article");
    postCard.className = "post-card";
    postCard.dataset.postId = post.postId;

    const avatar =
        post.avatar || "messenger-clone/assets/images/avatar-default.png";
    const userName = post.userName || "Người dùng";
    const postTime = formatTime(post.createAt);
    const content = post.content || "";

    const commentCount = post.comments ? post.comments.length : 0;
    const shareCount = post.postShares ? post.postShares.length : 0;

    //  Like
    const likeCount = post.inforLike.likeCount ?? 0;
    const isLiked = !!post.inforLike.isLiked;

    //  Lấy list media
    const mediaItems = post.mediaItems || [];
    let mediaHtml = "";
    if (mediaItems.length > 0) {
        mediaHtml = `
          <div class="post-media">
            ${mediaItems
                .map(item => {
                    const url = item.mediaUrl;
                    const type = item.mediaType || "";
                    if (!url) return "";

                    if (type.startsWith("image")) {
                        return `
                          <div class="post-media-item">
                            <img src="${url}" alt="Post image">
                          </div>`;
                    }

                    if (type.startsWith("video")) {
                        return `
                          <div class="post-media-item">
                            <video src="${url}" controls playsinline></video>
                          </div>`;
                    }

                    return "";
                })
                .join("")}
          </div>
        `;
    }

    postCard.innerHTML = `
        <div class="post-header">
          <img src="${avatar}" alt="" class="post-avatar">
          <div class="post-author-info">
            <div class="post-author">${userName}</div>
            <div class="post-time">${postTime} · 🌍</div>
          </div>
        </div>

        ${content
            ? `<div class="post-content"><p>${escapeHtml(content)}</p></div>`
            : ""}

        ${mediaHtml}

        <div class="post-stats">
          <div class="post-reactions">
            <div class="reaction-icons">
              <span class="reaction-icon like">👍</span>
              <span class="reaction-icon love">❤️</span>
              <span class="reaction-icon care">🤗</span>
            </div>
            <span class="reaction-count">${likeCount}</span>
          </div>
          <div class="post-engagement">
            <span>${commentCount} bình luận</span>
            <span>${shareCount} lượt chia sẻ</span>
          </div>
        </div>

        <div class="post-actions">
          <button class="action-btn js-like-btn ${isLiked ? "liked" : ""}">
            <span>${isLiked ? "Đã thích" : "Thích"}</span>
          </button>
          <button class="action-btn js-comment-btn">
            <span>Bình luận</span>
          </button>
          <button class="action-btn js-share-btn">
            <span>Chia sẻ</span>
          </button>
        </div>
    `;

    // ====== EVENT: mở modal comment ======
    const commentBtn = postCard.querySelector(".js-comment-btn");
    if (commentBtn) {
        commentBtn.addEventListener("click", () => {
            openCommentsModal(post.postId);
        });
    }

    // ====== EVENT: LIKE BÀI VIẾT ======
    const likeBtn = postCard.querySelector(".js-like-btn");
    const reactionCountEl = postCard.querySelector(".reaction-count");
    if (likeBtn && reactionCountEl) {
        likeBtn.addEventListener("click", () => {
            handleTogglePostLike(post, likeBtn, reactionCountEl);
        });
    }

    return postCard;
}
async function handleTogglePostLike(post, likeBtn, reactionCountEl) {
    if (!currentUserId) return;

    const wasLiked = !!post.isLiked;
    const oldCount = post.likeCount ?? 0;
    const delta = wasLiked ? -1 : 1;
    const newLiked = !wasLiked;
    const newCount = oldCount + delta;

    // 🔹 Optimistic UI: cập nhật trước
    post.isLiked = newLiked;
    post.likeCount = newCount;
    reactionCountEl.textContent = newCount;

    likeBtn.classList.toggle("liked", newLiked);
    const textSpan = likeBtn.querySelector("span");
    if (textSpan) {
        textSpan.textContent = newLiked ? "Đã thích" : "Thích";
    }

    try {
        if (newLiked) {
            try {
               await likePost(post.postId, userId);
            } catch (error) {
                console.error("Lỗi gọi likePost:", error);
            }
        } else {
            try {
               await unlikePost(post.postId, userId);
            } catch (error) {
                console.error("Lỗi gọi unlikePost:", error);
            }
        }
    } catch (err) {
        console.error("Lỗi like/unlike bài viết:", err);

        // Rollback nếu API lỗi
        post.isLiked = wasLiked;
        post.likeCount = oldCount;
        reactionCountEl.textContent = oldCount;

        likeBtn.classList.toggle("liked", wasLiked);
        if (textSpan) {
            textSpan.textContent = wasLiked ? "Đã thích" : "Thích";
        }

        alert("Không thể cập nhật lượt thích. Vui lòng thử lại.");
    }
}

// Like bài viết
async function likePost(postId, accountId) {
    const body = {
        postId: postId,
        accountId: accountId
    };

    const res = await API.post("/api/Posts/like", body);
    return res.data;    // trong đó có thể có likeCount, message,...
}
async function unlikePost(postId, accountId) {
    const body = {
        postId: postId,
        accountId: accountId
    };

    const res = await API.delete("/api/Posts/unlike", {
        data: body
    });

    return res.data; // ví dụ { message: "unliked", likeCount: 3 }
}
function initCommentsModal() {
    const modal = document.getElementById("commentsModal");
    if (!modal) return;

    const closeBtn = document.getElementById("closeCommentsModal");
    const overlay = modal.querySelector(".modal-overlay");
    const sendBtn = document.getElementById("sendComment");
    const input = document.getElementById("commentInput");

    if (closeBtn) {
        closeBtn.addEventListener("click", () => closeCommentsModal());
    }
    if (overlay) {
        overlay.addEventListener("click", () => closeCommentsModal());
    }
    if (sendBtn && input) {
        sendBtn.addEventListener("click", () => handleSendComment());
        input.addEventListener("keypress", e => {
            if (e.key === "Enter" && !e.shiftKey) {
                e.preventDefault();
                handleSendComment();
            }
        });
    }
}

function openCommentsModal(postId) {
    const modal = document.getElementById("commentsModal");
    if (!modal) return;

    const post = postsCache.find(p => p.postId === postId);
    if (!post) return;

    currentPost = post;

    // Hiển thị modal
    modal.classList.add("active");
    document.body.style.overflow = "hidden";

    renderPostPreview(post);
    renderComments(post.comments || []);
}

function closeCommentsModal() {
    const modal = document.getElementById("commentsModal");
    if (!modal) return;
    modal.classList.remove("active");
    document.body.style.overflow = "";
    currentPost = null;
}

// ----- preview bài post trong modal -----
function renderPostPreview(post) {
    const preview = document.querySelector(".comments-post-preview");
    if (!preview) return;

    const avatar =
        post.avatar || "messenger-clone/assets/images/avatar-default.png";
    const userName = post.userName || "Người dùng";
    const timeText = formatTime(post.createAt);
    const content = post.content || "";
    const imageUrl = post.mediaUrl || null;

    let html = `
      <div class="preview-post-header">
        <img src="${avatar}" alt="" class="preview-post-avatar">
        <div class="preview-post-author-info">
          <div class="preview-post-author">${userName}</div>
          <div class="preview-post-time">${timeText}</div>
        </div>
      </div>
    `;

    if (content) {
        html += `
          <div class="preview-post-content">
            <p>${escapeHtml(content)}</p>
          </div>`;
    }

    if (imageUrl) {
        html += `
          <div class="preview-post-image">
            <img src="${imageUrl}" alt="Post image">
          </div>`;
    }

    preview.innerHTML = html;
}

// ----- render toàn bộ comments của 1 post -----
function renderComments(comments) {
    const list = document.getElementById("commentsList");
    if (!list) return;

    list.innerHTML = "";

    if (!comments || comments.length === 0) {
        list.innerHTML =
            '<div style="padding: 24px; text-align:center; color:#777;">Chưa có bình luận nào</div>';
        return;
    }

    comments.forEach(cmt => {
        const el = createCommentElement(cmt);
        list.appendChild(el);
    });
}

// comment có thể có replies lồng nhau
function createCommentElement(cmt, level = 0) {
    const wrapper = document.createElement("div");
    wrapper.className = "comment-block";
    wrapper.dataset.commentId = cmt.commentId;
    wrapper.style.marginLeft = level * 16 + "px";

    const avatar =
        cmt.avatar || "messenger-clone/assets/images/avatar-default.png";
    const userName = cmt.userName || "Người dùng";
    const timeText = formatTime(cmt.createAt);
    const content = cmt.content || "";

    wrapper.innerHTML = `
      <div class="comment-item">
        <img src="${avatar}" alt="" class="comment-avatar">
        <div class="comment-main">
          <div class="comment-bubble">
            <span class="comment-author">${userName}</span>
            <span class="comment-text">${escapeHtml(content)}</span>
          </div>

          <!-- ACTIONS -->
          <div class="comment-actions">
            <span class="comment-action comment-like">Thích</span>
            <span class="comment-action comment-reply">Phản hồi</span>
            <span class="comment-time">${timeText}</span>
          </div>

          <!-- INPUT REPLY (ẩn ban đầu) -->
          <div class="reply-box" style="display:none; margin-top:6px;">
              <input type="text" class="reply-input" placeholder="Viết phản hồi...">
              <button class="reply-send-btn">Gửi</button>
          </div>
        </div>
      </div>
    `;

    // -----------------------------
    // EVENT: Like comment
    // -----------------------------
    const likeBtn = wrapper.querySelector(".comment-like");
    likeBtn.addEventListener("click", () => {
        toggleLikeComment(likeBtn);
    });

    // -----------------------------
    // EVENT: Show reply input
    // -----------------------------
    const replyBtn = wrapper.querySelector(".comment-reply");
    const replyBox = wrapper.querySelector(".reply-box");
    const replyInput = wrapper.querySelector(".reply-input");
    const replySend = wrapper.querySelector(".reply-send-btn");

    replyBtn.addEventListener("click", () => {
        replyBox.style.display =
            replyBox.style.display === "none" ? "flex" : "none";
        replyInput.focus();
    });

    // -----------------------------
    // EVENT: Send reply comment
    // -----------------------------
    replySend.addEventListener("click", () => {
        const replyText = replyInput.value.trim();
        if (replyText === "") return;
        sendReplyComment(cmt.commentId, replyText, wrapper, level);
        replyInput.value = "";
        replyBox.style.display = "none";
    });

    // ENTER để gửi reply
    replyInput.addEventListener("keypress", e => {
        if (e.key === "Enter") {
            replySend.click();
        }
    });

    // -----------------------------
    // RENDER COMMENT CON (REPLIES)
    // -----------------------------
    if (cmt.replies && cmt.replies.length > 0) {
        cmt.replies.forEach(reply => {
            const replyEl = createCommentElement(reply, level + 1);
            wrapper.appendChild(replyEl);
        });
    }

    return wrapper;
}

function toggleLikeComment(btn) {
    if (btn.classList.contains("liked")) {
        btn.classList.remove("liked");
        btn.textContent = "Thích";
    } else {
        btn.classList.add("liked");
        btn.textContent = "Đã thích";
    }
}

async function sendReplyComment(parentCommentId, text, parentWrapper, level) {
    try {
        const body = {
            postId: currentPost.postId,
            accountId: currentUserId,
            content: text,
            parentCommentId: parentCommentId
        };
        let res;
        if (parentCommentId == null) {
            res = await API.post("/api/Posts/comment", body);
        }
        else {
            res = await API.post("/api/Posts/comment/reply", body);
        }
        const newReply = res.data;

        // Render reply ngay dưới comment cha
        const replyElement = createCommentElement(newReply, level + 1);
        parentWrapper.appendChild(replyElement);

        // Cập nhật cache
        const parentComment = findCommentById(currentPost.comments, parentCommentId);
        if (parentComment) {
            parentComment.replies = parentComment.replies || [];
            parentComment.replies.push(newReply);
        }
    } catch (err) {
        console.error("Lỗi gửi comment reply:", err);
        alert("Không gửi được phản hồi");
    }
}

// tìm comment cha trong mảng comments lồng nhau
function findCommentById(comments, id) {
    for (const c of comments) {
        if (c.commentId === id) return c;
        if (c.replies && c.replies.length > 0) {
            const found = findCommentById(c.replies, id);
            if (found) return found;
        }
    }
    return null;
}

// ----- gửi comment mới (comment cha) -----
async function handleSendComment() {
    if (!currentPost || !currentUserId) return;

    const input = document.getElementById("commentInput");
    if (!input) return;

    const text = input.value.trim();
    if (!text) return;

    // ====== 1) TẠO COMMENT TẠM TRONG UI ======
    const tempId = "temp-" + Date.now();      // ID tạm để UI render
    const temp = {
        commentId: tempId,
        accountId: currentUserId,
        userName: currentProfile?.fullName || "Bạn",
        avatar: currentProfile?.backgroundImgUrl || "messenger-clone/assets/images/avatar-default.png",
        content: text,
        createAt: new Date().toISOString(),
        parentCommentId: null,
        replies: []
    };
    // add vào cache
    currentPost.comments = currentPost.comments || [];
    currentPost.comments.push(temp);



    // render lại list comment
    renderComments(currentPost.comments);

    // clear input
    input.value = "";

    // ====== 2) GỌI API BẤT ĐỒNG BỘ (không await) ======
    API.post("/api/Posts/comment", {
        postId: currentPost.postId,
        accountId: currentUserId,
        content: text,
        parentCommentId: null
    })
        .then(res => {
            const realComment = res.data.comment;

            // tìm comment temp trong cache
            const idx = currentPost.comments.findIndex(c => c.commentId === tempId);
            if (idx !== -1) {
                // thay temp comment bằng comment thật từ server
                currentPost.comments[idx] = realComment;
                renderComments(currentPost.comments);
            }
        })
        .catch(err => {
            console.error("API comment lỗi:", err);

            // xử lý UI khi lỗi
            const tempEl = document.querySelector(`[data-comment-id="${tempId}"]`);
            if (tempEl) {
                tempEl.style.opacity = "0.5";
                tempEl.style.pointerEvents = "none";
                tempEl.innerHTML += `
                <div style="color:red; font-size:12px;">Không gửi được bình luận</div>
            `;
            }
        });
}


// ======================= HELPERS =======================
function formatTime(dateStr) {
    if (!dateStr) return "";
    const date = new Date(dateStr);
    const now = new Date();
    const diffMs = now - date;

    const diffMinutes = Math.floor(diffMs / 60000);
    const diffHours = Math.floor(diffMinutes / 60);

    if (diffMinutes < 1) return "Vừa xong";
    if (diffMinutes < 60) return `${diffMinutes} phút`;
    if (diffHours < 24) return `${diffHours} giờ`;

    return date.toLocaleString("vi-VN");
}

function escapeHtml(text) {
    const div = document.createElement("div");
    div.innerText = text ?? "";
    return div.innerHTML;
}


//bật/tắt dropdown khi bấm avatar
document.addEventListener("DOMContentLoaded", () => {
    const avatarTrigger = document.getElementById("avatarTrigger");
    const avatarDropdown = document.getElementById("avatarDropdown");

    avatarTrigger.addEventListener("click", (e) => {
        e.stopPropagation();
        avatarDropdown.classList.toggle("hidden");
    });

    // Click outside → đóng dropdown
    document.addEventListener("click", () => {
        avatarDropdown.classList.add("hidden");
    });
});
