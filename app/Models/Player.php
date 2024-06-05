<?php

namespace App\Models;

use App\Enum\PlayerLevelEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property string $name
 * @property int $id
 * @property PlayerLevelEnum $level
 * @property int $user_id
 * @property bool $is_goalkeeper
 * @property bool $confirmed
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'level',
        'user_id',
        'is_goalkeeper',
        'confirmed',
    ];

    protected $casts = [
        'is_goalkeeper' => 'boolean',
        'confirmed' => 'boolean',
        'level' => PlayerLevelEnum::class,
    ];

    public function draws(): BelongsToMany
    {
        return $this->belongsToMany(Draw::class, 'draw_player')
            ->withPivot('team_id')
            ->withTimestamps();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
