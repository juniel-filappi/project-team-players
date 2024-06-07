<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class DrawPlayer extends Model
{
    use HasFactory;

    protected $table = 'draw_player';
    protected $fillable = [
        'draw_id',
        'player_id',
        'team_id'
    ];

    public function draw(): BelongsToMany
    {
        return $this->belongsToMany(Draw::class);
    }

    public function player(): BelongsToMany
    {
        return $this->belongsToMany(Player::class);
    }

    public function team(): BelongsToMany
    {
        return $this->belongsToMany(Team::class);
    }
}
