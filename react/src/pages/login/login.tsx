/* eslint-disable @typescript-eslint/no-explicit-any */
import { useState } from "react";
import styles from "./login.module.css";

import {
  Card,
  CardHeader,
  CardTitle,
  CardDescription,
  CardContent,
  CardFooter,
} from "@/components/ui/card";

import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";

import { useAuthStore } from "../../store/authStore";

const apiUrl = import.meta.env.VITE_API_URL;

export default function Login() {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState<string | null>(null);

  const login = useAuthStore((state) => state.login);

  const handleLogin = async () => {
    setError(null);

    if (!email || !password) {
      setError("Введите email и пароль");
      return;
    }

    try {
      setLoading(true);

      const response = await fetch(`${apiUrl}/auth/login`, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          email,
          password,
        }),
      });

      if (!response.ok) {
        const data = await response.json();
        throw new Error(data.message || "Ошибка авторизации");
      }

      const data: {
        message: string;
        user: any;
        token: string;
      } = await response.json();

      login({
        token: data.token,
        user: data.user,
      });

      // TODO: редирект на dashboard
    } catch (err) {
      setError(err instanceof Error ? err.message : "Неизвестная ошибка");
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className={styles.login}>
      <Card className={styles.card}>
        <CardHeader>
          <CardTitle>Вход</CardTitle>
          <CardDescription>
            Введите логин и пароль для входа
          </CardDescription>
        </CardHeader>

        <CardContent className={styles.content}>
          <div className={styles.field}>
            <Label htmlFor="email">Email</Label>
            <Input
              id="email"
              type="email"
              placeholder="you@example.com"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
            />
          </div>

          <div className={styles.field}>
            <Label htmlFor="password">Пароль</Label>
            <Input
              id="password"
              type="password"
              placeholder="••••••••"
              value={password}
              onChange={(e) => setPassword(e.target.value)}
            />
          </div>

          {error && (
            <p className={styles.error}>
              {error}
            </p>
          )}
        </CardContent>

        <CardFooter className={styles.footer}>
          <Button
            className={styles.submit}
            onClick={handleLogin}
            disabled={loading}
          >
            {loading ? "Вход..." : "Войти"}
          </Button>
        </CardFooter>
      </Card>
    </div>
  );
}