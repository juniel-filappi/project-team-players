import { IPlayer } from "@/interfaces/IPlayer";

export interface ITeam {
    id: number;
    name: string;
    players: IPlayer[];
}
