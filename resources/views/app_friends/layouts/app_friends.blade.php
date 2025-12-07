<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Bạn bè | Facebook</title>
    <link rel="stylesheet" href="{{ mix('resources/css/pages/app_chat/style.css') }}" />
    <link rel="stylesheet" href="{{ mix('resources/css/pages/app_home/home.css') }}" />
    <link rel="stylesheet" href="{{ mix('resources/css/pages/notification.css') }}" />
    <link rel="icon" href="{{ mix('resources/assets/app_chat/icons/facebook.svg') }}">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite('resources/css/pages/app_friends/app_friends.css')
    @vite('resources/css/pages/app_chat/top_bar.css')
    @vite('resources/js/pages/app_friends/app_friends.js')
    @vite('resources/js/pages/app_friends/suggest_allfriends.js')
    @vite('resources/js/pages/app_home/setup_home.js')
    @vite('resources/js/pages/logout.js')
    @vite('resources/js/pages/app_home/notification.js')
</head>

<body>
    <!-- Top Navigation Bar -->
    @include('app_chat.partials.top_bar')

    <!-- Main -->
<main class="friends-wrapper">

    <!-- LEFT SIDEBAR -->
    <aside class="friends-sidebar" id="sidebarDefault">
        <h2 class="sidebar-title">Bạn bè</h2>

       <ul class="sidebar-menu">
            <li class="active">
                <span class="icon-wrap"><i class="ri-home-4-line"></i></span>
                Trang chủ
            </li>
            <li data-page="requests">
                <span class="icon-wrap"><i class="ri-user-add-line"></i></span>
                Lời mời kết bạn
                <i class="ri-arrow-right-s-line arrow"></i>
            </li>
            <li data-page="suggestions">
                <span class="icon-wrap"><i class="ri-user-search-line"></i></span>
                Gợi ý
                <i class="ri-arrow-right-s-line arrow"></i>
            </li>
            <li data-page="allfriends">
                <span class="icon-wrap"><i class="ri-group-line"></i></span>
                Tất cả bạn bè
                <i class="ri-arrow-right-s-line arrow"></i>
            </li>
        </ul>

    </aside>


    <!-- ✅ SIDEBAR  Lời mời ban đầu (ẨN BAN ĐẦU) -->
    <aside class="friends-sidebar hidden" id="sidebarRequest">

        <div class="sidebar-back" id="backToHome">
            <i class="ri-arrow-left-line"></i>
            <span>Bạn bè</span>
        </div>

        <div class="request-sidebar-header">
            <h2 class="sidebar-title">Lời mời kết bạn</h2>
            <span class="count">221 lời mời kết bạn</span>
            <a href="#" class="view-sent">Xem lời mời đã gửi</a>
        </div>

        <!-- REQUEST LIST -->
        <div class="request-sidebar-list">

            <div class="request-user" data-user-id="1">
                <img src="https://i.pravatar.cc/100?1">
                <div class="info">
                    <strong>Việt Quang</strong>
                    <p>33 bạn chung</p>
                    <div class="actions">
                        <button class="btn-accept">Xác nhận</button>
                        <button class="btn-delete">Xóa</button>
                    </div>
                </div>
                <span class="time">1 ngày</span>
            </div>

            <div class="request-user" data-user-id="2">
                <img src="https://i.pravatar.cc/100?2">
                <div class="info">
                    <strong>Phuong Ngon</strong>
                    <p>5 bạn chung</p>
                    <div class="actions">
                        <button class="btn-accept">Xác nhận</button>
                        <button class="btn-delete">Xóa</button>
                    </div>
                </div>
                <span class="time">2 ngày</span>
            </div>

            <div class="request-user" data-user-id="3">
                <img src="https://i.pravatar.cc/100?3">
                <div class="info">
                    <strong>Ánh Dương</strong>
                    <p>13 bạn chung</p>
                    <div class="actions">
                        <button class="btn-accept">Xác nhận</button>
                        <button class="btn-delete">Xóa</button>
                    </div>
                </div>
                <span class="time">2 năm</span>
            </div>

            <div class="request-user" data-user-id="4">
                <img src="https://i.pravatar.cc/100?4">
                <div class="info">
                    <strong>Khánh Huyền</strong>
                    <p>262 bạn chung</p>
                    <div class="actions">
                        <button class="btn-accept">Xác nhận</button>
                        <button class="btn-delete">Xóa</button>
                    </div>
                </div>
                <span class="time">11 tuần</span>
            </div>

            <div class="request-user" data-user-id="5">
                <img src="https://i.pravatar.cc/100?5">
                <div class="info">
                    <strong>Nguyễn Tuấn</strong>
                    <p>6 bạn chung</p>
                    <div class="actions">
                        <button class="btn-accept">Xác nhận</button>
                        <button class="btn-delete">Xóa</button>
                    </div>
                </div>
                <span class="time">45 tuần</span>
            </div>

            <div class="request-user" data-user-id="6">
                <img src="https://i.pravatar.cc/100?6">
                <div class="info">
                    <strong>Mạnh Huy</strong>
                    <p>6 bạn chung</p>
                    <div class="actions">
                        <button class="btn-accept">Xác nhận</button>
                        <button class="btn-delete">Xóa</button>
                    </div>
                </div>
                <span class="time">7 tuần</span>
            </div>

            <div class="request-user" data-user-id="7">
                <img src="https://i.pravatar.cc/100?7">
                <div class="info">
                    <strong>Nguyễn Chính</strong>
                    <p>1 bạn chung</p>
                    <div class="actions">
                        <button class="btn-accept">Xác nhận</button>
                        <button class="btn-delete">Xóa</button>
                    </div>
                </div>
                <span class="time">2 năm</span>
            </div>

            <div class="request-user" data-user-id="8">
                <img src="https://i.pravatar.cc/100?8">
                <div class="info">
                    <strong>Thành Hoàng</strong>
                    <p>1 bạn chung</p>
                    <div class="actions">
                        <button class="btn-accept">Xác nhận</button>
                        <button class="btn-delete">Xóa</button>
                    </div>
                </div>
                <span class="time">3 ngày</span>
            </div>

            <div class="request-user" data-user-id="9">
                <img src="https://i.pravatar.cc/100?9">
                <div class="info">
                    <strong>Mai Anh</strong>
                    <p>8 bạn chung</p>
                    <div class="actions">
                        <button class="btn-accept">Xác nhận</button>
                        <button class="btn-delete">Xóa</button>
                    </div>
                </div>
                <span class="time">1 tuần</span>
            </div>

            <div class="request-user" data-user-id="10">
                <img src="https://i.pravatar.cc/100?10">
                <div class="info">
                    <strong>Quang Minh</strong>
                    <p>14 bạn chung</p>
                    <div class="actions">
                        <button class="btn-accept">Xác nhận</button>
                        <button class="btn-delete">Xóa</button>
                    </div>
                </div>
                <span class="time">5 ngày</span>
            </div>

            <div class="request-user" data-user-id="11">
                <img src="https://i.pravatar.cc/100?11">
                <div class="info">
                    <strong>Lan Phương</strong>
                    <p>21 bạn chung</p>
                    <div class="actions">
                        <button class="btn-accept">Xác nhận</button>
                        <button class="btn-delete">Xóa</button>
                    </div>
                </div>
                <span class="time">6 ngày</span>
            </div>

        </div>

    </aside>

    <!-- ✅ SIDEBAR Gợi ý (ẨN BAN ĐẦU) -->
    <aside class="friends-sidebar hidden" id="sidebarSuggest">

        <div class="sidebar-back" id="backToHome2">
            <i class="ri-arrow-left-line"></i>
            <span>Bạn bè</span>
        </div>

        <div class="request-sidebar-header">
            <h2 class="sidebar-title">Gợi ý</h2>
            <input type="text" id="suggestSearchInput" placeholder="Tìm bạn bè theo email">
            <span class="count"><b>Những người bạn có thể biết</b></span>
        </div>

        <!-- Suggest LIST -->
        <div class="suggest-sidebar-list">

            <div class="suggest-user" data-user-id="1">
                <img src="https://i.pravatar.cc/100?1">
                <div class="info">
                    <strong>Việt Quang</strong>
                    <p>33 bạn chung</p>
                    <div class="actions">
                        <button class="btn-add">Thêm bạn bè</button>
                        <button class="btn-delete">Gỡ</button>
                    </div>
                </div>
            </div>

        </div>

    </aside>

    <!-- ✅ SIDEBAR Tất cả bạn bè (ẨN BAN ĐẦU) -->
    <aside class="friends-sidebar hidden" id="sidebarAllFriends">

        <div class="sidebar-back" id="backToHome3">
            <i class="ri-arrow-left-line"></i>
            <span>Bạn bè</span>
        </div>

        <div class="request-sidebar-header">
            <h2 class="sidebar-title">Tất cả bạn bè</h2>
             <!-- THANH TÌM KIẾM -->
            <div class="friend-search-wrap">
                <i class="ri-search-line"></i>
                <input type="text" id="friendSearchInput" placeholder="Tìm kiếm Bạn bè">
            </div>

            <!-- TỔNG SỐ BẠN BÈ -->
            <div class="friend-count" id="friendCount"></div>
        </div>

        <!-- LIST FRIENDS-->
        <div class="friends-sidebar-list" id="friendsSidebarList">
        </div>

    </aside>

    <!-- RIGHT CONTENT: FIND & ADD FRIENDS-->
    <section class="friends-content" id="friendsContent">

        <!-- HOME CONTENT -->
        <div class="friends-header" id="friendsHome">
            <h2>Tìm kiếm bạn bè</h2>            
        </div>
        <!-- SEARCH BAR -->
        <div class="friends-search">
            <input type="text" id="friendsSearchInput" placeholder="Tìm bạn bè theo email">
            <p id="gybb">Gợi ý bạn bè</p>
        </div>


        <!-- GRID LIST -->
        <div class="friends-grid">

            <!-- CARD 1 -->
            <div class="friend-card">
                <img src="https://images.unsplash.com/photo-1503342217505-b0a15ec3261c" class="friend-img">
                <div class="friend-info">
                    <h3>Phuong Ngon</h3>
                    <p>5 bạn chung</p>
                    <button class="btn-accept">Thêm bạn bè</button>
                    <button class="btn-delete">Gỡ</button>
                </div>
            </div>
            <!-- CARD 1 -->
            <div class="friend-card">
                <img src="https://images.unsplash.com/photo-1503342217505-b0a15ec3261c" class="friend-img">
                <div class="friend-info">
                    <h3>Phuong Ngon</h3>
                    <p>5 bạn chung</p>
                    <button class="btn-accept">Thêm bạn bè</button>
                    <button class="btn-delete">Gỡ</button>
                </div>
            </div>
        </div>

        <!-- REQUEST CONTENT -->
        <div id="friendsRequest" class="hidden"></div>
    </section>

</main>

<!-- SENT REQUEST POPUP -->
<div class="sent-popup hidden" id="sentPopup">
    <div class="sent-overlay"></div>

    <div class="sent-modal">
        <!-- HEADER -->
        <div class="sent-header">
            <h3>Lời mời đã gửi</h3>
            <button class="sent-close" id="closeSentPopup">
                <i class="ri-close-line"></i>
            </button>
        </div>

        <!-- COUNT -->
        <div class="sent-count">1 lời mời đã gửi</div>

        <!-- LIST -->
        <div class="sent-list">
            <div class="sent-item" id="sent-1">
                <img src="https://i.pravatar.cc/100?22">
                <div class="sent-info">
                    <strong>Nguyễn Mai Anh</strong>
                    <span>1 bạn chung</span>
                </div>
                <button class="btn-cancel" data-id="1">Hủy lời mời</button>
            </div>

        </div>
    </div>
</div>

<!-- UNFRIEND POPUP -->
<div class="unfriend-popup hidden" id="unfriendPopup">
    <div class="unfriend-overlay"></div>

    <div class="unfriend-modal">
        <div class="unfriend-header">
            <h3 id="unfriendTitle">Hủy kết bạn</h3>
            <button class="unfriend-close" id="closeUnfriendPopup">
                <i class="ri-close-line"></i>
            </button>
        </div>

        <div class="unfriend-text" id="unfriendText">
            Bạn có chắc chắn muốn hủy kết bạn với người này không?
        </div>

        <div class="unfriend-actions">
            <button class="btn-cancel-popup" id="cancelUnfriendBtn">Hủy</button>
            <button class="btn-confirm-popup" id="confirmUnfriendBtn">Xác nhận</button>
        </div>
    </div>
</div>


</body>

</html>
