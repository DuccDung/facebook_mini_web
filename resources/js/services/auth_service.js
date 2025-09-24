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
export const loginService = async (payload) => {
  try {
    const res = await API.post('/login', payload);
    return res.data;
  } catch (error) {
    console.error("Error in loginService:", error);
    throw error;
  }
};
