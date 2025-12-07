import { getFriends } from '../../services/friend_service.js';

// --- HÀM HELPER: LẤY USER ID TỪ LOCAL STORAGE ---
const getCurrentUserId = () => {
    try {
        // CÁCH 1: Nếu bạn lưu cả object user (VD: localStorage.setItem('user', JSON.stringify(user)))
        const userStr = localStorage.getItem('user');
        if (userStr) {
            const user = JSON.parse(userStr);
            // Kiểm tra xem database trả về field là 'id' hay 'userId'
            return user.userId || user.id; 
        }

        // CÁCH 2: Nếu bạn chỉ lưu mỗi ID (VD: localStorage.setItem('userId', '2053'))
        const userId = localStorage.getItem('userId');
        if (userId) return userId;

    } catch (error) {
        console.error("Lỗi khi lấy thông tin user từ storage:", error);
    }
    return null;
};

const renderFriendList = async () => {
    // 1. Lấy ID động
    const currentUserId = getCurrentUserId();

    // Nếu chưa đăng nhập (không có ID), dừng lại hoặc chuyển hướng về login
    if (!currentUserId) {
        console.warn("Chưa tìm thấy thông tin đăng nhập (User ID).");
        return;
    }

    const contactsListElement = document.querySelector('.contacts-list');
    if (!contactsListElement) return;

    try {
        console.log(`Đang tải bạn bè cho User ID: ${currentUserId}`);
        
        // 2. GỌI API VỚI ID ĐỘNG
        const data = await getFriends(currentUserId);
        
        // Log dữ liệu kiểm tra
        // console.log("Dữ liệu bạn bè:", data);

        const friendsList = data.info;

        if (friendsList && Array.isArray(friendsList) && friendsList.length > 0) {
            
            const htmlContent = friendsList.map(friend => {
                const defaultAvatar = 'messenger-clone/assets/images/contact-1.png';
                const avatar = friend.avatarUrl ? friend.avatarUrl : defaultAvatar;

                // Lưu ý: href nên dẫn về trang profile của bạn đó
                return `
                    <a href="/profile/${friend.userId}" class="contact-item" data-id="${friend.userId}">
                        <div class="contact-avatar">
                            <img src="${avatar}" alt="${friend.userName}" 
                                 onerror="this.onerror=null;this.src='${defaultAvatar}';">
                            <span class="online-dot"></span>
                        </div>
                        <span class="contact-name">${friend.userName}</span>
                    </a>
                `;
            }).join('');

            contactsListElement.innerHTML = htmlContent;
        } else {
            contactsListElement.innerHTML = '<div style="padding:10px; color:#888; font-size:13px;">Chưa có liên hệ nào</div>';
        }

    } catch (error) {
        console.error("Lỗi hiển thị bạn bè:", error);
    }
};

document.addEventListener('DOMContentLoaded', () => {
    renderFriendList();
});