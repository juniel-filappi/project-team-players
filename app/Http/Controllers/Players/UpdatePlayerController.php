<?php

namespace App\Http\Controllers\Players;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlayerRequest;
use App\Services\Player\Data\PlayerData;
use App\Services\Player\PlayerService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class UpdatePlayerController extends Controller
{
    public function __construct(
        private readonly PlayerService $service
    ){
    }

    public function view(int $id): Response
    {
        $player = $this->service->findPlayer($id);

        return Inertia::render('Players/Edit', [
            'player' => $player
        ]);
    }

    public function update(int $id, PlayerRequest $request): RedirectResponse
    {
        try {
            $this->service->updatePlayer(PlayerData::fromRequest($request), $id);

            return Redirect::route('players.index');
        } catch (Exception $e) {
            return Redirect::back()->with('message', 'An error occurred while creating the player');
        }
    }
}
