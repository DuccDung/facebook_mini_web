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
                <input type="text" class="name-input" placeholder="Nhập tên nhóm...">
            </div>

            <!-- Ô tìm kiếm -->
            <div class="search-wrapper">
                <input type="text" class="search-input" placeholder="Nhập tên hoặc gmail">
            </div>
            <div id="noResult" class="no-result" style="display:none;">Không tìm thấy kết quả</div>


            <!-- === DANH SÁCH ĐÃ CHỌN === -->
            <div id="selectedList" class="selected-list"></div>

            <!-- DANH SÁCH NGƯỜI -->
            <div class="contact-list">

                <div class="contact-title">Trò chuyện gần đây</div>

                <!-- MỘT ITEM -->
                <label class="contact-item">
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
                </label>

                <label class="contact-item">
                    <input type="checkbox" name="member"
                        value="2"
                        data-name="Bích"
                        data-email="ngocbich@gmail.com"
                        data-avatar="https://i.pravatar.cc/40?img=1">

                    <div class="avatar-wrapper">
                        <img src="https://i.pravatar.cc/40?img=1">
                        <span class="online-dot"></span>
                    </div>

                    <span>Bích</span>
                </label>

                <label class="contact-item">
                    <input type="checkbox" name="member"
                        value="3"
                        data-name="Quang Tùng"
                        data-email="buiquangtung@gmail.com"
                        data-avatar="https://i.pravatar.cc/40?img=10">

                    <div class="avatar-wrapper">
                        <img src="https://i.pravatar.cc/40?img=10">
                        <span class="online-dot"></span>
                    </div>

                    <span>Quang Tùng</span>
                </label>

                <label class="contact-item">
                    <input type="checkbox" name="member"
                        value="4"
                        data-name="Minh Khoa"
                        data-email="vuminhkhoa@gmail.com"
                        data-avatar="https://i.pravatar.cc/40?img=15">

                    <div class="avatar-wrapper">
                        <img src="https://i.pravatar.cc/40?img=15">
                        <span class="online-dot"></span>
                    </div>

                    <span>Minh Khoa</span>
                </label>

                <label class="contact-item">
                    <input type="checkbox" name="member"
                        value="5"
                        data-name="Thu Hằng"
                        data-email="hangthu@gmail.com"
                        data-avatar="https://i.pravatar.cc/40?img=22">

                    <div class="avatar-wrapper">
                        <img src="https://i.pravatar.cc/40?img=22">
                        <span class="online-dot"></span>
                    </div>

                    <span>Thu Hằng</span>
                </label>

                <label class="contact-item">
                    <input type="checkbox" name="member"
                        value="6"
                        data-name="Hoàng Nam"
                        data-email="hnam@gmail.com"
                        data-avatar="https://i.pravatar.cc/40?img=30">

                    <div class="avatar-wrapper">
                        <img src="https://i.pravatar.cc/40?img=30">
                        <span class="online-dot"></span>
                    </div>

                    <span>Hoàng Nam</span>
                </label>

                <label class="contact-item">
                    <input type="checkbox" name="member"
                        value="7"
                        data-name="Lan Anh"
                        data-email="lanh@gmail.com"
                        data-avatar="https://i.pravatar.cc/40?img=35">

                    <div class="avatar-wrapper">
                        <img src="https://i.pravatar.cc/40?img=35">
                        <span class="online-dot"></span>
                    </div>

                    <span>Lan Anh</span>
                </label>

                <label class="contact-item">
                    <input type="checkbox" name="member"
                        value="8"
                        data-name="Trung Kiên"
                        data-email="buiTrkien@gmail.com"
                        data-avatar="https://i.pravatar.cc/40?img=50">

                    <div class="avatar-wrapper">
                        <img src="https://i.pravatar.cc/40?img=50">
                        <span class="online-dot"></span>
                    </div>

                    <span>Trung Kiên</span>
                </label>

            </div>

        </div>

        <!-- FOOTER -->
        <div class="modal-footer">
            <button class="cancel-btn">Hủy</button>
            <button class="create-btn">Tạo nhóm</button>
        </div>
    </div>
</div>