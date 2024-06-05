<?php

namespace App\Http\Requests;

use App\Enum\PlayerLevelEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class CreatePlayerRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255'
            ],
            'level' => [
                'required',
                'integer',
                new Enum(PlayerLevelEnum::class)
            ],
            'is_goalkeeper' => [
                'required',
                'boolean'
            ],
            'confirmed' => [
                'required',
                'boolean'
            ],
        ];
    }
}
