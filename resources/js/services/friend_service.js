import API from "../utils/api.js";
export const findFriend = async (userId, keyword) => {
  try {
    const res = await API.get('/api/FriendShip/find', {
      params: {
        userId: userId,
        email: keyword
      }
    });
    return res;
  } catch (error) {
    console.error("Error :", error);
    throw error;
  }
}

//https://localhost:7202/api/FriendShip/friends/2053
// get friends list
export const getFriends = async (userId) => {
  try {
    const res = await API.get(`/api/FriendShip/friends/${userId}`);
    return res.data;
  } catch (error) {
    console.error("Error :", error);
    throw error;
  }
}