<!-- LEFT: thread list -->
<aside class="left-pane">
    <div class="list-header">
        <h2>Đoạn chat</h2>
        <div class="list-actions">
            <!-- Nút mở modal -->
             <!-- ICON DẤU 3 CHẤM -->
            <button class="icon-btn" id="menuBtn">
                <img src="{{ Vite::asset('resources/assets/app_chat/icons/options.svg') }}" alt="Menu">
            </button>
            <button class="icon-btn" id="newMsgBtn">
                <img src="{{ Vite::asset('resources/assets/app_chat/icons/chat_edit.svg') }}" alt="⋮">
            </button>
            
        </div>
    </div>

    <div class="search-row">
        <!-- ICON TRỞ VỀ (tách riêng, ẩn lúc đầu) -->
        <button id="backIcon" class="back-btn hidden">
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
        <!-- GIAO DIỆN DANH SÁCH BẠN BÈ (HIỆN KHI TÌM KIẾM) -->
        
    </ul>
    <div id="contactListPane" class="hidden contact-pane">

        <div class="contact-header">
            <h3>Danh bạ của bạn</h3>
        </div>

        <div class="contact-body" id="contactList">
            <!-- Danh sách bạn bè (sẽ đổ bằng JS sau) -->
            <div class="contact-item">
                <img src="https://i.pravatar.cc/40" />
                <span>Nguyễn Văn A</span>
            </div>
            <div class="contact-item">
                <img src="https://i.pravatar.cc/41" />
                <span>Nguyễn Thu B</span>
            </div>
            <div class="contact-item">
                <img src="https://i.pravatar.cc/40" />
                <span>Nguyễn Văn A</span>
            </div>
            <div class="contact-item">
                <img src="https://i.pravatar.cc/41" />
                <span>Nguyễn Thu B</span>
            </div>
            <div class="contact-item">
                <img src="https://i.pravatar.cc/40" />
                <span>Nguyễn Văn A</span>
            </div>
            <div class="contact-item">
                <img src="https://i.pravatar.cc/41" />
                <span>Nguyễn Thu B</span>
            </div>
            <div class="contact-item">
                <img src="https://i.pravatar.cc/40" />
                <span>Nguyễn Văn A</span>
            </div>
            <div class="contact-item">
                <img src="https://i.pravatar.cc/41" />
                <span>Nguyễn Thu B</span>
            </div>
            <div class="contact-item">
                <img src="https://i.pravatar.cc/40" />
                <span>Nguyễn Văn A</span>
            </div>
            <div class="contact-item">
                <img src="https://i.pravatar.cc/41" />
                <span>Nguyễn Thu B</span>
            </div>
            <div class="contact-item">
                <img src="https://i.pravatar.cc/40" />
                <span>Nguyễn Văn A</span>
            </div>
            <div class="contact-item">
                <img src="https://i.pravatar.cc/41" />
                <span>Nguyễn Thu B</span>
            </div>
            <div class="contact-item">
                <img src="https://i.pravatar.cc/40" />
                <span>Nguyễn Văn A</span>
            </div>
            <div class="contact-item">
                <img src="https://i.pravatar.cc/41" />
                <span>Nguyễn Thu B</span>
            </div>
            <div class="contact-item">
                <img src="https://i.pravatar.cc/40" />
                <span>Nguyễn Văn A</span>
            </div>
            <div class="contact-item">
                <img src="https://i.pravatar.cc/41" />
                <span>Nguyễn Thu B</span>
            </div>
            <div class="contact-item">
                <img src="https://i.pravatar.cc/40" />
                <span>Nguyễn Văn A</span>
            </div>
            <div class="contact-item">
                <img src="https://i.pravatar.cc/41" />
                <span>Nguyễn Thu B</span>
            </div>

        </div>

    </div>


</aside>