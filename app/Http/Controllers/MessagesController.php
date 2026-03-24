<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessagesRequest;
use App\Models\Messages;
use App\Services\ChatMembersService;
use App\Services\MessagesService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function __construct(
        protected MessagesService $service,
        protected ChatMembersService $chatMembers,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $chatId = $request->integer('chat_id');

        if ($chatId === 0) {
            return response()->json(['message' => 'chat_id обязателен.'], 422);
        }

        if (! $this->chatMembers->isUserInChat($chatId, $request->user()->id)) {
            return response()->json(['message' => 'Нет доступа к этому чату.'], 403);
        }

        $messages = $this->service->getPaginatedMessagesByChat($chatId);

        return response()->json($messages, 200);
    }

    public function create(): JsonResponse
    {
        return response()->json(null, 200);
    }

    public function store(MessagesRequest $request): JsonResponse
    {
        $message = $this->service->createMessage([
            ...$request->validated(),
            'sender_id' => $request->user()->id,
            'status' => $request->string('status')->toString() ?: 'sent',
        ]);

        return response()->json($message, 201);
    }

    public function show(Messages $message): JsonResponse
    {
        if (! $this->chatMembers->isUserInChat($message->chat_id, request()->user()->id)) {
            return response()->json(['message' => 'Нет доступа к этому чату.'], 403);
        }

        return response()->json($message, 200);
    }

    public function edit(Messages $message): JsonResponse
    {
        if (! $this->chatMembers->isUserInChat($message->chat_id, request()->user()->id)) {
            return response()->json(['message' => 'Нет доступа к этому чату.'], 403);
        }

        return response()->json($message, 200);
    }

    public function update(MessagesRequest $request, Messages $message): JsonResponse
    {
        if (! $this->chatMembers->isUserInChat($message->chat_id, $request->user()->id)) {
            return response()->json(['message' => 'Нет доступа к этому чату.'], 403);
        }

        $updatedMessage = $this->service->updateMessage(
            $message,
            $request->validated(),
        );

        return response()->json($updatedMessage, 200);
    }

    public function destroy(Messages $message): JsonResponse
    {
        if (! $this->chatMembers->isUserInChat($message->chat_id, request()->user()->id)) {
            return response()->json(['message' => 'Нет доступа к этому чату.'], 403);
        }

        $this->service->deleteMessage($message);

        return response()->json(null, 204);
    }
}
