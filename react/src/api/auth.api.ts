import axiosClient from "./base_api";
import type { LoginRequest, LoginResponse, RegisterRequest, RegisterResponse } from "../dto/auth.dto";

export const authApi = {
  login: async (data: LoginRequest): Promise<LoginResponse> => {
    const response = await axiosClient.post<LoginResponse>("/auth/login", data);
    return response.data;
  },

  register: async (data: RegisterRequest): Promise<RegisterResponse> => {
    const response = await axiosClient.post<RegisterResponse>("/auth/register", data);
    return response.data;
  },
};
