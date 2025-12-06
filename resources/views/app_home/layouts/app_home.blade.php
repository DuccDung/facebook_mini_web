<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Facebook - Trang chủ</title>
    <link rel="stylesheet" href="{{ mix('resources/css/pages/app_chat/style.css') }}" />
    <link rel="stylesheet" href="{{ mix('resources/css/pages/app_home/home.css') }}" />
    <link rel="stylesheet" href="{{ mix('resources/css/pages/notification.css') }}" />
    <link rel="icon" href="{{ mix('resources/assets/app_chat/icons/facebook.svg') }}">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite('resources/js/pages/app_home/setup_home.js')
    @vite('resources/css/pages/app_chat/top_bar.css')
    @vite('resources/js/pages/app_home/notification.js')
</head>

<body>
    <!-- Top Navigation Bar -->
    @include('app_chat.partials.top_bar')

    <!-- Main Content -->
    <div class="main-container">
        <!-- Left Sidebar -->
        <aside class="left-sidebar">
            <div class="sidebar-menu">
                <a href="#" class="menu-item">
                    <img id="sidebar-avatar" src="messenger-clone/assets/images/avatar-default.png" alt=""
                        class="sidebar-avatar">
                    <span id="sidebar-name"></span>
                </a>
                <a href="{{ route('friends') }}" class="menu-item">
                    <div class="menu-icon-wrapper">
                        <i class="ri-user-3-fill menu-icon" aria-hidden="true"></i>
                    </div>
                    <span>Bạn bè</span>
                </a>

                <a href="#" class="menu-item">
                    <div class="menu-icon-wrapper">
                        <i class="ri-team-fill menu-icon" aria-hidden="true"></i>
                    </div>
                    <span>Nhóm</span>
                </a>

                <a href="#" class="menu-item">
                    <div class="menu-icon-wrapper">
                        <i class="ri-store-2-fill menu-icon" aria-hidden="true"></i>
                    </div>
                    <span>Marketplace</span>
                </a>

                <a href="#" class="menu-item">
                    <div class="menu-icon-wrapper">
                        <i class="ri-tv-2-fill menu-icon" aria-hidden="true"></i>
                    </div>
                    <span>Watch</span>
                </a>

                <a href="#" class="menu-item">
                    <div class="menu-icon-wrapper">
                        <i class="ri-calendar-event-fill menu-icon" aria-hidden="true"></i>
                    </div>
                    <span>Sự kiện</span>
                </a>

                <a href="#" class="menu-item">
                    <div class="menu-icon-wrapper">
                        <i class="ri-time-line menu-icon" aria-hidden="true"></i>
                    </div>
                    <span>Kỷ niệm</span>
                </a>

                <a href="#" class="menu-item">
                    <div class="menu-icon-wrapper">
                        <i class="ri-bookmark-3-fill menu-icon" aria-hidden="true"></i>
                    </div>
                    <span>Đã lưu</span>
                </a>

                <button class="menu-item see-more">
                    <div class="see-more-icon">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 14l-1-1 4-4-4-4 1-1 5 5z" />
                        </svg>
                    </div>
                    <span>Xem thêm</span>
                </button>
            </div>

            <div class="sidebar-footer">
                <a href="#">Quyền riêng tư</a> ·
                <a href="#">Điều khoản</a> ·
                <a href="#">Quảng cáo</a> ·
                <a href="#">Lựa chọn quảng cáo</a> ·
                <a href="#">Cookie</a> ·
                <a href="#">Xem thêm</a> ·
                <span>Meta © 2025</span>
            </div>
        </aside>

        <!-- Center Feed -->
        <main class="center-feed">
            <!-- Stories Section -->
            {{-- <div class="stories-container">
                <div class="story create-story">
                    <img src="messenger-clone/assets/images/avatar-default.png" alt="" class="story-bg">
                    <div class="create-story-overlay">
                        <div class="create-story-icon">+</div>
                        <span class="create-story-text">Tạo tin</span>
                    </div>
                </div>

                <div class="story">
                    <img src="messenger-clone/assets/images/contact-1.png" alt="" class="story-bg">
                    <div class="story-avatar">
                        <img src="messenger-clone/assets/images/contact-1.png" alt="">
                    </div>
                    <div class="story-name">Lê Ngọc</div>
                </div>

                <div class="story">
                    <img src="messenger-clone/assets/images/contact-2.png" alt="" class="story-bg">
                    <div class="story-avatar">
                        <img src="messenger-clone/assets/images/contact-2.png" alt="">
                    </div>
                    <div class="story-name">Trần Mai</div>
                </div>

                <div class="story">
                    <img src="messenger-clone/assets/images/contact-3.png" alt="" class="story-bg">
                    <div class="story-avatar">
                        <img src="messenger-clone/assets/images/contact-3.png" alt="">
                    </div>
                    <div class="story-name">Phạm Thảo</div>
                </div>

                <div class="story">
                    <img src="messenger-clone/assets/images/contact-4.png" alt="" class="story-bg">
                    <div class="story-avatar">
                        <img src="messenger-clone/assets/images/contact-4.png" alt="">
                    </div>
                    <div class="story-name">Ngô Hải</div>
                </div>

                <div class="story">
                    <img src="messenger-clone/assets/images/contact-5.png" alt="" class="story-bg">
                    <div class="story-avatar">
                        <img src="messenger-clone/assets/images/contact-5.png" alt="">
                    </div>
                    <div class="story-name">Đỗ Linh</div>
                </div>
            </div> --}}

            <!-- Create Post Card -->
            <div class="create-post-card">
                <div class="create-post-header">
                    <img id="imgAvartar-center-card" src="messenger-clone/assets/images/avatar-default.png"
                        alt="" class="avatar-img">
                    <input type="text" placeholder="Bạn đang nghĩ gì?" class="create-post-input" readonly>
                </div>
                <div class="create-post-actions">
                    <button class="post-action">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke="#f02849" stroke-width="2" />
                            <circle cx="12" cy="12" r="5" fill="#f02849" />
                        </svg>
                        <span style="color: #f02849;">Video trực tiếp</span>
                    </button>
                    <button class="post-action">
                        <span style="color: #45bd62;">Ảnh/video</span>
                    </button>
                    <button class="post-action">
                        <span style="color: #f7b928;">Cảm xúc/Hoạt động</span>
                    </button>
                </div>
            </div>

            <!-- News Feed Posts -->

            <article class="post-card">
                <div class="post-header">
                    <img src="messenger-clone/assets/images/contact-3.png" alt="" class="post-avatar">
                    <div class="post-author-info">
                        <div class="post-author">Phạm Thảo</div>
                        <div class="post-time">6 giờ · 🌍</div>
                    </div>
                </div>
                <div class="post-content">
                    <p>Chúc mọi người một ngày làm việc hiệu quả! 💪✨</p>
                </div>
                <div class="post-image">
                    <img src="messenger-clone/assets/images/contact-3.png" alt="Post image">
                </div>
                <div class="post-stats">
                    <div class="post-reactions">
                        <div class="reaction-icons">
                            <span class="reaction-icon like">👍</span>
                            <span class="reaction-icon love">❤️</span>
                            <span class="reaction-icon care">🤗</span>
                        </div>
                        <span class="reaction-count">156</span>
                    </div>
                    <div class="post-engagement">
                        <span>24 bình luận</span>
                        <span>8 lượt chia sẻ</span>
                    </div>
                </div>
                <div class="post-actions">
                    <button class="action-btn">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path
                                d="M14 9V5a3 3 0 00-3-3l-4 9v11h11.28a2 2 0 002-1.7l1.38-9a2 2 0 00-2-2.3zM7 22H4a2 2 0 01-2-2v-7a2 2 0 012-2h3" />
                        </svg>
                        <span>Thích</span>
                    </button>
                    <button class="action-btn">
                        <img src="messenger-clone/assets/icons/send.svg" alt="">
                        <span>Bình luận</span>
                    </button>
                    <button class="action-btn">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M4 12v8a2 2 0 002 2h12a2 2 0 002-2v-8" />
                            <polyline points="16 6 12 2 8 6" />
                            <line x1="12" y1="2" x2="12" y2="15" />
                        </svg>
                        <span>Chia sẻ</span>
                    </button>
                </div>
            </article>

        </main>

        <!-- Right Sidebar -->
        <aside class="right-sidebar">
            {{-- <div class="sidebar-divider"></div> --}}

            {{-- <div class="sidebar-section">
                <div class="section-header">
                    <h3>Sinh nhật</h3>
                </div>
                <div class="birthday-item">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="#1877f2">
                        <path
                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" />
                        <path d="M12.5 7H11v6l5.25 3.15.75-1.23-4.5-2.67z" />
                    </svg>
                    <span>Hôm nay là sinh nhật của <strong>Ngô Hải</strong> và <strong>2 người khác</strong></span>
                </div>
            </div> --}}

            <div class="sidebar-divider"></div>

            <div class="sidebar-section">
                <div class="section-header">
                    <h3>Người liên hệ</h3>
                </div>
                <div class="contacts-list">
                    <a href="#" class="contact-item">
                        <div class="contact-avatar">
                            <img src="messenger-clone/assets/images/contact-1.png" alt="">
                            <span class="online-dot"></span>
                        </div>
                        <span class="contact-name">Lê Ngọc</span>
                    </a>
                    <a href="#" class="contact-item">
                        <div class="contact-avatar">
                            <img src="messenger-clone/assets/images/contact-2.png" alt="">
                            <span class="online-dot"></span>
                        </div>
                        <span class="contact-name">Trần Mai</span>
                    </a>
                </div>
            </div>
        </aside>
    </div>

    <!-- ========== STORY VIEWER MODAL ========== -->
    <div id="storyViewer" class="story-viewer">
        <button class="story-viewer-close" id="closeStoryViewer">✖</button>
        <button class="story-nav-btn story-prev" id="prevStory">‹</button>
        <button class="story-nav-btn story-next" id="nextStory">›</button>

        <div class="story-viewer-content">
            <div class="story-viewer-header">
                <div class="story-viewer-user">
                    <img src="" alt="" class="story-viewer-avatar" id="storyViewerAvatar">
                    <div class="story-viewer-info">
                        <div class="story-viewer-name" id="storyViewerName"></div>
                        <div class="story-viewer-time" id="storyViewerTime"></div>
                    </div>
                </div>
                <div class="story-progress-bars" id="storyProgressBars"></div>
            </div>

            <div class="story-viewer-image">
                <img src="" alt="" id="storyViewerImage">
            </div>

            <div class="story-viewer-footer">
                <input type="text" placeholder="Trả lời..." class="story-reply-input">
                <button class="story-action-btn">❤️</button>
                <button class="story-action-btn">📤</button>
            </div>
        </div>
    </div>

    <!-- ========== REACTIONS PICKER ========== -->
    <div id="reactionsPicker" class="reactions-picker">
        <button class="reaction-btn" data-reaction="like">
            <span class="reaction-emoji">👍</span>
            <span class="reaction-label">Thích</span>
        </button>
        <button class="reaction-btn" data-reaction="love">
            <span class="reaction-emoji">❤️</span>
            <span class="reaction-label">Yêu thích</span>
        </button>
        <button class="reaction-btn" data-reaction="haha">
            <span class="reaction-emoji">😆</span>
            <span class="reaction-label">Haha</span>
        </button>
        <button class="reaction-btn" data-reaction="wow">
            <span class="reaction-emoji">😮</span>
            <span class="reaction-label">Wow</span>
        </button>
        <button class="reaction-btn" data-reaction="sad">
            <span class="reaction-emoji">😢</span>
            <span class="reaction-label">Buồn</span>
        </button>
        <button class="reaction-btn" data-reaction="angry">
            <span class="reaction-emoji">😠</span>
            <span class="reaction-label">Phẫn nộ</span>
        </button>
    </div>

    <!-- ========== REACTIONS LIST MODAL ========== -->
    <div id="reactionsModal" class="reactions-modal">
        <div class="modal-overlay"></div>
        <div class="modal-content reactions-modal-content">
            <div class="modal-header">
                <h3>Cảm xúc</h3>
                <button class="modal-close" id="closeReactionsModal">✖</button>
            </div>
            <div class="reactions-tabs">
                <button class="reactions-tab active" data-tab="all">
                    <span class="tab-label">Tất cả</span>
                    <span class="tab-count">324</span>
                </button>
                <button class="reactions-tab" data-tab="like">
                    <span class="reaction-emoji-small">👍</span>
                    <span class="tab-count">156</span>
                </button>
                <button class="reactions-tab" data-tab="love">
                    <span class="reaction-emoji-small">❤️</span>
                    <span class="tab-count">98</span>
                </button>
                <button class="reactions-tab" data-tab="care">
                    <span class="reaction-emoji-small">🤗</span>
                    <span class="tab-count">45</span>
                </button>
                <button class="reactions-tab" data-tab="haha">
                    <span class="reaction-emoji-small">😆</span>
                    <span class="tab-count">25</span>
                </button>
            </div>
            <div class="reactions-list" id="reactionsList">
                <!-- Populated by JS -->
            </div>
        </div>
    </div>

    <!-- ========== COMMENTS MODAL ========== -->
    <div id="commentsModal" class="comments-modal">
        <div class="modal-overlay"></div>
        <div class="modal-content comments-modal-content">
            <div class="modal-header">
                <h3>Bình luận</h3>
                <button class="modal-close" id="closeCommentsModal">✖</button>
            </div>

            <div class="comments-scrollable-area">
                <div class="comments-post-preview">
                    <div class="preview-post-header">
                        <img src="messenger-clone/assets/images/contact-1.png" alt=""
                            class="preview-post-avatar">
                        <div class="preview-post-author-info">
                            <div class="preview-post-author">Lê Ngọc</div>
                            <div class="preview-post-time">2 giờ · <img src="messenger-clone/assets/icons/users.svg"
                                    alt="" style="width: 12px; opacity: 0.6;"></div>
                        </div>
                    </div>
                    <div class="preview-post-content">
                        <p>Hôm nay thật tuyệt vời! 🌟 Cảm ơn mọi người đã luôn ủng hộ mình ❤️</p>
                    </div>
                    <div class="preview-post-image">
                        <img src="messenger-clone/assets/images/contact-1.png" alt="Post image">
                    </div>
                </div>

                <div class="comments-list" id="commentsList">
                    <!-- Comments populated by JS -->
                </div>
            </div>

            <div class="comment-input-wrapper">
                <img src="messenger-clone/assets/images/avatar-default.png" alt="" id="comment_avatar-left"
                    class="comment-avatar">
                <div class="comment-input-container">
                    <div id="commentImagePreview" class="comment-image-preview"></div>
                    <textarea placeholder="Viết bình luận..." class="comment-input" id="commentInput" rows="1"></textarea>
                    <div class="comment-actions-btns">
                        <button class="comment-action-btn" title="Biểu tượng cảm xúc">😊</button>
                        <button class="comment-action-btn" id="commentPhotoBtn" title="Đính kèm ảnh">📷</button>
                        <button class="comment-action-btn" title="GIF">GIF</button>
                    </div>
                </div>
                <button class="comment-send-btn" id="sendComment">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M2 21l21-9L2 3v7l15 2-15 2v7z" />
                    </svg>
                </button>
                <input type="file" id="commentImageInput" accept="image/*" style="display: none;">
            </div>
        </div>
    </div>
    <!-- ================= COMMENTS MODAL ================= -->


    <!-- ========== CREATE POST MODAL ========== -->
    <div id="createPostModal" class="create-post-modal">
        <div class="modal-overlay"></div>
        <div class="modal-content create-post-modal-content">
            <div class="modal-header">
                <h3>Tạo bài viết</h3>
                <button class="modal-close" id="closeCreatePostModal">✖</button>
            </div>

            <div class="create-post-user">
                <img src="" alt="" class="create-post-avatar" id="avatarCreatePost-card">
                <div>
                    <div class="create-post-username">Tên của bạn</div>
                    <select class="create-post-privacy">
                        <option>🌍 Công khai</option>
                        <option>👥 Bạn bè</option>
                        <option>🔒 Chỉ mình tôi</option>
                    </select>
                </div>
            </div>

            <div class="create-post-textarea-wrapper">
                <textarea id="createPostTextarea" class="create-post-textarea" placeholder="Bạn đang nghĩ gì?"></textarea>
                <div class="create-post-preview" id="createPostPreview"></div>
            </div>

            <div class="create-post-options">
                <div class="create-post-option-label">Thêm vào bài viết của bạn</div>
                <div class="create-post-option-btns">
                    <button class="create-post-option-btn" data-option="photo" title="Ảnh/video">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="#45bd62">
                            <path
                                d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z" />
                        </svg>
                    </button>
                    <button class="create-post-option-btn" data-option="tag" title="Gắn thẻ người khác">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="#1877f2">
                            <path
                                d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                        </svg>
                    </button>
                    <button class="create-post-option-btn" data-option="feeling" title="Cảm xúc/hoạt động">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="#f7b928">
                            <path
                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5S16.33 8 15.5 8 14 8.67 14 9.5s.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11zm3.5 6.5c2.33 0 4.31-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5z" />
                        </svg>
                    </button>
                    <button class="create-post-option-btn" data-option="location" title="Vị trí">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="#f5533d">
                            <path
                                d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                        </svg>
                    </button>
                </div>
            </div>

            <input type="file" id="createPostFileInput" accept="image/*,video/*" multiple style="display: none;">

            <button class="create-post-submit-btn" id="submitPost">Đăng</button>
        </div>
    </div>

    <!-- ========== SHARE POST MODAL ========== -->
    <div id="sharePostModal" class="share-post-modal">
        <div class="modal-overlay"></div>
        <div class="modal-content share-post-modal-content">
            <div class="modal-header">
                <h3>Chia sẻ bài viết</h3>
                <button class="modal-close" id="closeSharePostModal">✖</button>
            </div>

            <div class="share-options">
                <button class="share-option">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M18 16.08c-.76 0-1.44.3-1.96.77L8.91 12.7c.05-.23.09-.46.09-.7s-.04-.47-.09-.7l7.05-4.11c.54.5 1.25.81 2.04.81 1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3c0 .24.04.47.09.7L8.04 9.81C7.5 9.31 6.79 9 6 9c-1.66 0-3 1.34-3 3s1.34 3 3 3c.79 0 1.5-.31 2.04-.81l7.12 4.16c-.05.21-.08.43-.08.65 0 1.61 1.31 2.92 2.92 2.92 1.61 0 2.92-1.31 2.92-2.92s-1.31-2.92-2.92-2.92z" />
                    </svg>
                    <div>
                        <div class="share-option-title">Chia sẻ ngay (Công khai)</div>
                        <div class="share-option-desc">Chia sẻ lên Bảng tin của bạn</div>
                    </div>
                </button>

                <button class="share-option">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z" />
                    </svg>
                    <div>
                        <div class="share-option-title">Gửi trong Messenger</div>
                        <div class="share-option-desc">Chia sẻ với bạn bè qua Messenger</div>
                    </div>
                </button>

                <button class="share-option">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" />
                    </svg>
                    <div>
                        <div class="share-option-title">Chia sẻ vào Story</div>
                        <div class="share-option-desc">Chia sẻ vào Story của bạn</div>
                    </div>
                </button>
            </div>

            <div class="share-post-preview" id="sharePostPreview">
                <!-- Original post preview -->
            </div>
        </div>
    </div>
    @vite('resources/js/pages/app_home/home-enhanced.js')
    @vite('resources/js/pages/notification.js')
</body>

</html>
