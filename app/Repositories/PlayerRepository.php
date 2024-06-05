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

    public function create(array $data): void
    {
        // Create a new player
    }

    public function all(int $userId): Collection
    {
        return $this->model->newQuery()
            ->where('user_id', '=', $userId)
            ->get();
    }
}
