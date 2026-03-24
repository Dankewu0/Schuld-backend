<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chat_Members extends Model
{
    protected $table = 'chat_members';

    protected $fillable = ['chat_id', 'user_id', 'joined_at'];

    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chats::class, 'chat_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
