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

import { staticApi } from "../../api/static.api";
import type { MeleeWeaponDto, RangeWeaponDto } from "../../dto/static.dto";

export default function Weapons() {
  const [meleeWeapons, setMeleeWeapons] = useState<MeleeWeaponDto[]>([]);
  const [rangeWeapons, setRangeWeapons] = useState<RangeWeaponDto[]>([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    const loadWeapons = async () => {
      try {
        const [meleeData, rangeData] = await Promise.all([
          staticApi.getMeleeWeapons(),
          staticApi.getRangeWeapons(),
        ]);

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