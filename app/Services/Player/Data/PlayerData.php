<?php

namespace App\Services\Player\Data;

use App\Enum\PlayerLevelEnum;
use Illuminate\Foundation\Http\FormRequest;

class PlayerData
{
    public function __construct(
        public string $name,
        public int $userId,
        public PlayerLevelEnum $level,
        public bool $isGoalkeeper,
        public bool $confirmed
    ) {
    }

    public static function fromRequest(FormRequest $request): self
    {
        $validated = $request->validated();

        return new self(
            name: $validated['name'],
            userId: $request->user()->id,
            level: PlayerLevelEnum::getLevelByValue($validated['level']),
            isGoalkeeper: $validated['is_goalkeeper'],
            confirmed: $validated['confirmed']
        );
    }
}
