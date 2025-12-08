// websocket.js
let socket = null;

export function getWebSocket() {
  if (!socket || socket.readyState === WebSocket.CLOSED) {
    const userId = localStorage.getItem("userId");
     //socket = new WebSocket(`ws://localhost:5180/ws?userId=${userId}`);
     socket = new WebSocket(`ws://13.112.144.107:5007/ws?userId=${userId}`);

    socket.onopen = () => console.log("WS Connected");
    socket.onclose = () => console.log("WS Closed");
    socket.onerror = (err) => console.error("WS Error:", err);
  }
  return socket;
}
