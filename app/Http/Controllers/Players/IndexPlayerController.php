<?php

namespace App\Http\Controllers\Players;

use App\Http\Controllers\Controller;
use App\Services\Player\PlayerService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class IndexPlayerController extends Controller
{
    public function __construct(
        private readonly PlayerService $service
    ){
    }

    public function __invoke(Request $request): Response
    {
        $players = $this->service->listPlayers($request->user()->id);

        return Inertia::render('Players/Index', [
            'players' => $players,
        ]);
    }
}
