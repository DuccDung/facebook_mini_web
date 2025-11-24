import API from "../utils/api.js";


export const getAllPostsApi = async (userId) => {
    try {
        const res = await API.get(`/api/Posts/list?userId=${userId}`);
        return res.data; // array post
    } catch (error) {
        console.error("Error in getAllPostsApi:", error);
        throw error;
    }
};
export const createPostApi = async (userId, content, postType = 0, tagFriendIds = []) => {
    try {
        const body = {
            userId,
            content,
            postType,
            tagFriendIds
        };

        const res = await API.post('/api/Posts/create', body);
        return res.data; // { message, postId, ... }
    } catch (error) {
        console.error("Error in createPost:", error);
        throw error;
    }
};

export const uploadMediaFiles = async (assetId, files) => {
    try {
        const formData = new FormData();

        // Nếu là FileList (từ input) thì convert sang array
        const fileArray = Array.from(files);

        fileArray.forEach(file => {
            // Backend expect key "Files"
            formData.append("Files", file);
        });

        formData.append("Folder", "social_network");

        const res = await API.post(
            "/api/Media/upload/files",
            formData,
            {
                params: { asset_id: assetId },
                headers: {
                    "Content-Type": "multipart/form-data"
                }
            }
        );

        return res.data;
    } catch (error) {
        console.error("Error in uploadMediaFiles:", error);
        throw error;
    }
};