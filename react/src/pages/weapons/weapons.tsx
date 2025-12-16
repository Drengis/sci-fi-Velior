import { useEffect, useState } from "react";
import styles from "./weaapons.module.css";

import {
  Table,
  TableBody,
  TableCaption,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from "@/components/ui/table";

const apiUrl = import.meta.env.VITE_API_URL;

interface MeleeWeapon {
  id: number;
  title: string;
  vs_MK1: string;
  vs_MK2: string;
  vs_MK3: string;
  vs_MK4: string;
}

interface RangeWeapon {
  id: number;
  title: string;
  armor_penetration: string;
  description: string;
}

export default function Weapons() {
  const [meleeWeapons, setMeleeWeapons] = useState<MeleeWeapon[]>([]);
  const [rangeWeapons, setRangeWeapons] = useState<RangeWeapon[]>([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    const loadWeapons = async () => {
      try {
        const [meleeRes, rangeRes] = await Promise.all([
          fetch(`${apiUrl}/static/melee-weapon`),
          fetch(`${apiUrl}/static/range-weapon`),
        ]);

        if (!meleeRes.ok || !rangeRes.ok) {
          throw new Error("Ошибка загрузки оружия");
        }

        const meleeData: MeleeWeapon[] = await meleeRes.json();
        const rangeData: RangeWeapon[] = await rangeRes.json();

        setMeleeWeapons(meleeData);
        setRangeWeapons(rangeData);
      } catch (err) {
        setError(err instanceof Error ? err.message : "Неизвестная ошибка");
      } finally {
        setLoading(false);
      }
    };

    loadWeapons();
  }, []);

  if (loading) return <p className={styles.loading}>Загрузка...</p>;
  if (error) return <p className={styles.error}>{error}</p>;

  return (
    <div className={styles.weapons}>
      <h1 className={styles.title}>Оружие</h1>

      {/* Melee Weapons Table */}
      <Table className={styles.table}>
        <TableCaption>Ближнее оружие</TableCaption>

        <TableHeader>
          <TableRow>
            <TableHead>Название</TableHead>
            <TableHead>vs MK1</TableHead>
            <TableHead>vs MK2</TableHead>
            <TableHead>vs MK3</TableHead>
            <TableHead>vs MK4</TableHead>
          </TableRow>
        </TableHeader>

        <TableBody>
          {meleeWeapons.map((w) => (
            <TableRow key={w.id}>
              <TableCell>{w.title}</TableCell>
              <TableCell>{w.vs_MK1}</TableCell>
              <TableCell>{w.vs_MK2}</TableCell>
              <TableCell>{w.vs_MK3}</TableCell>
              <TableCell>{w.vs_MK4}</TableCell>
            </TableRow>
          ))}
        </TableBody>
      </Table>

      {/* Range Weapons Table */}
      <Table className={styles.table} style={{ marginTop: "2rem" }}>
        <TableCaption>Дальнее оружие</TableCaption>

        <TableHeader>
          <TableRow>
            <TableHead>Название</TableHead>
            <TableHead>Проникновение брони</TableHead>
            <TableHead>Описание</TableHead>
          </TableRow>
        </TableHeader>

        <TableBody>
          {rangeWeapons.map((w) => (
            <TableRow key={w.id}>
              <TableCell>{w.title}</TableCell>
              <TableCell>{w.armor_penetration}</TableCell>
              <TableCell>{w.description}</TableCell>
            </TableRow>
          ))}
        </TableBody>
      </Table>
    </div>
  );
}