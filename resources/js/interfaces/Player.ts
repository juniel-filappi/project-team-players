import { PLAYER_LEVELS_MAP } from "@/variables/PlayerVariables";

export interface Player {
    id: number;
    name: string;
    level: keyof typeof PLAYER_LEVELS_MAP;
    is_goalkeeper: boolean;
    confirmed: boolean;
    created_at: string;
    updated_at: string;
}
