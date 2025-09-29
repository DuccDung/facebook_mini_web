// auth_service.js
import API from "../utils/api.js";

// Hàm đăng ký người dùng
export const registerService = async (payload) => {
  try {
    const res = await API.post('/api/sign-up', payload);
    return res;  // Trả về dữ liệu từ API
  } catch (error) {
    console.error("Error in registerService:", error);
    throw error;
  }
};

// Hàm đăng nhập người dùng
export const loginService = async (payload) => { // m viết lại cái đoạn này
  try {
    const res = await API.post('/api/sign-in', payload); // cái này sẽ đc nối vs domain api (gửi cái payload giống cái body bên postman)
    return res.data;
  } catch (error) {
    console.error("Error in loginService:", error);
    throw error;
  }
};

// function send again confirm mail
export const resendConfirmMailService = async (userId, email, token) => {
  try {
    const res = await API.get('/api/again-sent-email', {
      params: {
        userId: userId,
        email: email,
        token: token
      }
    });
    return res;
  } catch (error) {
    console.error("Error in resendConfirmMailService:", error);
    throw error;
  }
}