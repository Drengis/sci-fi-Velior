import { create } from "zustand";

interface User {
  // можешь расширить под бэкенд
  id?: string;
  email?: string;
  name?: string;
}

interface AuthState {
  token: string | null;
  user: User | null;
  isAuthenticated: boolean;

  login: (data: { token: string; user: User }) => void;
  logout: () => void;
}

export const useAuthStore = create<AuthState>((set) => ({
  token: null,
  user: null,
  isAuthenticated: false,

  login: ({ token, user }) =>
    set({
      token,
      user,
      isAuthenticated: true,
    }),

  logout: () =>
    set({
      token: null,
      user: null,
      isAuthenticated: false,
    }),
}));