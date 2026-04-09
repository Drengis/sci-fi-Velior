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

import { staticApi } from "../../api/static.api";
import type { ArmorDto } from "../../dto/static.dto";

export default function Armor() {
  const [armors, setArmors] = useState<ArmorDto[]>([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    const loadArmors = async () => {
      try {
        const data = await staticApi.getArmors();
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
            {/* <TableHead>Действие</TableHead> */}
          </TableRow>
        </TableHeader>

        <TableBody>
          {armors.map((armor) => (
            <TableRow key={armor.id}>
              <TableCell>{armor.name}</TableCell>
              <TableCell>{armor.description}</TableCell>
              <TableCell>{armor.upgrade_slots}</TableCell>
              {/* <TableCell>
                <Button variant="outline" size="sm">
                  Подробнее
                </Button>
              </TableCell> */}
            </TableRow>
          ))}
        </TableBody>
      </Table>
    </div>
  );
}