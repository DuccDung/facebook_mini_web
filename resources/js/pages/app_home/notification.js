import { getWebSocket } from "../../utils/socket.js";
const socket = getWebSocket();
document.addEventListener("DOMContentLoaded", function () {
    socket.onmessage = function (event) {
        const data = JSON.parse(event.data);
       // console.log("Received WS message:", data);
        if (data.type === "message") {
            renderMessageNotification(data);
        }
        else if(data.type === "status_friend"){
            console.log("Friend status update:", data);
        }
        //  console.log("", data);
    };
});
function formatTime(timeString) {
    const date = new Date(timeString);
    return date.toLocaleString("vi-VN");
}

async function renderMessageNotification(data) {
    const container = document.getElementById("bell__notification-list");

    const html = `
        <div class="noti-item">
            <div class="noti-avatar-wrapper">
                <img class="noti-avatar" src="${data.avatar_url}">
                <img class="noti-type-icon comment"
                 src="/assets/app_chat/icons/noti_cmt.svg">
            </div>

            <div class="noti-content">
                <span class="noti-name">${data.sender.username}</span> đã gửi tin nhắn:
                <b>"${data.content}"</b>
                <span class="noti-time">${formatTime(data.created_at)}</span>
            </div>
        </div>
    `;
    container.insertAdjacentHTML("afterbegin", html);
}
