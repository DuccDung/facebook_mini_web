<!-- LEFT: thread list -->
<aside class="left-pane">
    <div class="list-header">
        <h2>Đoạn chat</h2>
        <div class="list-actions">
            <!-- Nút mở modal -->
            <button class="icon-btn" id="newMsgBtn">
                <img src="{{ Vite::asset('resources/assets/app_chat/icons/options.svg') }}" alt="⋮">
            </button>
        </div>
    </div>


    <div class="search">
        <img src="{{ Vite::asset('resources/assets/app_chat/icons/search.svg') }}" alt="" />
        <input id="threadSearch" type="text" placeholder="Tìm kiếm trên Messenger" />
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


</aside>