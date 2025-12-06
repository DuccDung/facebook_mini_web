<div id="groupModal" class="group-modal hidden">
    <div class="modal-overlay"></div>

    <div class="modal-box">

        <!-- HEADER -->
        <div class="modal-header">
            <span class="title">Tạo nhóm</span>
            <button class="close-btn" id="closeGroupModal">✕</button>
        </div>

        <!-- BODY -->
        <div class="modal-body">

            <!-- Tên nhóm -->
            <div class="input-group">
                <div class="avatar-placeholder">
                    <img src="{{ Vite::asset('resources/assets/app_chat/icons/chat_camera.svg') }}">
                </div>
                <input type="text" id="popup_name-inp" class="name-input" placeholder="Nhập tên nhóm...">
            </div>

            <!-- Ô tìm kiếm -->
            <div class="search-wrapper">
                <input type="text" id="popup__search-friend" class="search-input" placeholder="Nhập tên hoặc gmail">
            </div>
            <div id="noResult" class="no-result" style="display:none;">Không tìm thấy kết quả</div>


            <!-- === DANH SÁCH ĐÃ CHỌN === -->
            <div id="selectedList" class="selected-list"></div>

            <!-- DANH SÁCH NGƯỜI -->
            <div class="contact-list" id="popup__contact-friends">
                {{-- <div class="contact-title">Danh sách bạn bè</div> --}}
                <!-- MỘT ITEM -->
                {{-- <label class="contact-item">
                    <input type="checkbox" name="member"
                        value="1"
                        data-name="Đức Dũng"
                        data-email="ducdung@gmail.com"
                        data-avatar="https://i.pravatar.cc/40?img=5">

                    <div class="avatar-wrapper">
                        <img src="https://i.pravatar.cc/40?img=5">
                        <span class="online-dot"></span>
                    </div>

                    <span>Đức Dũng</span>
                </label> --}}
            </div>

        </div>

        <!-- FOOTER -->
        <div class="modal-footer">
            <button class="cancel-btn">Hủy</button>
            <button class="create-btn">Tạo nhóm</button>
        </div>
    </div>
</div>