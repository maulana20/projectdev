import useSWR from "swr";
import axios, { csrf } from "@/lib/axios";
import { useEffect } from "react";
import { useParams, useRouter } from "next/navigation";

export const useAuth = ({ middleware, redirectIfAuthenticated } = {}) => {
  const router = useRouter();
  const params = useParams();

  const { data: user, error, mutate } = useSWR(`${process.env.NEXT_PUBLIC_BACKEND_URL}/me`, () =>
    axios.get("/me")
      .then(res => res.data)
      .catch(error => {
        if (error.response.status !== 409) throw error
        router.push("/verify-email")
      }),
    );

  const confirm = async ({ setErrors, url }) => {
    axios.get(url)
      .then(() => router.push(redirectIfAuthenticated))
      .catch(err => setErrors(err.response.data.errors || [ err.response.data.message || "An error occurred." ]));
  };

  const register = async ({ setErrors, ...props }) => {
    setErrors([]);
    csrf();
    axios
      .post("/register", props)
      .then(() => mutate())
      .catch(error => {
        if (error.response.status !== 422) throw error;
        setErrors(error.response.data.errors)
      });
  };

  const login = async ({ setErrors, setStatus, ...props }) => {
    setErrors([]);
    setStatus(null);
    csrf();
    axios.post("/login", props)
      .then(() => mutate())
      .catch(error => {
        if (error.response.status !== 422) throw error;
        setErrors(error.response.data.errors)
      });
  };

  const forgotPassword = async ({ setErrors, setStatus, email }) => {
    setErrors([]);
    setStatus(null);
    csrf();
    axios.post("/forgot-password", { email })
      .then(response => setStatus(response.data.status))
      .catch(error => {
        if (error.response.status !== 422) throw error;
        setErrors(error.response.data.errors);
      })
    };

  const resetPassword = async ({ setErrors, setStatus, ...props }) => {
    setErrors([]);
    setStatus(null);
    csrf();
    axios.post("/reset-password", { token: params.token, ...props })
    .then(response => router.push("/login?reset=" + btoa(response.data.status)))
    .catch(error => {
        if (error.response.status !== 422) throw error;
        setErrors(error.response.data.errors);
    });
  };

  const resendEmailVerification = ({ setStatus }) => {
    csrf();
    axios.post("/email/verification-notification")
      .then(response => setStatus(response.data.status));
  };

  useEffect(() => {
    if (middleware === "guest" && redirectIfAuthenticated && user) router.push(redirectIfAuthenticated);
    if (middleware === "auth" && (user && !user.email_verified_at) && window.location.pathname.indexOf("verify-email") === -1) router.push("/verify-email");
    if (window.location.pathname === "/verify-email" && user?.email_verified_at) router.push(redirectIfAuthenticated);
  }, [user, error]);

  return {
    user,
    register,
    login,
    forgotPassword,
    resetPassword,
    resendEmailVerification,
    confirm
  };
};