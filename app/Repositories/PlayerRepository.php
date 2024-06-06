<?php

namespace App\Repositories;

use App\Models\Player;
use Illuminate\Database\Eloquent\Collection;

final class PlayerRepository
{
    private Player $model;

    public function __construct(Player $model)
    {
        $this->model = $model;
    }

    public function create(array $data): Player
    {
        return $this->model->newQuery()->create($data);
    }

    public function all(int $userId): Collection
    {
        return $this->model->newQuery()
            ->where('user_id', '=', $userId)
            ->get();
    }

    public function find(int $id): Player
    {
        return $this->model->newQuery()->findOrFail($id);
    }

    public function update(array $data, int $id): Player
    {
        $player = $this->find($id);
        $player->update($data);

        return $player;
    }

    public function delete(int $id): void
    {
        $this->find($id)->delete();
    }
}
