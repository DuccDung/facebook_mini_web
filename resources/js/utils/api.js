import axios from "axios";

// Tạo instance mặc định
//https://localhost:7087
//http://localhost:5000
const API = axios.create({
  baseURL: "http://localhost:5000", // đây là domain 
  // headers: {
  //   "Content-Type": "application/json",
  // },
  withCredentials: true, 
});

export default API;

// API.interceptors.request.use(
//   (config) => {
//     const token = localStorage.getItem("access_token");
//     if (token) {
//       config.headers.Authorization = `Bearer ${token}`;
//     }
//     return config;
//   },
//   (error) => Promise.reject(error)
// );

// API.interceptors.response.use(
//   (response) => response,
//   (error) => {
//     if (error.response) {
//       console.error("API Error:", error.response.data);
//       // Chuyển hướng nếu 401 Unauthorized
//       if (error.response.status === 401) {
//         window.location.href = "/login";
//       }
//     }
//     return Promise.reject(error);
//   }
// );

