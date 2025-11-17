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