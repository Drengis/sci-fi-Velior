export interface SkillDto {
  id: number;
  name: string;
  slug: string;
  ability: string;
  is_proficient: boolean;
  is_expert: boolean;
  value: number;
}

export interface CharacterDto {
  id: number;
  name: string;
  class: string | null;
  race: string | null;
  background: string | null;
  traits: string | null;
  ideals: string | null;
  attachments: string | null;
  weaknesses: string | null;

  strength: number;
  dexterity: number;
  constitution: number;
  intelligence: number;
  wisdom: number;
  charisma: number;

  proficiency_bonus: number;

  calculated_skills: SkillDto[];

  skills?: any[];
}