<?php

namespace App\Services\Player;

use App\Models\Draw;
use App\Models\Player;
use App\Models\Team;
use App\Repositories\PlayerRepository;
use App\Services\Player\Data\PlayerData;
use Exception;
use Illuminate\Database\Eloquent\Collection;

final class PlayerService
{
    public function __construct(
        private readonly PlayerRepository $repository
    ){
    }

    public function listPlayers(int $userId): Collection
    {
        return $this->repository->all($userId);
    }

    public function create(PlayerData $data): Player
    {
        return $this->repository->create($data->toArray());
    }

    public function findPlayer(int $id): Player
    {
        return $this->repository->find($id);
    }

    public function updatePlayer(PlayerData $data, int $id): Player
    {
        return $this->repository->update($data->toArray(), $id);
    }

    public function deletePlayer(int $id): void
    {
        $this->repository->delete($id);
    }

    public function sort(int $userId, int $numPlayersPerTeam): array
    {
        $confirmedPlayers = Player::where('confirmed', '=', true)
            ->where('user_id', '=', $userId)
            ->get();

        if ($confirmedPlayers->count() < $numPlayersPerTeam * 2) {
            throw new Exception('Not enough players to sort');
        }

        $draw = Draw::create();

        $goalkeepers = $confirmedPlayers->where('is_goalkeeper', true);
        $fieldPlayers = $confirmedPlayers->where('is_goalkeeper', false);

        $teams = [];
        $totalTeams = floor($confirmedPlayers->count() / $numPlayersPerTeam);

        for ($i = 0; $i < $totalTeams; $i++) {
            $teams[$i] = Team::create(['draw_id' => $draw->id, 'name' => 'Team ' . ($i + 1)]);
        }

        $teamIndex = 0;
        foreach ($goalkeepers as $goalkeeper) {
            $teams[$teamIndex]->players()->attach($goalkeeper->id);
            $draw->players()->attach($goalkeeper->id, ['team_id' => $teams[$teamIndex]->id]);
            $teamIndex = ($teamIndex + 1) % $totalTeams;
        }

        foreach ($fieldPlayers as $player) {
            $teams[$teamIndex]->players()->attach($player->id);
            $draw->players()->attach($player->id, ['team_id' => $teams[$teamIndex]->id]);
            $teamIndex = ($teamIndex + 1) % $totalTeams;
        }

        // Balancear níveis dos jogadores (opcional)
        foreach ($teams as $team) {
            usort($team->players->toArray(), function ($a, $b) {
                return $b['level'] - $a['level'];
            });
        }

        return $teams;
    }
}
