<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChatsRequest;
use App\Models\Chats;
use App\Services\ChatMembersService;
use App\Services\ChatsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ChatsController extends Controller
{
    public function __construct(
        protected ChatsService $service,
        protected ChatMembersService $chatMembers,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $chats = $this->service->getPaginatedChats($request->user()->id);

        return response()->json($chats, 200);
    }

    public function create(): JsonResponse
    {
        return response()->json(null, 200);
    }

    public function store(ChatsRequest $request): JsonResponse
    {
        $chat = $this->service->createChat(
            $request->user()->id,
            $request->integer('other_user_id'),
        );

        return response()->json($chat, 201);
    }

    public function show(Chats $chat): JsonResponse
    {
        if (! $this->chatMembers->isUserInChat($chat->id, request()->user()->id)) {
            return response()->json(['message' => 'Нет доступа к этому чату.'], 403);
        }

        return response()->json($chat, 200);
    }

    public function edit(Chats $chat): JsonResponse
    {
        if (! $this->chatMembers->isUserInChat($chat->id, request()->user()->id)) {
            return response()->json(['message' => 'Нет доступа к этому чату.'], 403);
        }

        return response()->json($chat, 200);
    }

    public function update(ChatsRequest $request, Chats $chat): JsonResponse
    {
        if (! $this->chatMembers->isUserInChat($chat->id, $request->user()->id)) {
            return response()->json(['message' => 'Нет доступа к этому чату.'], 403);
        }

        $updatedChat = $this->service->updateChat($chat, $request->validated());

        return response()->json($updatedChat, 200);
    }

    public function destroy(Chats $chat): JsonResponse
    {
        if (! $this->chatMembers->isUserInChat($chat->id, request()->user()->id)) {
            return response()->json(['message' => 'Нет доступа к этому чату.'], 403);
        }

        $this->service->deleteChat($chat);

        return response()->json(null, 204);
    }
}
