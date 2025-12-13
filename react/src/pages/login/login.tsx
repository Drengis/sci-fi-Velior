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

export default function Login() {
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
            />
          </div>

          <div className={styles.field}>
            <Label htmlFor="password">Пароль</Label>
            <Input
              id="password"
              type="password"
              placeholder="••••••••"
            />
          </div>
        </CardContent>

        <CardFooter className={styles.footer}>
          <Button className={styles.submit}>
            Войти
          </Button>
        </CardFooter>
      </Card>
    </div>
  );
}