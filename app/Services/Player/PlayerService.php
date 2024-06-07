<?php

namespace App\Services\Player;

use App\Models\Draw;
use App\Models\DrawPlayer;
use App\Models\Player;
use App\Models\Team;
use App\Repositories\PlayerRepository;
use App\Services\Player\Data\PlayerData;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

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
        DB::beginTransaction();

        try {
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
                $teams[$i]->goalkeeper_assigned = false;
            }

            $teamIndex = 0;
            foreach ($goalkeepers as $goalkeeper) {
                if ($teams[$teamIndex]->has_goalkeeper) {
                    $teamIndex = ($teamIndex + 1) % $totalTeams;

                    continue;
                }

                DrawPlayer::create([
                    'draw_id' => $draw->id,
                    'team_id' => $teams[$teamIndex]->id,
                    'player_id' => $goalkeeper->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $teams[$teamIndex]->has_goalkeeper = true;
                $teamIndex = ($teamIndex + 1) % $totalTeams;
            }

            foreach ($fieldPlayers as $player) {
                // Adiciona o jogador ao time
                if ($teams[$teamIndex]->players()->count() < $numPlayersPerTeam) {
                    DrawPlayer::create([
                        'draw_id' => $draw->id,
                        'team_id' => $teams[$teamIndex]->id,
                        'player_id' => $player->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                $teamIndex = ($teamIndex + 1) % $totalTeams;
            }

            // Balancear níveis dos jogadores
            foreach ($teams as $team) {
                $team->players = $team->players()->orderBy('level', 'desc')->get();
            }

            DB::commit();

            return $teams;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
