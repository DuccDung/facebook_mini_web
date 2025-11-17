import API from "../utils/api.js";

export async function uploadOnceImage(file, folder = "social_network", assetId) {
  try {
    const formData = new FormData();
    formData.append("File", file);
    formData.append("Folder", folder);

    const response = await API.post(
      `/api/Media/upload/file?asset_id=${assetId}`,
      formData,
      {
        headers: {
          "Content-Type": "multipart/form-data", // override
        },
      }
    );

    return response.data;
  } catch (error) {
    console.error("Upload error:", error);
    throw error;
  }
}

export async function uploadImageProfile(file, type, folder = "social_network", assetId = "test") {
  try {
    const formData = new FormData();
    formData.append("File", file);
    formData.append("Folder", folder);

    const response = await API.post(
      `/api/Media/upload/img?asset_id=${assetId}&asset_type=${type}`,
      formData,
      {
        headers: {
          "Content-Type": "multipart/form-data", // override
        },
      }
    );

    return response.data;
  } catch (error) {
    console.error("Upload error:", error);
    throw error;
  }
}

export const getImageDemo = async (profileId) => {
  try {
    const res = await API.get('/api/Media/get/images-demo', {
      params: {
        asset_id: profileId,
      }
    });
    return res.data;
  } catch (error) {
    console.error("Error in resendConfirmMailService:", error);
    throw error;
  }
}

// /api/Media/get/update-bacground-img?mediaId=s
export const updateBackgroundImg = async (mediaId) => {
  try {
    const res = await API.get('/api/Media/get/update-bacground-img', {
      params: {
        mediaId: mediaId,
      }
    });
    return res.data;
  } catch (error) {
    console.error("Error in resendConfirmMailService:", error);
    throw error;
  }
}