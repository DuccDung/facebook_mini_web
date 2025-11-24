<div id="notiDropdown" class="noti-dropdown d-none">

    <div class="noti-header">
        <h3>Thông báo</h3>

        <!-- Nút 3 chấm -->
        <button id="notiHeaderMoreBtn" class="noti-header-more-btn">
            <img src="{{ Vite::asset('resources/assets/app_chat/icons/options.svg') }}" alt="">
        </button>

        <!-- Menu nhỏ -->
        <div id="notiHeaderMoreMenu" class="noti-header-more-menu">
            <div class="menu-item-option">
                <img class="menu-icon" src="{{ Vite::asset('resources/assets/app_chat/icons/noti_menu_tick.svg') }}" alt=""> 
                Đánh dấu tất cả là đã đọc</div>
            <div class="menu-item-option">
                <img class="menu-icon" src="{{ Vite::asset('resources/assets/app_chat/icons/noti_menu_setting.svg') }}" alt=""> 
                Cài đặt thông báo</div>
            <div class="menu-item-option">
                <img class="menu-icon" src="{{ Vite::asset('resources/assets/app_chat/icons/noti_menu_opennoti.svg') }}" alt=""> 
                Mở thông báo</div>
        </div>
    </div>


    @include('app_chat.partials.notifications.notification_item')
</div>
