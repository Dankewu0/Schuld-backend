<?php

namespace App\Services;

use App\Models\Messages;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Validation\ValidationException;

class MessagesService
{
    public function __construct(
        protected CentrifugoService $centrifugo,
        protected ChatMembersService $chatMembers,
    ) {}

    public function getPaginatedMessages(int $perPage = 10): LengthAwarePaginator
    {
        return Messages::query()
            ->latest()
            ->paginate($perPage);
    }

    public function getPaginatedMessagesByChat(int $chatId, int $perPage = 10): LengthAwarePaginator
    {
        return Messages::query()
            ->where('chat_id', $chatId)
            ->latest()
            ->paginate($perPage);
    }

    public function createMessage(array $data): Messages
    {
        $chatId = (int) $data['chat_id'];
        $senderId = (int) $data['sender_id'];

        if (! $this->chatMembers->isUserInChat($chatId, $senderId)) {
            throw ValidationException::withMessages([
                'chat_id' => 'Пользователь не состоит в этом чате.',
            ]);
        }

        $message = Messages::create($data);

        $this->centrifugo->publish('chat.'.$chatId, [
            'id' => $message->id,
            'chat_id' => $message->chat_id,
            'sender_id' => $message->sender_id,
            'content' => $message->content,
            'status' => $message->status,
            'created_at' => $message->created_at?->toISOString(),
        ]);

        return $message;
    }

    public function updateMessage(Messages $message, array $data): Messages
    {
        $message->update($data);

        return $message;
    }

    public function deleteMessage(Messages $message): bool
    {
        return $message->delete();
    }
}
