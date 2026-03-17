<?php

namespace App\Services;

use App\Models\Chats;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ChatsService
{
    public function getPaginatedChats(int $perPage = 10): LengthAwarePaginator
    {
        return Chats::query()
            ->latest()
            ->paginate($perPage);
    }

    public function createChat(array $data): Chats
    {
        return Chats::create($data);
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
