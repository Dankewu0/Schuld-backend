<?php

namespace App\Http\Controllers;

use App\Http\Requests\CentrifugoTokenRequest;
use App\Services\CentrifugoService;
use App\Services\ChatMembersService;
use Illuminate\Http\JsonResponse;

class CentrifugoController extends Controller
{
    public function __construct(
        protected CentrifugoService $centrifugo,
        protected ChatMembersService $chatMembers,
    ) {}

    public function token(CentrifugoTokenRequest $request): JsonResponse
    {
        $userId = $request->user()->id;
        $chatId = $request->integer('chat_id');

        if (! $this->chatMembers->isUserInChat($chatId, $userId)) {
            return response()->json([
                'message' => 'Нет доступа к этому чату.',
            ], 403);
        }

        $channel = 'chat.'.$chatId;
        $token = $this->centrifugo->generateSubscriptionToken($userId, $channel);
        $connectToken = $this->centrifugo->generateConnectionToken($userId);

        return response()->json([
            'channel' => $channel,
            'token' => $token,
            'connect_token' => $connectToken,
        ], 200);
    }
}
