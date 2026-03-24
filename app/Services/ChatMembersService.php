<?php

namespace App\Services;

use App\Models\Chat_Members;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ChatMembersService
{
    public function getPaginatedChatMembers(int $perPage = 10): LengthAwarePaginator
    {
        return Chat_Members::query()
            ->latest()
            ->paginate($perPage);
    }

    public function isUserInChat(int $chatId, int $userId): bool
    {
        return Chat_Members::query()
            ->where('chat_id', $chatId)
            ->where('user_id', $userId)
            ->exists();
    }

    public function createChatMember(array $data): Chat_Members
    {
        return Chat_Members::create($data);
    }

    public function updateChatMember(Chat_Members $chatMember, array $data): Chat_Members
    {
        $chatMember->update($data);

        return $chatMember;
    }

    public function deleteChatMember(Chat_Members $chatMember): bool
    {
        return $chatMember->delete();
    }
}
