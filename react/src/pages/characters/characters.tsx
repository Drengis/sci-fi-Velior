import { useState, useEffect } from "react";
import styles from "./characters.module.css";
import { charactersApi } from "../../api/characters_api";
import { useAuthStore } from "../../store/authStore";
import type { CharacterDto } from "../../dto/characters.dto";
import {
  Card,
  CardHeader,
  CardTitle,
  CardContent,
  CardFooter,
} from "@/components/ui/card";
import { Button } from "@/components/ui/button";
import { NavLink } from "react-router-dom";

export default function Characters() {
  const [characters, setCharacters] = useState<CharacterDto[]>([]);
  const user = useAuthStore((state) => state.user);

  useEffect(() => {
    if (user?.id) {
      charactersApi.getCharacters(user.id).then((data) => {
        setCharacters(data);
      });
    }
  }, [user?.id]);

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
              {char.class}<br />
              {char.race}
            </CardContent>
            <CardFooter>
              <Button>
                <NavLink to={`/characters/${char.id}`}>Перейти</NavLink>
              </Button>
            </CardFooter>
          </Card>
        ))}
      </div>
    </div>
  );
}