<?php

namespace App\Services;

use App\Models\Messages;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class MessagesService
{
    public function getPaginatedMessages(int $perPage = 10): LengthAwarePaginator
    {
        return Messages::query()
            ->latest()
            ->paginate($perPage);
    }

    public function createMessage(array $data): Messages
    {
        return Messages::create($data);
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
