export interface MeleeWeaponDto {
  id: number;
  title: string;
  vs_MK1: string;
  vs_MK2: string;
  vs_MK3: string;
  vs_MK4: string;
}

export interface RangeWeaponDto {
  id: number;
  title: string;
  armor_penetration: string;
  description: string;
}

export interface ArmorDto {
  id: number;
  name: string;
  "upgrade slots": number;
  descripsion: string;
}