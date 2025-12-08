import { getActiveId, getThreads } from "../app_chat/app"
import { getWebSocket } from "../../utils/socket"
// Call overlay integration for Messenger clone
// Provides simple UI flows for: incoming call, audio call, video call, and call ended.
// This is UI-only (no real signaling). It mirrors behaviors from the demo pages in this repo.
// Đảm bảo WebSocket đã được kết nối
const socket = getWebSocket();
const qs = (sel) => document.querySelector(sel);
const $ = (id) => document.getElementById(id);

// Header buttons
const btnVoiceCall = $('btnVoiceCall');
const btnVideoCall = $('btnVideoCall');

// Overlays
const incomingModal = $('incomingCallModal');
const audioOverlay = $('audioCallOverlay');
const videoOverlay = $('videoCallOverlay');
const endedOverlay = $('callEndedOverlay');
let cv_calling;
// Incoming controls
const incomingCloseBtn = $('incomingCloseBtn');
const incomingDeclineBtn = $('incomingDeclineBtn');
const incomingAcceptBtn = $('incomingAcceptBtn');

// Audio call controls
const acMuteBtn = $('acMuteBtn');
const acHangupBtn = $('acHangupBtn');
const acFullscreenBtn = $('acFullscreenBtn');

// Video call controls
const vcToggleVideoBtn = $('vcToggleVideoBtn');
const vcMuteBtn = $('vcMuteBtn');
const vcHangupBtn = $('vcHangupBtn');
const vcFullscreenBtn = $('vcFullscreenBtn');
const vcLocalThumb = $('vcLocalThumb');
const vcLocal = $('vcLocal');
const vcLocalFull = $('vcLocalFull');
const vcRemote = $('vcRemote');
const vcRemoteThumb = $('vcRemoteThumb');
const vcRemoteThumbVideo = $('vcRemoteThumbVideo');

// Ended overlay controls
const ceRedialBtn = $('ceRedialBtn');
const ceCloseBtn = $('ceCloseBtn');

// Peer info from current chat header
const peerAvatar = $('peerAvatar');
const peerName = $('peerName');

// State
let cameraStream = null;
let cameraEnabled = false;
let audioMuted = true; // mute by default
let localFocused = false;
let localStream = null;
let remoteStream = null;
let peerConnection = null;
let currentRemoteUserId = null;

// Cấu hình ICE server
const rtcConfig = {
  iceServers: [
    { urls: "stun:stun.l.google.com:19302" },
    // Có TURN server thì thêm tại đây
  ],
};

const localVideoEl = () => document.getElementById("vcLocal");
const remoteVideoEl = () => document.getElementById("vcRemote");



(function () {


  // Tạo PeerConnection
  function createPeerConnection() {
    peerConnection = new RTCPeerConnection(rtcConfig);

    // add local tracks
    if (localStream) {
      console.log("có dữ liệu local");
      localStream.getTracks().forEach((track) =>
        peerConnection.addTrack(track, localStream)
      );
    }

    // nhận track remote
    // peerConnection.ontrack = (event) => {
    //   console.log("Remote track received:", event.streams);

    //   if (!remoteStream) {
    //       console.log(remoteStream.getTracks());
    //     remoteStream = event.streams[0];
    //     const rv = remoteVideoEl();
    //     if (rv) rv.srcObject = remoteStream;
    //   }
    // };
    // peerConnection.ontrack = (event) => {
    //   console.log("Remote track received:", event.streams);

    //   // Lấy stream từ event
    //   const stream = event.streams[0];
    //   if (!stream) {
    //     console.warn("No stream in ontrack event");
    //     return;
    //   }

    //   // Debug đúng cách
    //   console.log("Remote tracks:", stream.getTracks());
    //   console.log("Video tracks:", stream.getVideoTracks());
    //   console.log("Audio tracks:", stream.getAudioTracks());

    //   // Gán vào biến global + set cho video
    //   if (!remoteStream) {
    //     remoteStream = stream;
    //     const rv = remoteVideoEl(); // document.getElementById("vcRemote")
    //     if (rv) {
    //       rv.srcObject = remoteStream;
    //       rv.autoplay = true;
    //       rv.playsInline = true;
    //       rv.muted = true; // cho chắc auto-play
    //       rv.play().catch(err => console.warn("Cannot autoplay remote:", err));
    //     }
    //   }
    // };

    peerConnection.ontrack = (event) => {
      console.log("Remote track received:", event.streams);
      if (!remoteStream) {
        remoteStream = event.streams[0];
        const rv = remoteVideoEl();
        if (rv) rv.srcObject = remoteStream;
      }
    };




    // ICE candidate local -> gửi cho remote
    peerConnection.onicecandidate = (event) => {
      if (event.candidate) {
        // console.log("Send ICE to", currentRemoteUserId);
        //======================================
        const messageData = {
          type: "ice-candidate",
          userId: localStorage.getItem("userId"),
          candidate: event.candidate,
          conversation_id: cv_calling,
        };
        sendMessage(messageData);
        //======================================
        // sendMessagews({
        //   type: "ice-candidate",
        //   candidate: event.candidate,
        //   to: currentRemoteUserId,
        // });
      }
    };

    peerConnection.onconnectionstatechange = () => {
      console.log("PeerConnection state:", peerConnection.connectionState);
    };

    console.log("PeerConnection created");
  }
  // Bắt đầu gọi: tạo Offer
  async function startCall() {
    if (!localStream) {
      await startCamera();
    }
    if (!peerConnection) {
      createPeerConnection();
    }

    try {
      const activeThread = getThreads().find(thread => thread.id === getActiveId());
      if (!activeThread) return;
      const { id, name, avatar } = activeThread;
      const offer = await peerConnection.createOffer();
      await peerConnection.setLocalDescription(offer);
      // ====================
      const messageData = {
        type: "offer",
        userId: localStorage.getItem("userId"),
        offer: offer,
        conversation_id: id,
      };
      sendMessage(messageData);
      // ====================

      // sendMessagews({
      //   type: "offer",
      //   offer,
      //   to: remoteUserId,
      // });

      // console.log("Offer sent to", remoteUserId);
    } catch (err) {
      console.error("Error during startCall:", err);
    }
  }
  // Xử lý Offer nhận được
  async function handleOffer(msg) {

    if (!localStream) {
      await startCamera();
    }
    if (!peerConnection) {
      createPeerConnection();
    }

    try {
      await peerConnection.setRemoteDescription(
        new RTCSessionDescription(msg.offer)
      );

      const answer = await peerConnection.createAnswer();
      await peerConnection.setLocalDescription(answer);
      //========================
      const messageData = {
        type: "answer",
        userId: localStorage.getItem("userId"),
        answer: answer,
        conversation_id: cv_calling,
      };
      sendMessage(messageData);
      //========================
      // sendMessagews({
      //   type: "answer",
      //   answer,
      //   to: msg.from,
      // });

      console.log("Answer sent to", cv_calling);
    } catch (err) {
      console.error("Error handling offer:", err);
    }
  }
  // Xử lý Answer
  async function handleAnswer(msg) {
    try {
      await peerConnection.setRemoteDescription(
        new RTCSessionDescription(msg.answer)
      );
      console.log("Answer set as remote description");
    } catch (err) {
      console.error("Error handling answer:", err);
    }
  }
  // Xử lý ICE candidate nhận được
  async function handleIceCandidate(msg) {
    try {
      if (peerConnection && msg.candidate) {
        await peerConnection.addIceCandidate(
          new RTCIceCandidate(msg.candidate)
        );
        console.log("Added remote ICE candidate");
      }
    } catch (err) {
      console.error("Error adding ICE candidate:", err);
    }
  }

  async function acceptCaller() {
    const messageData = {
      type: "accept_caller",
      userId: localStorage.getItem("userId"),
      conversation_id: cv_calling,
    };
    sendMessage(messageData);
  }
  //=================================================================
  // Hàm gửi thông điệp qua WebSocket
  function sendMessage(messageData) {

    if (socket && socket.readyState === WebSocket.OPEN) {
      const message = JSON.stringify(messageData);
      socket.send(message);
      console.log("Message sent:", messageData);
    } else {
      console.error("WebSocket is not open");
    }
  }

  socket.onmessage = async function (event) {
    const data = JSON.parse(event.data);
    // console.log("Received WS message:", data);
    //SenderId
    const myId = localStorage.getItem("userId");

    // Nếu message do chính mình gửi -> bỏ qua
    // if (data.userId === myId) {
    //   return;
    // }

    if (data.type === "calling") {
      console.log("received calling:", data);
      cv_calling = data.ConversationId;
      openIncoming(data.SenderId, data.ConversationId, data.UserName, data.Avatar);
    }
    else if (data.type === "call_refuse") {

      const activeThread = getThreads().find(thread => thread.id === getActiveId());
      if (activeThread) {
        const { id, name, avatar } = activeThread;  // Lấy id, name, avatar từ activeThread
        let avatarArray = JSON.parse(avatar);
        let avatar_temp;
        avatarArray.forEach(img => {
          avatar_temp = img;
        });
        showEnded(name, avatar_temp);
      }
      closeVideoCall();
    }
    else if (data.type === "offer") {
      console.log("offer: ", data);
      await handleOffer(data);
    }
    else if (data.type === "answer") {
      await handleAnswer(data);
    }
    else if (data.type === "ice-candidate") {
      await handleIceCandidate(data);
    }
    //call_refuse
    // const messageData = {
    //   type: "answer",
    //   userId: localStorage.getItem("userId"),
    //   answer: answer,
    //   conversation_id: incomingModal.dataset.conversationId,
    // };
  };







  const VIDEO_OFF_SVG = `
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-video-off">
      <path d="M10.66 6H14a2 2 0 0 1 2 2v2.5l5.248-3.062A.5.5 0 0 1 22 7.87v8.196"/>
      <path d="M16 16a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h2"/>
      <path d="m2 2 20 20"/>
    </svg>`.trim();
  const VIDEO_ON_SVG = `
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-video-on">
      <path d="M10.66 6H14a2 2 0 0 1 2 2v2.5l5.248-3.062A.5.5 0 0 1 22 7.87v8.196"/>
      <path d="m16 13 5.223 3.482a.5.5 0 0 0 .777-.416V7.87a.5.5 0 0 0-.752-.432L16 10.5"/>
      <rect x="2" y="6" width="14" height="12" rx="2"/>
    </svg>`.trim();
  function openAudioCall(name, avatar) {
    $('acName').textContent = name;
    $('acAvatar').src = avatar;
    $('acStatus').textContent = 'Đang gọi...';
    setHidden(audioOverlay, false);
  }
  function closeAudioCall() { setHidden(audioOverlay, true); }

  async function openVideoCall(name, avatar) {
    // Ensure initial UI
    updateVideoBtn();
    toggleLocalFocus(false);
    setHidden(videoOverlay, false);
    await startCamera();
  }
  function closeVideoCall() {
    stopCamera();
    setHidden(videoOverlay, true);
  }

  function setHidden(el, v) { if (!el) return; v ? el.setAttribute('hidden', '') : el.removeAttribute('hidden'); }
  function requestFS() {
    const doc = document;
    const el = doc.documentElement;
    const isFs = !!(doc.fullscreenElement || doc.webkitFullscreenElement || doc.mozFullScreenElement || doc.msFullscreenElement);
    if (!isFs) {
      if (el.requestFullscreen) el.requestFullscreen();
      else if (el.webkitRequestFullscreen) el.webkitRequestFullscreen();
      else if (el.mozRequestFullScreen) el.mozRequestFullScreen();
      else if (el.msRequestFullscreen) el.msRequestFullscreen();
    } else {
      if (document.exitFullscreen) document.exitFullscreen();
      else if (document.webkitExitFullscreen) document.webkitExitFullscreen();
      else if (document.mozCancelFullScreen) document.mozCancelFullScreen();
      else if (document.msExitFullscreen) document.msExitFullscreen();
    }
  }

  function updateVideoBtn() {
    if (!vcToggleVideoBtn) return;
    if (cameraEnabled) {
      vcToggleVideoBtn.innerHTML = VIDEO_ON_SVG;
      vcToggleVideoBtn.setAttribute('aria-pressed', 'true');
    } else {
      vcToggleVideoBtn.innerHTML = VIDEO_OFF_SVG;
      vcToggleVideoBtn.setAttribute('aria-pressed', 'false');
    }
  }


  function stopCamera() {
    if (cameraStream) cameraStream.getTracks().forEach(t => t.stop());
    cameraStream = null;
    if (vcLocal) vcLocal.srcObject = null;
    if (vcLocalFull) vcLocalFull.srcObject = null;
    if (vcLocalThumb) vcLocalThumb.style.display = 'none';
    cameraEnabled = false; updateVideoBtn();
    toggleLocalFocus(false);
  }
  // Gửi thông điệp liên tục trong 30 giây

  async function startCamera() {
    try {
      const stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
      cameraStream = stream;
      //=================
      if (localStream) return; // tránh gọi nhiều lần

      try {
        localStream = stream;
        const lv = localVideoEl();
        if (lv) lv.srcObject = localStream;
        console.log("Got local stream");
      } catch (err) {
        console.error("Error getting user media:", err);
        alert("Không truy cập được camera/mic");
      }
      //=================
      if (vcLocal) vcLocal.srcObject = stream;
      if (vcLocalFull) vcLocalFull.srcObject = stream;
      await vcLocal?.play().catch(() => { });
      await vcLocalFull?.play().catch(() => { });
      if (vcLocalThumb) vcLocalThumb.style.display = 'block';
      cameraEnabled = true; updateVideoBtn();
      // honor mute state
      if (audioMuted) stream.getAudioTracks().forEach(t => t.enabled = false);
    } catch (e) {
      console.warn('getUserMedia failed', e);
      stopCamera();
    }
  }
  async function toggleCamera() {
    if (cameraEnabled) stopCamera(); else await startCamera();
  }
  function toggleMute() {
    audioMuted = !audioMuted;
    if (cameraStream) cameraStream.getAudioTracks().forEach(t => t.enabled = !audioMuted);
    if (vcMuteBtn) vcMuteBtn.setAttribute('aria-pressed', String(!audioMuted));
    if (acMuteBtn) acMuteBtn.setAttribute('aria-pressed', String(!audioMuted));
  }
  function toggleLocalFocus(force) {
    if (typeof force === 'boolean') localFocused = force; else localFocused = !localFocused;
    document.body.classList.toggle('local-focused', localFocused);
    if (!vcLocalThumb || !vcRemoteThumb) return;
    if (localFocused) {
      if (vcLocalFull) vcLocalFull.style.display = 'block';
      vcRemoteThumb.style.display = 'block';
      vcLocalThumb.style.display = 'none';
    } else {
      if (vcLocalFull) vcLocalFull.style.display = 'none';
      vcRemoteThumb.style.display = 'none';
      if (cameraEnabled) vcLocalThumb.style.display = 'block';
    }
  }

  // Overlay open/close helpers
  function openIncoming(senderId, consersationId, name, avatar) {
    $('incomingName').textContent = name;
    $('incomingAvatar').src = avatar;
    incomingModal.setAttribute('data-sender-id', senderId);
    incomingModal.setAttribute('data-conversation-id', consersationId);
    // startCall();

    setHidden(incomingModal, false);
  }
  function closeIncoming() { setHidden(incomingModal, true); }



  function showEnded(name, avatar) {
    $('ceName').textContent = name;
    $('ceAvatar').src = avatar;
    setHidden(endedOverlay, false);
  }
  function hideEnded() { setHidden(endedOverlay, true); }

  function currentPeer() {
    return {
      name: peerName?.textContent || 'Bạn bè',
      avatar: peerAvatar?.getAttribute('src') || 'assets/images/avatar-default.png',
    };
  }

  // Wire header buttons
  btnVoiceCall?.addEventListener('click', () => {
    const { name, avatar } = currentPeer();
    // openAudioCall(name, avatar);
    // openAudioCall(name, avatar);
  });
  btnVideoCall?.addEventListener('click', async () => {
    const activeThread = getThreads().find(thread => thread.id === getActiveId());
    if (activeThread) {
      const { id, name, avatar } = activeThread;  // Lấy id, name, avatar từ activeThread
      let avatarArray = JSON.parse(avatar);
      let avatar_temp;
      avatarArray.forEach(img => {
        avatar_temp = img;
      });
      // Gọi hàm openVideoCall và truyền thông tin vào
      await openVideoCall(name, avatar_temp);  // Mở video call với thông tin đã lấy được
      startCall();
      const messageData = {
        type: "calling",  // Loại thông điệp (ví dụ: đang gọi)
        userId: localStorage.getItem("userId"),
        callType: "video", // Loại cuộc gọi ('audio' hoặc 'video')
        conversation_id: id,
      };
      sendMessage(messageData);
    } else {
      console.log("Không có phần tử active.");
    }
  });

  // Incoming modal buttons
  incomingCloseBtn?.addEventListener('click', closeIncoming);
  incomingDeclineBtn?.addEventListener('click', () => {
    closeIncoming();

    const activeThread = getThreads().find(thread => thread.id === getActiveId());
    if (activeThread) {
      const { id, name, avatar } = activeThread;  // Lấy id, name, avatar từ activeThread
      let avatarArray = JSON.parse(avatar);
      let avatar_temp;
      avatarArray.forEach(img => {
        avatar_temp = img;
      });
      const messageData = {
        type: "call_refuse",
        userId: localStorage.getItem("userId"),
        callType: "video", // Loại cuộc gọi ('audio' hoặc 'video')
        conversation_id: id,
      };
      sendMessage(messageData);
    }
    // show ended quickly
    if (activeThread) {
      const { id, name, avatar } = activeThread;  // Lấy id, name, avatar từ activeThread
      let avatarArray = JSON.parse(avatar);
      let avatar_temp;
      avatarArray.forEach(img => {
        avatar_temp = img;
      });
      showEnded(name, avatar_temp);
    }
  });
  incomingAcceptBtn?.addEventListener('click', async () => {
    const { name, avatar } = currentPeer();
    closeIncoming();
    // await openAudioCall(name, avatar);
    //  openAudioCall(name, avatar);
    openVideoCall();
  });

  // Audio call handlers
  acMuteBtn?.addEventListener('click', toggleMute);
  acHangupBtn?.addEventListener('click', () => {
    closeAudioCall();
    const activeThread = getThreads().find(thread => thread.id === getActiveId());
    if (activeThread) {
      const { id, name, avatar } = activeThread;  // Lấy id, name, avatar từ activeThread
      let avatarArray = JSON.parse(avatar);
      let avatar_temp;
      avatarArray.forEach(img => {
        avatar_temp = img;
      });
      showEnded(name, avatar_temp);
    }
  });
  acFullscreenBtn?.addEventListener('click', requestFS);

  // Video call handlers
  vcToggleVideoBtn?.addEventListener('click', toggleCamera);
  vcMuteBtn?.addEventListener('click', toggleMute);
  vcHangupBtn?.addEventListener('click', () => {
    closeVideoCall();

    // show ended quickly
    const activeThread = getThreads().find(thread => thread.id === getActiveId());
    if (activeThread) {
      const { id, name, avatar } = activeThread;  // Lấy id, name, avatar từ activeThread
      let avatarArray = JSON.parse(avatar);
      let avatar_temp;
      avatarArray.forEach(img => {
        avatar_temp = img;
      });
      const messageData = {
        type: "call_refuse",
        userId: localStorage.getItem("userId"),
        callType: "video", // Loại cuộc gọi ('audio' hoặc 'video')
        conversation_id: id,
      };
      sendMessage(messageData);
      showEnded(name, avatar_temp);
    }
    // const activeThread = getThreads().find(thread => thread.id === getActiveId());
    // if (activeThread) {
    //   const { id, name, avatar } = activeThread;  // Lấy id, name, avatar từ activeThread
    //   let avatarArray = JSON.parse(avatar);
    //   let avatar_temp;
    //   avatarArray.forEach(img => {
    //     avatar_temp = img;
    //   });
    //   showEnded(name, avatar_temp);
    // }
  });
  vcFullscreenBtn?.addEventListener('click', requestFS);

  // Swap focus
  vcLocalThumb?.addEventListener('click', () => toggleLocalFocus(true));
  vcLocalThumb?.addEventListener('keydown', (e) => { if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); toggleLocalFocus(true); } });
  vcRemoteThumb?.addEventListener('click', () => toggleLocalFocus(false));
  vcRemoteThumb?.addEventListener('keydown', (e) => { if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); toggleLocalFocus(false); } });

  // Ended overlay buttons
  ceRedialBtn?.addEventListener('click', () => {
    hideEnded();
    const { name, avatar } = currentPeer();
    openAudioCall(name, avatar);
  });
  ceCloseBtn?.addEventListener('click', hideEnded);

  // Expose minimal API
  window.callUI = {
    openIncoming,
    openAudioCall,
    closeAudioCall,
    openVideoCall,
    closeVideoCall,
    showEnded,
    hideEnded,
    toggleMute,
    toggleCamera,
    toggleLocalFocus,
  };
})();
