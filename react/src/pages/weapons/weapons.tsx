import styles from "./weaapons.module.css";

import {
  Card,
  CardHeader,
  CardTitle,
  CardContent,
  CardFooter,
} from "@/components/ui/card";

import { Button } from "@/components/ui/button";

// Пример данных (потом заменить на API)
const weapons = [
  { id: 1, name: "Меч", damage: 50, description: "Классическое оружие ближнего боя" },
  { id: 2, name: "Лук", damage: 30, description: "Дальний бой, высокая точность" },
  { id: 3, name: "Посох", damage: 40, description: "Магическое оружие, усиливает заклинания" },
];

export default function Weapons() {
  return (
    <div className={styles.weapons}>
      <h1 className={styles.title}>Оружие</h1>
      <div className={styles.grid}>
        {weapons.map((weapon) => (
          <Card key={weapon.id} className={styles.card}>
            <CardHeader>
              <CardTitle>{weapon.name}</CardTitle>
            </CardHeader>
            <CardContent>
              <p>{weapon.description}</p>
              <p>Урон: {weapon.damage}</p>
            </CardContent>
            <CardFooter>
              <Button variant="outline">Подробнее</Button>
            </CardFooter>
          </Card>
        ))}
      </div>
    </div>
  );
}