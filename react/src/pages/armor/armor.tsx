import styles from "./armor.module.css";

import {
  Card,
  CardHeader,
  CardTitle,
  CardContent,
  CardFooter,
} from "@/components/ui/card";

import { Button } from "@/components/ui/button";

// Пример данных (потом заменить на API)
const armors = [
  { id: 1, name: "Латная броня", defense: 50, description: "Классическая защита для воинов" },
  { id: 2, name: "Кожаная броня", defense: 25, description: "Легкая броня для ловких персонажей" },
  { id: 3, name: "Магический доспех", defense: 35, description: "Защита с магическим усилением" },
];

export default function Armor() {
  return (
    <div className={styles.armor}>
      <h1 className={styles.title}>Броня</h1>
      <div className={styles.grid}>
        {armors.map((armor) => (
          <Card key={armor.id} className={styles.card}>
            <CardHeader>
              <CardTitle>{armor.name}</CardTitle>
            </CardHeader>
            <CardContent>
              <p>{armor.description}</p>
              <p>Защита: {armor.defense}</p>
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