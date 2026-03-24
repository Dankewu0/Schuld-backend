<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChatMembersRequest;
use App\Models\Chat_Members;
use App\Services\ChatMembersService;
use Illuminate\Http\JsonResponse;

class ChatMembersController extends Controller
{
    public function __construct(protected ChatMembersService $service) {}

    public function index(): JsonResponse
    {
        $chatMembers = $this->service->getPaginatedChatMembers();

        return response()->json($chatMembers, 200);
    }

    public function create(): JsonResponse
    {
        return response()->json(null, 200);
    }

    public function store(ChatMembersRequest $request): JsonResponse
    {
        $chatMember = $this->service->createChatMember($request->validated());

        return response()->json($chatMember, 201);
    }

    public function show(Chat_Members $chatMember): JsonResponse
    {
        return response()->json($chatMember, 200);
    }

    public function edit(Chat_Members $chatMember): JsonResponse
    {
        return response()->json($chatMember, 200);
    }

    public function update(ChatMembersRequest $request, Chat_Members $chatMember): JsonResponse
    {
        $updatedChatMember = $this->service->updateChatMember($chatMember, $request->validated());

        return response()->json($updatedChatMember, 200);
    }

    public function destroy(Chat_Members $chatMember): JsonResponse
    {
        $this->service->deleteChatMember($chatMember);

        return response()->json(null, 204);
    }
}
