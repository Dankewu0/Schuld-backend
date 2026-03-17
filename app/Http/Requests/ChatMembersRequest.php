<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ChatMembersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $isCreating = $this->isMethod('post');

        return [
            'chat_id' => [$isCreating ? 'required' : 'sometimes', 'integer', 'exists:chats,id'],
            'user_id' => [$isCreating ? 'required' : 'sometimes', 'integer', 'exists:users,id'],
            'joined_at' => [$isCreating ? 'nullable' : 'sometimes', 'date'],
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'chat_id.required' => 'Chat обязателен.',
            'chat_id.integer' => 'Chat должен быть числом.',
            'chat_id.exists' => 'Указанный чат не найден.',
            'user_id.required' => 'Участник обязателен.',
            'user_id.integer' => 'Участник должен быть числом.',
            'user_id.exists' => 'Указанный пользователь не найден.',
            'joined_at.date' => 'Дата вступления должна быть корректной датой.',
        ];
    }
}
