<?php

namespace App\Http\Controllers\Players;

use App\Http\Controllers\Controller;
use App\Services\Player\PlayerService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class SortPlayerController extends Controller
{
    public function __construct(
        private readonly PlayerService $service
    ){
    }

    public function __invoke(Request $request)
    {
        try {
            $userId = $request->user()->id;
            $numPlayersPerTeam = $request->input('num_players_per_team');
            $teams = $this->service->sort($userId, $numPlayersPerTeam);

            return Inertia::render('Players/Sort', [
                'teams' => $teams,
            ]);
        } catch (Exception $e) {
            return Redirect::back()->with('error', $e->getMessage());
        }
    }
}
