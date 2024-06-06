<?php

namespace App\Http\Controllers\Players;

use App\Http\Controllers\Controller;
use App\Services\Player\PlayerService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class DeletePlayerController extends Controller
{
    public function __construct(
        private readonly PlayerService $service
    ){
    }

    public function __invoke(int $id): RedirectResponse
    {
        try {
            $this->service->deletePlayer($id);

            return Redirect::back()->with('message', 'Player deleted successfully');
        } catch (Exception $e) {
            return Redirect::back()->with('message', 'An error occurred while deleting the player');
        }
    }
}
