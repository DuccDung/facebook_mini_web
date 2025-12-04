<!-- LEFT: thread list -->
<aside class="left-pane">
    <div class="list-header">
        <h2>Đoạn chat</h2>
        <div class="list-actions">
            <!-- ICON DẤU 3 CHẤM -->
            <button class="icon-btn" id="menuBtn">
                <img src="{{ Vite::asset('resources/assets/app_chat/icons/options.svg') }}" alt="Menu">
            </button>
            <!-- Nút mở modal -->
            <button class="icon-btn tooltip" data-tooltip="Tin nhắn mới" id="newMsgBtn1">
                <img src="{{ Vite::asset('resources/assets/app_chat/icons/chat_edit.svg') }}" alt="⋮">
            </button>
        </div>
    </div>

    <div class="search-row">
        <!-- ICON TRỞ VỀ (tách riêng, ẩn lúc đầu) -->
        <button id="backIcon" class="back-btn2 hidden">
            <img src="{{ Vite::asset('resources/assets/app_chat/icons/chat_leftarrow.svg') }}" />
        </button>

        <div class="search">
            <img id="searchIcon" src="{{ Vite::asset('resources/assets/app_chat/icons/search.svg') }}" alt="" />
            <input id="threadSearch" type="text" placeholder="Tìm kiếm trên Messenger" />
        </div>
    </div>

    <div class="tabs">
        <button class="tab active" data-tab="all">Tất cả</button>
        <button class="tab" data-tab="unread">Chưa đọc</button>
        <button class="tab" data-tab="groups">Nhóm</button>
        <button class="tab more"><img src="{{ Vite::asset('resources/assets/app_chat/icons/dots.svg') }}" alt=""></button>
    </div>

    <ul class="thread-list" id="threadList" aria-label="Thread list">
        <!-- items are injected by JS -->

    </ul>
    <div id="contactListPane" class="hidden contact-pane">

        <div class="contact-header">
            <h3>Danh bạ của bạn</h3>
        </div>

        <div class="contact-body" id="contactList">
            <!-- Danh sách bạn bè (sẽ đổ bằng JS sau) -->
            <div class="contact-item">
                <img src="https://i.pravatar.cc/40" />
                <span>Nguyễn Văn 1</span>
            </div>
            <div class="contact-item">
                <img src="https://i.pravatar.cc/41" />
                <span>Nguyễn Thu 2</span>
            </div>
            <div class="contact-item">
                <img src="https://i.pravatar.cc/40" />
                <span>Nguyễn Văn 3</span>
            </div>
            <div class="contact-item">
                <img src="https://i.pravatar.cc/41" />
                <span>Nguyễn Thu 4</span>
            </div>
            <div class="contact-item">
                <img src="https://i.pravatar.cc/40" />
                <span>Nguyễn Văn 5</span>
            </div>
            <div class="contact-item">
                <img src="https://i.pravatar.cc/41" />
                <span>Nguyễn Thu 6</span>
            </div>
            <div class="contact-item">
                <img src="https://i.pravatar.cc/40" />
                <span>Nguyễn Văn 7</span>
            </div>
            <div class="contact-item">
                <img src="https://i.pravatar.cc/41" />
                <span>Nguyễn Thu 8</span>
            </div>
            <div class="contact-item">
                <img src="https://i.pravatar.cc/40" />
                <span>Nguyễn Văn 9</span>
            </div>
            <div class="contact-item">
                <img src="https://i.pravatar.cc/41" />
                <span>Nguyễn Thu 10</span>
            </div>

        </div>

    </div>


</aside>