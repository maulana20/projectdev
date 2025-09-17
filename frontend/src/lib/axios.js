import Axios from "axios";

const axios = Axios.create({
  baseURL: process.env.NEXT_PUBLIC_BACKEND_URL,
  headers: { "X-Requested-With": "XMLHttpRequest" },
  withCredentials: true,
  withXSRFToken: true
});

axios.interceptors.request.use(async (config) => {
  const sessionToken = await Clerk.session.getToken()
  config.headers.Authorization = `Bearer ${sessionToken}`;
  return config;
});

export default axios;

export const csrf = () => axios.get("/csrf-cookie");