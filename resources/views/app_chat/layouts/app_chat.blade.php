<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Messenger • Clone</title>
    <link rel="stylesheet" href="{{ mix('resources/css/pages/app_chat/style.css') }}" />
    <link rel="icon" href="{{ mix('resources/assets/app_chat/icons/facebook.svg') }}">
    @vite('resources/js/pages/app_chat/app.js')
</head>
<body>
    @include('app_chat.partials.top_bar')
    <div class="app">
        <!-- LEFT: thread list -->
        @include('app_chat.partials.left_pane')

        <!-- RIGHT: conversation -->
        @include('app_chat.partials.chat_pane')
    </div>

    <div id="emojiPanel" class="emoji-panel" hidden aria-hidden="true"></div>

    <!-- Call overlays: integrated UIs from separate demo pages -->
    <div id="incomingCallModal" class="call-modal-backdrop" hidden>
        <div class="call-card" role="dialog" aria-modal="true" aria-label="Incoming call">
            <button class="close-btn" id="incomingCloseBtn" title="Đóng" aria-label="Close">
                <svg viewBox="0 0 20 20">
                    <path
                        d="M10 8.586l4.95-4.95 1.414 1.414-4.95 4.95 4.95 4.95-1.414 1.414-4.95-4.95-4.95 4.95-1.414-1.414 4.95-4.95-4.95-4.95L5.05 3.636z" />
                </svg>
            </button>
            <div class="incoming-label">Cuộc gọi đến</div>
            <img id="incomingAvatar" class="avatar" src="assets/images/avatar-default.png" alt="">
            <div id="incomingName" class="caller-name">Người gọi</div>
            <div class="encrypted">
                <svg viewBox="0 0 16 16">
                    <path fill="currentColor"
                        d="M5.5 8V6A2.5 2.5 0 0110.5 6v2h1.25C12.44 8 13 8.56 13 9.25v3.5C13 13.44 12.44 14 11.75 14h-7.5C3.56 14 3 13.44 3 12.75v-3.5C3 8.56 3.56 8 4.25 8H5.5zm1-2A1.5 1.5 0 008 7.5V8h2v-.5A1.5 1.5 0 008.5 6zm-2.25 4C4.11 10 4 10.11 4 10.25v2.5c0 .14.11.25.25.25h7.5c.14 0 .25-.11.25-.25v-2.5A.25.25 0 0011.75 10h-7.5z" />
                </svg>
                Được mã hóa đầu-cuối
            </div>
            <div class="actions">
                <button id="incomingDeclineBtn" class="action-btn" title="Từ chối" aria-label="Decline">
                    <span class="action-circle decline">
                        <svg width="27" height="27" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M6.62 10.79a15.053 15.053 0 006.59 6.59l2.2-2.2a1 1 0 011.06-.24c1.12.37 2.33.57 3.53.57a1 1 0 011 1v3.5a1 1 0 01-1 1C10.07 22 2 13.93 2 4.5A1 1 0 013 3.5H6.5a1 1 0 011 1c0 1.2.19 2.41.57 3.53a1 1 0 01-.24 1.06l-2.2 2.2z" />
                        </svg>
                    </span>
                    <span class="action-label decline">Từ chối</span>
                </button>
                <button id="incomingAcceptBtn" class="action-btn" title="Chấp nhận" aria-label="Accept">
                    <span class="action-circle accept">
                        <svg width="27" height="27" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M6.62 10.79a15.053 15.053 0 006.59 6.59l2.2-2.2a1 1 0 011.06-.24c1.12.37 2.33.57 3.53.57a1 1 0 011 1v3.5a1 1 0 01-1 1C10.07 22 2 13.93 2 4.5A1 1 0 013 3.5H6.5a1 1 0 011 1c0 1.2.19 2.41.57 3.53a1 1 0 01-.24 1.06l-2.2 2.2z"
                                transform="rotate(135 12 12)" />
                        </svg>
                    </span>
                    <span class="action-label accept">Chấp nhận</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Audio call overlay -->
    <div id="audioCallOverlay" class="call-overlay" hidden>
        <div class="call-audio-bg"></div>
        <button class="fullscreen-btn" id="acFullscreenBtn" title="Toàn màn hình" aria-label="Fullscreen">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                <path
                    d="M6.5 2.5h-4a.5.5 0 00-.5.5v4M11.5 2.5h4a.5.5 0 01.5.5v4M6.5 15.5h-4a.5.5 0 01-.5-.5v-4M11.5 15.5h4a.5.5 0 00.5-.5v-4"
                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
            </svg>
        </button>
        <div class="center-content">
            <img id="acAvatar" class="avatar" src="assets/images/avatar-default.png" alt="">
            <div id="acName" class="caller-name">Tên</div>
            <div id="acStatus" class="calling-status">Đang gọi...</div>
        </div>
        <div class="bottom-controls">
            <button class="control-btn" id="acShareBtn" title="Chia sẻ màn hình" aria-label="Share screen">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-screen-share">
                    <path d="M13 3H4a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-3" />
                    <path d="M8 21h8" />
                    <path d="M12 17v4" />
                    <path d="m17 8 5-5" />
                    <path d="M17 3h5v5" />
                </svg>
            </button>
            <button class="control-btn" id="acAddBtn" title="Thêm người" aria-label="Add person">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="lucide lucide-user-round-plus">
                    <path d="M2 21a8 8 0 0 1 13.292-6" />
                    <circle cx="10" cy="8" r="5" />
                    <path d="M19 16v6" />
                    <path d="M22 19h-6" />
                </svg>
            </button>
            <button class="control-btn" id="acMuteBtn" title="Tắt/Bật mic" aria-label="Mute">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="lucide lucide-mic-off">
                    <path d="M12 19v3" />
                    <path d="M15 9.34V5a3 3 0 0 0-5.68-1.33" />
                    <path d="M16.95 16.95A7 7 0 0 1 5 12v-2" />
                    <path d="M18.89 13.23A7 7 0 0 0 19 12v-2" />
                    <path d="m2 2 20 20" />
                    <path d="M9 9v3a3 3 0 0 0 5.12 2.12" />
                </svg>
            </button>
            <button class="control-btn red" id="acHangupBtn" title="Kết thúc" aria-label="End call">
                <svg viewBox="0 0 24 24" fill="currentColor">
                    <path
                        d="M13.832 16.568a1 1 0 0 0 1.213-.303l.355-.465A2 2 0 0 1 17 15h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2A18 18 0 0 1 2 4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-.8 1.6l-.468.351a1 1 0 0 0-.292 1.233 14 14 0 0 0 6.392 6.384" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Video call overlay -->
    <div id="videoCallOverlay" class="call-overlay video" hidden>
        <video id="vcRemote" class="video-bg" autoplay muted loop playsinline
            src="https://www.w3schools.com/html/mov_bbb.mp4"></video>
        <video id="vcLocalFull" class="local-fullscreen" autoplay muted playsinline style="display:none"></video>
        <div class="overlay" aria-hidden="true"></div>
        <button class="fullscreen-btn" id="vcFullscreenBtn" title="Toàn màn hình" aria-label="Fullscreen">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round">
                <polyline points="15 3 21 3 21 9" />
                <polyline points="9 21 3 21 3 15" />
                <line x1="21" y1="3" x2="14" y2="10" />
                <line x1="3" y1="21" x2="10" y2="14" />
            </svg>
        </button>
        <div id="vcLocalThumb" class="thumb" title="Nhấn để phóng to video của bạn"
            aria-label="Local video thumbnail" tabindex="0" style="display:none">
            <video id="vcLocal" autoplay muted playsinline></video>
        </div>
        <div id="vcRemoteThumb" class="thumb" title="Nhấn để xem người kia" aria-label="Remote thumbnail"
            tabindex="0" style="display:none">
            <video id="vcRemoteThumbVideo" autoplay muted loop playsinline
                src="https://www.w3schools.com/html/mov_bbb.mp4"></video>
        </div>
        <div class="bottom-controls" role="toolbar" aria-label="Call controls">
            <button class="control-btn" id="vcShareBtn" title="Chia sẻ màn hình" aria-label="Share screen">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="lucide lucide-screen-share">
                    <path d="M13 3H4a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-3" />
                    <path d="M8 21h8" />
                    <path d="M12 17v4" />
                    <path d="m17 8 5-5" />
                    <path d="M17 3h5v5" />
                </svg>
            </button>
            <button class="control-btn" id="vcAddBtn" title="Thêm người" aria-label="Add person">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="lucide lucide-user-round-plus">
                    <path d="M2 21a8 8 0 0 1 13.292-6" />
                    <circle cx="10" cy="8" r="5" />
                    <path d="M19 16v6" />
                    <path d="M22 19h-6" />
                </svg>
            </button>
            <button class="control-btn" id="vcToggleVideoBtn" title="Bật/Tắt camera" aria-label="Toggle video"
                aria-pressed="false"></button>
            <button class="control-btn" id="vcMuteBtn" title="Tắt/Bật mic" aria-label="Mute" aria-pressed="false">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="lucide lucide-mic-off">
                    <path d="M12 19v3" />
                    <path d="M15 9.34V5a3 3 0 0 0-5.68-1.33" />
                    <path d="M16.95 16.95A7 7 0 0 1 5 12v-2" />
                    <path d="M18.89 13.23A7 7 0 0 0 19 12v-2" />
                    <path d="m2 2 20 20" />
                    <path d="M9 9v3a3 3 0 0 0 5.12 2.12" />
                </svg>
            </button>
            <button class="control-btn red" id="vcHangupBtn" title="Kết thúc" aria-label="End call">
                <svg viewBox="0 0 24 24" fill="currentColor">
                    <path
                        d="M13.832 16.568a1 1 0 0 0 1.213-.303l.355-.465A2 2 0 0 1 17 15h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2A18 18 0 0 1 2 4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-.8 1.6l-.468.351a1 1 0 0 0-.292 1.233 14 14 0 0 0 6.392 6.384" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Call ended overlay -->
    <div id="callEndedOverlay" class="call-ended-overlay" hidden>
        <div class="center" role="status" aria-live="polite">
            <img id="ceAvatar" class="avatar" src="assets/images/avatar-default.png" alt="Caller avatar">
            <div id="ceName" class="name">Tên</div>
            <div class="status">Đã kết thúc cuộc gọi</div>
        </div>
        <div class="action-bar" role="toolbar" aria-label="Call actions">
            <div class="action">
                <button id="ceRedialBtn" class="btn redial" title="Gọi lại" aria-label="Redial">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-phone">
                        <path
                            d="M13.832 16.568a1 1 0 0 0 1.213-.303l.355-.465A2 2 0 0 1 17 15h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2A18 18 0 0 1 2 4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-.8 1.6l-.468.351a1 1 0 0 0-.292 1.233 14 14 0 0 0 6.392 6.384" />
                    </svg>
                </button>
                <div class="label">Gọi lại</div>
            </div>
            <div class="action">
                <button id="ceCloseBtn" class="btn close" title="Đóng" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-x" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6L6 18" />
                        <path d="M6 6l12 12" />
                    </svg>
                </button>
                <div class="label">Đóng</div>
            </div>
        </div>
    </div>

    {{-- <script src="js/call.js"></script> --}}
    <!-- Code injected by live-server -->
    <script>
        // <![CDATA[  <-- For SVG support
        if ('WebSocket' in window) {
            (function() {
                function refreshCSS() {
                    var sheets = [].slice.call(document.getElementsByTagName("link"));
                    var head = document.getElementsByTagName("head")[0];
                    for (var i = 0; i < sheets.length; ++i) {
                        var elem = sheets[i];
                        var parent = elem.parentElement || head;
                        parent.removeChild(elem);
                        var rel = elem.rel;
                        if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() ==
                            "stylesheet") {
                            var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
                            elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date()
                                .valueOf());
                        }
                        parent.appendChild(elem);
                    }
                }
                var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
                var address = protocol + window.location.host + window.location.pathname + '/ws';
                var socket = new WebSocket(address);
                socket.onmessage = function(msg) {
                    if (msg.data == 'reload') window.location.reload();
                    else if (msg.data == 'refreshcss') refreshCSS();
                };
                if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
                    console.log('Live reload enabled.');
                    sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
                }
            })();
        } else {
            console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
        }
        // ]]>
    </script>
</body>

</html>
