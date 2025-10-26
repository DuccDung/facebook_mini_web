// auth_service.js
import API from "../utils/api.js";

export const GetConversations = async (userId) => {
  try {
    const res = await API.get('/api/Chat/GetConversation', {
      params: {
        userId: userId,
      }
    });
    return res;
  } catch (error) {
    console.error("Error in resendConfirmMailService:", error);
    throw error;
  }
}