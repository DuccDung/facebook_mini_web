import { connectMqtt, subscribeRoom, publishToRoom, isConnected } 
  from "../../services/mqttService.js";

const userId = localStorage.getItem("userId");

// Kết nối MQTT khi trang chat load
export function initMqtt() {
  if (!isConnected()) {
    connectMqtt({
      wsUrl: "ws://13.112.144.107:15675/ws",
      username: "guest",
      password: "guest",
      clientId: `webchat_${userId}_${Math.random().toString(16).slice(2)}`,
    });
  }
}




