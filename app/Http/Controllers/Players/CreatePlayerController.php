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

class CreatePlayerController extends Controller
{
    public function __construct(
        private readonly PlayerService $service
    ){
    }

    public function view(Request $request): Response
    {
        return Inertia::render('Players/Create');
    }

    public function store(PlayerRequest $request): RedirectResponse
    {
        try {
            $this->service->create(PlayerData::fromRequest($request));

            return Redirect::route('players.index');
        } catch (Exception $e) {
            return Redirect::back()->with('message', $e->getMessage());
        }
    }
}
