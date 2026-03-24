<?php

namespace App\Services;

use App\Models\Chat_Members;
use App\Models\Chats;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Validation\ValidationException;

class ChatsService
{
    public function getPaginatedChats(int $userId, int $perPage = 10): LengthAwarePaginator
    {
        return Chats::query()
            ->whereHas('chatMembers', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->latest()
            ->paginate($perPage);
    }

    public function createChat(int $userId, int $otherUserId): Chats
    {
        if ($userId === $otherUserId) {
            throw ValidationException::withMessages([
                'other_user_id' => 'Нельзя создать чат с самим собой.',
            ]);
        }

        $existingChat = Chats::query()
            ->where('type', 'direct')
            ->whereHas('chatMembers', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->whereHas('chatMembers', function ($query) use ($otherUserId) {
                $query->where('user_id', $otherUserId);
            })
            ->first();

        if ($existingChat instanceof Chats) {
            return $existingChat;
        }

        $chat = Chats::create([
            'type' => 'direct',
            'created_by' => $userId,
        ]);

        Chat_Members::query()->create([
            'chat_id' => $chat->id,
            'user_id' => $userId,
        ]);

        Chat_Members::query()->create([
            'chat_id' => $chat->id,
            'user_id' => $otherUserId,
        ]);

        return $chat;
    }

    public function updateChat(Chats $chat, array $data): Chats
    {
        $chat->update($data);

        return $chat;
    }

    public function deleteChat(Chats $chat): bool
    {
        return $chat->delete();
    }
}
