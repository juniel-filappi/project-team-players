<?php

namespace App\Http\Controllers\Players;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlayerSortRequest;
use App\Services\Player\PlayerService;
use Exception;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class SortPlayerController extends Controller
{
    public function __construct(
        private readonly PlayerService $service
    ){
    }

    public function __invoke(PlayerSortRequest $request)
    {
        try {
            $userId = $request->user()->id;
            $numPlayersPerTeam = $request->input('num_players_per_team');
            $teams = $this->service->sort($userId, $numPlayersPerTeam);

            return Inertia::render('Players/Team', [
                'teams' => $teams,
            ]);
        } catch (Exception $e) {
            return Redirect::back()->with('message', $e->getMessage());
        }
    }
}
