import {getWebSocket} from "../../utils/socket.js";
const socket = getWebSocket();
document.addEventListener("DOMContentLoaded", function() {
    socket.onmessage = function(event) {
        const data = JSON.parse(event.data);
        console.log("Received WS message:", data);
    };
});