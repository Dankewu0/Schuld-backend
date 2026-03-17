<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class MessagesRequest extends FormRequest
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
            'sender_id' => [$isCreating ? 'required' : 'sometimes', 'integer', 'exists:users,id'],
            'content' => [$isCreating ? 'required' : 'sometimes', 'string', 'min:1'],
            'status' => [$isCreating ? 'required' : 'sometimes', 'string', 'max:255'],
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
            'chat_id.required' => 'Чат обязателен.',
            'chat_id.integer' => 'Чат должен быть числом.',
            'chat_id.exists' => 'Указанный чат не найден.',
            'sender_id.required' => 'Отправитель обязателен.',
            'sender_id.integer' => 'Отправитель должен быть числом.',
            'sender_id.exists' => 'Указанный отправитель не найден.',
            'content.required' => 'Текст сообщения обязателен.',
            'content.string' => 'Текст сообщения должен быть строкой.',
            'content.min' => 'Текст сообщения не может быть пустым.',
            'status.required' => 'Статус обязателен.',
            'status.string' => 'Статус должен быть строкой.',
            'status.max' => 'Статус не должен превышать 255 символов.',
        ];
    }
}
