import axiosClient from "./base_api";
import type { MeleeWeaponDto, RangeWeaponDto, ArmorDto } from "../dto/static.dto";

export const staticApi = {
  getMeleeWeapons: async (): Promise<MeleeWeaponDto[]> => {
    const response = await axiosClient.get<MeleeWeaponDto[]>("/static/melee-weapon");
    return response.data;
  },

  getRangeWeapons: async (): Promise<RangeWeaponDto[]> => {
    const response = await axiosClient.get<RangeWeaponDto[]>("/static/range-weapon");
    return response.data;
  },

  getArmors: async (): Promise<ArmorDto[]> => {
    const response = await axiosClient.get<ArmorDto[]>("/static/armor");
    return response.data;
  },
};
