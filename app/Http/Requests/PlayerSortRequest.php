<?php

namespace App\Http\Requests;

use App\Enum\PlayerLevelEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class PlayerSortRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'num_players_per_team' => [
                'required',
                'integer',
                'min:1',
            ],
        ];
    }
}
