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
class Draw extends Model
{
    use HasFactory;

    protected $fillable = [];

    public function teams(): HasMany
    {
        return $this->hasMany(Team::class);
    }

    public function players(): BelongsToMany
    {
        return $this->belongsToMany(Player::class, 'draw_player')
            ->withPivot('team_id')
            ->withTimestamps();
    }
}
