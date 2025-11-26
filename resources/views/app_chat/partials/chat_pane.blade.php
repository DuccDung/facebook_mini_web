  <!-- RIGHT: conversation -->
    <main class="chat-pane">
      <header class="chat-header">

        <!-- Nút back (ẩn mặc định, chỉ hiện khi mobile) -->
        <button class="icon-btn back-btn" id="backBtn">
          <img src="{{ Vite::asset('resources/assets/app_chat/icons/arrow-left.svg') }}" alt="Back">
        </button>

        <div class="peer">
          <img id="peerAvatar" src="assets/images/contact-1.png" alt="avatar" />
          <div>
            <div class="name" id="peerName"></div>
            <div class="sub" id="peerStatus"></div>
          </div>
        </div>
        <div class="chat-actions">
          <button id="btnVoiceCall" class="icon-btn" title="Gọi thoại"><img src="{{ Vite::asset('resources/assets/app_chat/icons/phone.svg') }}" alt=""></button>
          <button id="btnVideoCall" class="icon-btn" title="Gọi video"><img src="{{ Vite::asset('resources/assets/app_chat/icons/video.svg') }}" alt=""></button>
          <button class="icon-btn" title="Thông tin"><img src="{{ Vite::asset('resources/assets/app_chat/icons/info.svg') }}" alt=""></button>
        </div>
      </header>

      <div class="to-bar" id="toBar" hidden>
        <span>Đến:</span>

        <div class="to-input" id="toInput">
          <div id="selectedList" class="selected-list"></div>
          <input type="text" id="toSearch">
          <ul class="search-results" id="toSearchResults"></ul>

          <div id="toDropdown" class="to-dropdown hidden">
            <h4>Danh bạ của bạn</h4>
            <div class="dropdown-body" id="toContactList">
                <!-- Danh sách load từ JS -->
            </div>
          </div>
        </div>

      </div>

      {{-- height scroller == height total - (chatHeader + topBar + composer) --}}
      <section id="messageScroller" class="scroller">  
        <!-- Messages will be appended here -->
      </section>

      <footer class="composer hidden">
        <div class="composer-left">
          <button class="icon-btn" title="Ghi âm"><img src="{{ Vite::asset('resources/assets/app_chat/icons/mic-fill.svg') }}" alt=""></button>
          <button class="icon-btn" title="Ảnh/Video"><img src="{{ Vite::asset('resources/assets/app_chat/icons/images.svg') }}" alt=""></button>
          <button class="icon-btn" title="GIF"><img src="{{ Vite::asset('resources/assets/app_chat/icons/stickies.svg') }}" alt=""></button>
          <button class="icon-btn" title="Sticker"><img src="{{ Vite::asset('resources/assets/app_chat/icons/filetype-gif.svg') }}" alt=""></button>
        </div>
        <div class="input-wrap">
          <input id="msgInput" type="text" placeholder="Aa" autocomplete="off" />
        </div>
        <div class="composer-right">
          <button id="emojiBtn" class="icon-btn" title="Emoji"><img src="{{ Vite::asset('resources/assets/app_chat/icons/emoji.svg') }}" alt=""></button>
          <button id="sendBtn" class="send-btn" title="Gửi"><img src="{{ Vite::asset('resources/assets/app_chat/icons/send.svg') }}" alt=""></button>
        </div>
      </footer>
    </main>