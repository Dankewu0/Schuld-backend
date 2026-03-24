<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('chat__members') && ! Schema::hasTable('chat_members')) {
            Schema::rename('chat__members', 'chat_members');
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('chat_members') && ! Schema::hasTable('chat__members')) {
            Schema::rename('chat_members', 'chat__members');
        }
    }
};
