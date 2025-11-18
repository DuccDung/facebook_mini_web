<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>facebook</title>
    <link rel="stylesheet" href="{{ mix('resources/css/pages/app_chat/style.css') }}" />
    <link rel="stylesheet" href="{{ mix('resources/css/pages/app_personal/personalpage.css') }}" />
    <link rel="icon" href="{{ mix('resources/assets/app_chat/icons/facebook.svg') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite('resources/js/pages/app_personal/personalpage.js')
    @vite('resources/js/pages/app_personal/cover_img.js')
    @vite('resources/js/pages/app_personal/setup_profile.js')
    @vite('resources/js/pages/app_personal/profile_photos.js')
    @vite('resources/js/pages/app_personal/friend_ship.js')
</head>

<body>
    @include('app_chat.partials.top_bar')
    {{-- <div class="app">
        <!-- LEFT: thread list -->
        @include('app_chat.partials.left_pane')

        <!-- RIGHT: conversation -->
        @include('app_chat.partials.chat_pane')
    </div> --}}

    <div class="main-container">

        <div class="cover-photo-container">
            <div class="cover-photo">
                <div class="add-cover-btn">
                    <i class="fas fa-camera"></i> Thêm ảnh bìa
                </div>
            </div>

            <div class="profile-section-wrapper">
                <div class="profile-info">
                    <div class="profile-pic-container">
                        <div class="profile-pic">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="camera-icon">
                            <i class="fas fa-camera"></i>
                        </div>
                    </div>
                    <div class="profile-details">
                        <h1 class="profile-name" id="personal_profile-name"></h1>
                        <div class="friend-count"></div>
                    </div>
                    <div class="profile-actions">
                        <button class="btn btn-primary"><i class="fas fa-plus"></i> Thêm vào tin</button>
                        <button class="btn btn-secondary"><i class="fas fa-pen"></i> Chỉnh sửa trang cá nhân</button>
                    </div>
                </div>

                <div class="profile-nav">
                    <div class="p-nav-item active">Bài viết</div>
                    <div class="p-nav-item">Giới thiệu</div>
                    <div class="p-nav-item">Bạn bè</div>
                    <div class="p-nav-item">Ảnh</div>
                    <div class="p-nav-item">Reels</div>
                    <div class="p-nav-item">Check in</div>
                    <div class="p-nav-item p-nav-more">Xem thêm <i class="fas fa-caret-down"
                            style="margin-left: 6px;"></i></div>
                    <div style="flex-grow: 1;"></div>
                    <div class="btn btn-secondary" style="width: 48px;"><i class="fas fa-ellipsis-h"
                            style="margin:0;"></i></div>
                </div>
            </div>
        </div>

        <div class="content-area">
            <div class="col-left">
                <div class="card">
                    <div class="card-header">
                        <span class="card-title">Giới thiệu</span>
                    </div>
                    <!-- Dòng hiển thị tiểu sử (ẩn khi chưa có) -->
                    <div id="bioDisplay"
                        style="text-align:center; margin-bottom: 16px; display:none; color: var(--text-primary); font-size:16px;">
                    </div>

                    <!-- Nút Thêm/Chỉnh sửa tiểu sử (lúc đầu chỉ hiện nút này) -->
                    <button id="openBioEditor" class="btn btn-secondary" style="width: 100%; margin-bottom: 16px;">
                        Thêm tiểu sử
                    </button>


                    <!-- Form nhập tiểu sử (ẩn mặc định) -->
                    <div id="bioEditor" style="display:none; margin-bottom: 16px;">

                        <textarea id="bioInput" maxlength="101"
                            style="width:100%; height:90px; padding:10px; border-radius:8px;
                                border:1px solid var(--divider); font-size:15px; text-align:center;"></textarea>

                        <div style="text-align:right; margin-top:4px; font-size:13px; color:var(--text-secondary);">
                            Còn <span id="bioCounter">101</span> ký tự
                        </div>

                        <div style="display:flex; align-items:center; margin-top:10px; gap:10px;">
                            <img src="https://i.imgur.com/1X4VFsM.png" width="24" style="border-radius:50%;">
                            <span style="color:var(--text-secondary); flex:1;">Công khai</span>

                            <button id="cancelBio" class="btn btn-secondary">Hủy</button>
                            <button id="saveBio" class="btn btn-primary" disabled>Lưu</button>
                        </div>
                    </div>

                    <button class="btn btn-secondary btn-edit-details" style="width: 100%; margin-bottom: 16px;">
                        Chỉnh sửa chi tiết
                    </button>

                    <button class="btn btn-secondary" style="width: 100%;">Thêm nội dung đáng chú ý</button>
                </div>

                <div class="card">
                    <div class="card-header">
                        <span class="card-title">Ảnh</span>
                        <span class="link-blue" id="viewAllPhotosBtn">Xem tất cả ảnh</span>
                    </div>
                    <div class="photos-grid" id="profilePhotosGrid"></div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <span class="card-title">Bạn bè</span>
                        <span class="link-blue" id="viewAllFriendsBtn">Xem tất cả bạn bè</span>
                    </div>
                    <div style="color: var(--text-secondary);" class="friend-count">Bạn bè</div>

                    <!-- nơi render danh sách -->
                    <div id="friends-preview" class="friends-preview"></div>
                </div>
               
                <div class="card">
                    <div class="card-header">
                        <span class="card-title">Tìm kiếm người dùng</span>
                    </div>

                    <div class="search-box">
                        <input id="searchUserInput" type="text" placeholder="Tìm kiếm theo tên..." />
                        <button id="searchUserBtn" class="btn btn-primary">Tìm</button>
                    </div>

                    <div id="searchUserResult" class="search-user-result"></div>
                </div>

            </div>

            <div class="col-right">
                <div class="card">
                    <div class="composer">
                        <div class="composer-avatar"></div>
                        <div class="composer-input">Bạn đang nghĩ gì?</div>
                    </div>
                    <div class="composer-actions">
                        <div class="c-action"><i class="fas fa-video" style="color: #f02849;"></i> Video trực tiếp
                        </div>
                        <div class="c-action c-action-photo"><i class="fas fa-images" style="color: #45bd62;"></i>
                            Ảnh/video</div>
                        <div class="c-action"><i class="fas fa-flag" style="color: #36a4fa;"></i> Cột mốc</div>
                    </div>
                </div>

                <div class="feed-filters">
                    <div class="filter-title">Bài viết</div>
                    <div class="filter-actions">
                        <button class="btn btn-secondary"><i class="fas fa-sliders-h"></i> Bộ lọc</button>
                        <button class="btn btn-secondary"><i class="fas fa-cog"></i> Quản lý bài viết</button>
                    </div>
                </div>

                <div class="card" style="padding: 0; overflow: hidden;">
                    <div style="display: flex; border-bottom: 1px solid var(--divider);">
                        <div
                            style="flex: 1; padding: 12px; text-align: center; font-weight: 600; color: var(--accent-blue); border-bottom: 3px solid var(--accent-blue);">
                            <i class="fas fa-bars"></i> Chế độ xem danh sách
                        </div>
                        <div
                            style="flex: 1; padding: 12px; text-align: center; font-weight: 600; color: var(--text-secondary); cursor: pointer;">
                            <i class="fas fa-th-large"></i> Chế độ xem lưới
                        </div>
                    </div>
                </div>
                <div id="post-list"></div>



                <div class="fbx-post">
                    <!-- HEADER -->
                    <div class="fbx-header">
                        <img class="fbx-avatar" src="/facebook_mini_ui/messenger-clone/assets/images/6.png">
                        <div class="fbx-meta">
                            <div class="fbx-author">Lê Ngọc <span>đã cập nhật ảnh đại diện của cô ấy.</span></div>
                            <div class="fbx-time">26 tháng 7, 2023 · <i class="fas fa-lock"></i></div>
                        </div>
                        <i class="fas fa-ellipsis-h fbx-menu-btn"></i>
                    </div>

                    <!-- MEDIA -->
                    <div class="fbx-media">
                        <div class="fbx-media-inner">
                            GIỌT HỒNG TRI ÂN <i class="fas fa-plus-circle"></i>
                        </div>
                    </div>

                    <!-- REACTION BAR (emoji) -->
                    <div class="fbx-reaction-bar" id="fbxReactionBar">
                        <span data-type="like" class="fbx-react">👍</span>
                        <span data-type="love" class="fbx-react">❤️</span>
                        <span data-type="care" class="fbx-react">🥰</span>
                        <span data-type="haha" class="fbx-react">😆</span>
                        <span data-type="wow" class="fbx-react">😮</span>
                        <span data-type="sad" class="fbx-react">😢</span>
                        <span data-type="angry" class="fbx-react">😡</span>
                    </div>

                    <!-- STATS -->
                    <div class="fbx-stats" id="fbxStats">
                        <div class="fbx-likes">
                            <span id="fbxReactionDisplay"></span>
                        </div>
                        <div id="fbxCommentCount">0 bình luận</div>
                    </div>

                    <div class="fbx-divider"></div>

                    <!-- ACTION BAR -->
                    <div class="fbx-actions">
                        <button id="fbxLikeBtn">
                            <i id="fbxLikeIcon" class="fa-regular fa-thumbs-up"></i>
                            <span id="fbxLikeLabel">Thích</span>
                        </button>
                        <button id="fbxCommentBtn">
                            <i class="fa-regular fa-comment"></i> Bình luận
                        </button>
                        <button id="fbxShareBtn">
                            <i class="fa-solid fa-share"></i> Chia sẻ
                        </button>
                    </div>

                    <!-- COMMENT LIST (ĐỂ TRÊN) -->
                    <div id="fbxCommentList"></div>

                    <!-- COMMENT INPUT (ĐỂ DƯỚI) -->
                    <div class="fbx-comment-box" id="fbxCommentBox">
                        <img src="/facebook_mini_ui/messenger-clone/assets/images/6.png" class="fbx-cavatar">
                        <input type="text" id="fbxCommentInput" placeholder="Viết bình luận…">
                    </div>

                </div>

                <!-- SHARE POPUP -->
                <div id="fbxSharePopup" class="fbx-share-popup">
                    <div class="fbx-share-content">
                        <h3>Chia sẻ</h3>

                        <!-- chọn nơi chia sẻ -->
                        <label class="fbx-share-label">Chia sẻ tới:</label>
                        <select id="fbxShareTarget" class="fbx-share-select">
                            <option value="feed">Bảng feed của bạn</option>
                            <option value="private">Chỉ mình tôi</option>
                            <option value="messenger">Gửi bằng Messenger cho bạn bè</option>
                        </select>

                        <!-- tên bạn bè khi chọn messenger -->
                        <input type="text" id="fbxShareFriend" class="fbx-share-friend"
                            placeholder="Tên bạn bè (khi gửi bằng Messenger)" style="display:none;">

                        <!-- nội dung chia sẻ -->
                        <textarea id="fbxShareText" placeholder="Hãy nói gì đó về nội dung này…"></textarea>

                        <div class="fbx-share-actions">
                            <button id="fbxShareSend">Chia sẻ ngay</button>
                            <button id="fbxShareClose">Đóng</button>
                        </div>
                    </div>
                </div>

                <!-- SHARE SUCCESS TOAST -->
                <div id="fbxToast" class="fbx-toast">Đã chia sẻ thành công!</div>



            </div>
        </div>


    </div>

    <!-- ========== POST POPUP (XEM BÀI VIẾT NỔI) ========== -->
    <div id="postModal" class="post-modal">
        <div class="post-overlay"></div>
        <div class="post-popup">
            <div class="post-popup-header">
                <h3 id="postPopupTitle">Bài viết</h3>
                <button class="post-popup-close" id="closePostModal">✖</button>
            </div>
            <div id="postPopupContent" class="post-popup-content">
                <!-- Nội dung bài viết sẽ được chèn bằng JS -->
            </div>
        </div>
    </div>


    <!-- ============ POPUP CHỌN ẢNH ĐẠI DIỆN ============ -->
    <div id="avatarPickerModal" class="avatar-modal">
        <div class="avatar-overlay"></div>

        <div class="avatar-popup">
            <div class="avatar-header">
                <span>Chọn ảnh đại diện</span>
                <button id="closeAvatarModal">✖</button>
            </div>

            <div class="avatar-content">

                <!-- Nút upload đúng ID -->
                <button class="upload-btn" id="uploadAvatarBtn">
                    <i class="fas fa-upload"></i> Tải ảnh lên
                </button>

                <!-- Input ẩn -->
                <input type="file" id="avatarFileInput" accept="image/*" style="display:none;">

                <h3 class="section-title">Ảnh gợi ý</h3>
                <div class="avatar-grid" id="suggestedPhotos"></div>

                <h3 class="section-title">Ảnh đã tải lên</h3>
                <div class="avatar-grid" id="uploadedPhotos"></div>
            </div>
        </div>
    </div>

    <div id="toastContainer"></div>




    <!--bài đăng mới -->
    <div id="postCreatorModal" class="post-creator-modal hide-modal">
        <div class="post-creator-overlay"></div>

        <div class="post-creator-popup">
            <div class="post-creator-header">
                <span>Tạo bài viết</span>
                <button id="postCreatorClose" class="close-btn">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="post-creator-body">
                <div class="post-creator-user">
                    <img src="messenger-clone/assets/images/6.png" class="post-creator-user-avatar">
                    <div>
                        <div class="post-creator-username">Lê Ngọc</div>

                        <select id="postPrivacy" class="post-privacy-select">
                            <option value="public">🌍 Công khai</option>
                            <option value="friends">👥 Bạn bè</option>
                            <option value="private">🔒 Chỉ mình tôi</option>
                        </select>
                    </div>
                </div>

                <textarea id="postCreatorText" placeholder="Bạn đang nghĩ gì?" class="post-creator-input"></textarea>

                <div class="post-image-upload">
                    <div id="postAddImage" class="add-img-btn">
                        <i class="fas fa-image"></i> Thêm ảnh
                    </div>

                    <input type="file" id="postImageInput" accept="image/*" hidden>

                    <div id="postImagePreview" class="post-image-preview"></div>
                </div>
            </div>

            <button id="postCreatorSubmit" class="post-creator-btn">Đăng</button>
        </div>


    </div>

</body>

</html>
