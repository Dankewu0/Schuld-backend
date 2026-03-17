<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chats extends Model
{
    public function chatMembers(): HasMany
    {
        return $this->hasMany(Chat_Members::class, 'chat_id');
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Messages::class, 'chat_id');
    }
}
