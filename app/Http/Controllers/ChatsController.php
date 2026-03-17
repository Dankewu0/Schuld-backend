<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChatsRequest;
use App\Services\ChatsService;
use App\Models\Chats;
use Illuminate\Http\JsonResponse;

class ChatsController extends Controller
{
    public function __construct(protected ChatsService $service) {}

    public function index(): JsonResponse
    {
        $chats = $this->service->getPaginatedChats();

        return response()->json($chats, 200);
    }

    public function create(): JsonResponse
    {
        return response()->json(null, 200);
    }

    public function store(ChatsRequest $request): JsonResponse
    {
        $chat = $this->service->createChat($request->validated());

        return response()->json($chat, 201);
    }

    public function show(Chats $chat): JsonResponse
    {
        return response()->json($chat, 200);
    }

    public function edit(Chats $chat): JsonResponse
    {
        return response()->json($chat, 200);
    }

    public function update(ChatsRequest $request, Chats $chat): JsonResponse
    {
        $updatedChat = $this->service->updateChat($chat, $request->validated());

        return response()->json($updatedChat, 200);
    }

    public function destroy(Chats $chat): JsonResponse
    {
        $this->service->deleteChat($chat);

        return response()->json(null, 204);
    }
}
