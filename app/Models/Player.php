<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property string $name
 * @property int $level
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
        'is_goalkeeper',
        'confirmed',
    ];

    protected $casts = [
        'is_goalkeeper' => 'boolean',
        'confirmed' => 'boolean',
    ];

    public function draws(): BelongsToMany
    {
        return $this->belongsToMany(Draw::class, 'draw_player')
            ->withPivot('team_id')
            ->withTimestamps();
    }
}
