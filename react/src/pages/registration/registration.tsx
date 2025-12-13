import styles from "./registration.module.css";

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

export default function Registration() {
  return (
    <div className={styles.registration}>
      <Card className={styles.card}>
        <CardHeader>
          <CardTitle>Регистрация</CardTitle>
          <CardDescription>
            Создайте аккаунт, чтобы начать использовать сервис
          </CardDescription>
        </CardHeader>

        <CardContent className={styles.content}>
          <div className={styles.field}>
            <Label htmlFor="name">Имя</Label>
            <Input id="name" type="text" placeholder="Ваше имя" />
          </div>

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

          <div className={styles.field}>
            <Label htmlFor="confirmPassword">Подтвердите пароль</Label>
            <Input
              id="confirmPassword"
              type="password"
              placeholder="••••••••"
            />
          </div>
        </CardContent>

        <CardFooter className={styles.footer}>
          <Button className={styles.submit}>
            Зарегистрироваться
          </Button>
        </CardFooter>
      </Card>
    </div>
  );
}