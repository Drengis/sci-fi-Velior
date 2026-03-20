import axiosClient from "./base_api";
import type { LoginRequest, LoginResponse, RegisterRequest, RegisterResponse } from "../dto/auth.dto";

export const authApi = {
  login: async (data: LoginRequest): Promise<LoginResponse> => {
    const response = await axiosClient.post<{ data: LoginResponse }>("/auth/login", data);
    return response.data.data;
  },

  register: async (data: RegisterRequest): Promise<RegisterResponse> => {
    const response = await axiosClient.post<{ data: RegisterResponse }>("/auth/register", data);
    return response.data.data;
  },
};
