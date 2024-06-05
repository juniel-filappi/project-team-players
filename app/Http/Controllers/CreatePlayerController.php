<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePlayerRequest;
use App\Repositories\PlayerRepository;
use App\Services\Player\Data\PlayerData;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\Inertia;

class CreatePlayerController extends Controller
{
    public function __construct(
        private readonly PlayerRepository $repository
    ){
    }

    public function view(Request $request): Response
    {
        $players = $this->repository->all($request->user()->id);

        return Inertia::render('Players/Create', [
            'players' => $players,
        ]);
    }

    public function store(CreatePlayerRequest $request): void
    {
        $data = PlayerData::fromRequest($request);
        dd($data);
    }
}
