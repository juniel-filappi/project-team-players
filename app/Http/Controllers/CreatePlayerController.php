<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreatePlayerController extends Controller
{
    public function __construct(
        private readonly Response $response,
    ){
    }

    public function view(): JsonResponse
    {
        return $this->response->json([
            'message' => 'Player created successfully'
        ]);
    }
}
