import styles from "./characters.module.css";

import {
  Card,
  CardHeader,
  CardTitle,
  CardContent,
  CardFooter,
} from "@/components/ui/card";

import { Button } from "@/components/ui/button";
import { NavLink } from "react-router-dom";

// Пример данных (потом можно заменить на API)
const characters = [
  { id: 1, name: "Воин", description: "Сильный и выносливый боец" },
  { id: 2, name: "Лучник", description: "Мастер дальнего боя" },
  { id: 3, name: "Маг", description: "Использует магию стихий" },
];

export default function Characters() {
  return (
    <div className={styles.characters}>
      <h1 className={styles.title}>Персонажи</h1>
      <div className={styles.grid}>
        {characters.map((char) => (
          <Card key={char.id} className={styles.card}>
            <CardHeader>
              <CardTitle>{char.name}</CardTitle>
            </CardHeader>
            <CardContent>
              {char.description}
            </CardContent>
            <CardFooter>
              <NavLink to={"/characters/skilltree"}>
                <Button variant="outline">Подробнее</Button>
              </NavLink>
            </CardFooter>
          </Card>
        ))}
      </div>
    </div>
  );
}