import API from "../utils/api.js";

// Hàm đăng ký người dùng
export const getProfile = async (userId) => {
    try {
        const res = await API.get('/api/Profiles/get-profile', {
            params: {
                userId: userId,
            }
        });
        return res.data;
    } catch (error) {
        console.error("Error in resendConfirmMailService:", error);
        throw error;
    }
};
