import { useEffect, useState } from "react";
import styles from "./armor.module.css";

import {
  Table,
  TableBody,
  TableCaption,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from "@/components/ui/table";

import { Button } from "@/components/ui/button";

const apiUrl = import.meta.env.VITE_API_URL;

interface ArmorDto {
  id: number;
  name: string;
  "upgrade slots": number;
  descripsion: string;
}

export default function Armor() {
  const [armors, setArmors] = useState<ArmorDto[]>([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    const loadArmors = async () => {
      try {
        const response = await fetch(`${apiUrl}/static/armor`);
        if (!response.ok) throw new Error("Ошибка загрузки брони");
        const data: ArmorDto[] = await response.json();
        setArmors(data);
      } catch (err) {
        setError(err instanceof Error ? err.message : "Неизвестная ошибка");
      } finally {
        setLoading(false);
      }
    };
    loadArmors();
  }, []);

  if (loading) return <p className={styles.loading}>Загрузка...</p>;
  if (error) return <p className={styles.error}>{error}</p>;

  return (
    <div className={styles.armor}>
      <h1 className={styles.title}>Броня</h1>

      <Table>
        <TableCaption>Список брони</TableCaption>

        <TableHeader>
          <TableRow>
            <TableHead>Название</TableHead>
            <TableHead>Описание</TableHead>
            <TableHead>Слоты улучшений</TableHead>
            <TableHead>Действие</TableHead>
          </TableRow>
        </TableHeader>

        <TableBody>
          {armors.map((armor) => (
            <TableRow key={armor.id}>
              <TableCell>{armor.name}</TableCell>
              <TableCell>{armor.descripsion}</TableCell>
              <TableCell>{armor["upgrade slots"]}</TableCell>
              <TableCell>
                <Button variant="outline" size="sm">
                  Подробнее
                </Button>
              </TableCell>
            </TableRow>
          ))}
        </TableBody>
      </Table>
    </div>
  );
}