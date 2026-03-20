import axiosClient from "./base_api";
import type { CharacterDto } from "../dto/characters.dto";

export const charactersApi = {
    getCharacters: async (user_id: string): Promise<CharacterDto[]> => {
        const response = await axiosClient.get<{ data: CharacterDto[] }>(`users/${user_id}/characters`);
        return response.data.data;
    },

    getCharacter: async (id: string): Promise<CharacterDto> => {
        const response = await axiosClient.get<{ data: CharacterDto }>(`characters/${id}?with=user`);
        return response.data.data;
    },
};
