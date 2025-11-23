<div class="noti-list">

<!--Hiển thị 5 tbao mới nhất-->

    <!-- 1. Cảm xúc -->

    <div class="noti-item">
        <div class="noti-avatar-wrapper">
            <img class="noti-avatar" 
                src="{{ Vite::asset('resources/assets/app_chat/images/user-default.png') }}">
            <img class="noti-type-icon react" 
                src="{{ Vite::asset('resources/assets/app_chat/icons/react_love.svg') }}" 
                alt="reaction icon">
        </div>

        <div class="noti-content">
            <span class="noti-name">Nguyễn Văn A</span> đã bày tỏ cảm xúc về bài viết của bạn.
            <span class="noti-time">2 giờ trước</span>
        </div>
    </div>

    <!-- 2. Bình luận -->
    <div class="noti-item">
        <div class="noti-avatar-wrapper">
            <img class="noti-avatar"
                 src="{{ Vite::asset('resources/assets/app_chat/images/user-default.png') }}">

            <img class="noti-type-icon comment"
                 src="{{ Vite::asset('resources/assets/app_chat/icons/noti_cmt.svg') }}">
        </div>

        <div class="noti-content">
            <span class="noti-name">Trần Thị B</span> đã bình luận: <b>"Ảnh đẹp quá!"</b>
            <span class="noti-time">1 giờ trước</span>
        </div>
    </div>
    
    <!-- 3. Share -->
    <div class="noti-item">
        <div class="noti-avatar-wrapper">
            <img class="noti-avatar"
                 src="{{ Vite::asset('resources/assets/app_chat/images/user-default.png') }}">

            <img class="noti-type-icon share"
                 src="{{ Vite::asset('resources/assets/app_chat/icons/noti_share.svg') }}">
        </div>

        <div class="noti-content">
            <span class="noti-name">Hoàng Anh</span> đã chia sẻ bài viết của bạn.
            <span class="noti-time">5 phút trước</span>
        </div>
    </div>

    <!-- 4. Kết bạn -->
    <div class="noti-item">
        <div class="noti-avatar-wrapper">
            <img class="noti-avatar"
                 src="{{ Vite::asset('resources/assets/app_chat/images/user-default.png') }}">

            <img class="noti-type-icon friend"
                 src="{{ Vite::asset('resources/assets/app_chat/icons/noti_friend.svg') }}">
        </div>

        <div class="noti-content">
            <span class="noti-name">Thu Hà</span> đã gửi cho bạn lời mời kết bạn.
            <span class="noti-time">3 phút trước</span>
        </div>
    </div>

    <!-- 5. Bài đăng ảnh/ thước phim -->
     <div class="noti-item">
        <div class="noti-avatar-wrapper">
            <img class="noti-avatar"
                 src="{{ Vite::asset('resources/assets/app_chat/images/user-default.png') }}">

            <img class="noti-type-icon post"
                 src="{{ Vite::asset('resources/assets/app_chat/icons/noti_post.svg') }}">
        </div>

        <div class="noti-content">
            <span class="noti-name">Mai Hương</span> đã đăng bài mới.
            <span class="noti-time">1 phút trước</span>
        </div>
    </div>

    <!--CÁC THÔNG BÁO CŨ – ẨN-->
    <div id="olderNoti" class="d-none">

        <!-- Bài đăng viết -->
        <div class="noti-item">
            <div class="noti-avatar-wrapper">
                <img class="noti-avatar"
                    src="{{ Vite::asset('resources/assets/app_chat/images/user-default.png') }}">

                <img class="noti-type-icon post"
                    src="{{ Vite::asset('resources/assets/app_chat/icons/noti_people.svg') }}">
            </div>

            <div class="noti-content">
                <span class="noti-name">Mai Hương</span> đã đăng bài mới.
                <span class="noti-time">1 phút trước</span>
            </div>
        </div>

        <div class="noti-item">
            <div class="noti-avatar-wrapper">
                <img class="noti-avatar"
                    src="{{ Vite::asset('resources/assets/app_chat/images/user-default.png') }}">
                <img class="noti-type-icon comment"
                    src="{{ Vite::asset('resources/assets/app_chat/icons/noti_cmt.svg') }}">
            </div>

            <div class="noti-content">
                <span class="noti-name">Hữu Dũng</span> đã bình luận bài viết của bạn.
                <span class="noti-time">3 ngày trước</span>
            </div>
        </div>

    </div>


    <!-- NÚT XEM THÊM -->
    <button id="showMoreNoti" class="show-more-noti">
        <b>Xem thông báo trước đó</b>
    </button>

</div>
