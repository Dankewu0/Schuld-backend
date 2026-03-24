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

        if ($isCreating) {
            return [
                'chat_id' => ['required', 'integer', 'exists:chats,id'],
                'content' => ['required', 'string', 'min:1'],
                'status' => ['sometimes', 'string', 'max:255'],
            ];
        }

        return [
            'content' => ['sometimes', 'string', 'min:1'],
            'status' => ['sometimes', 'string', 'max:255'],
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
            'content.required' => 'Текст сообщения обязателен.',
            'content.string' => 'Текст сообщения должен быть строкой.',
            'content.min' => 'Текст сообщения не может быть пустым.',
            'status.string' => 'Статус должен быть строкой.',
            'status.max' => 'Статус не должен превышать 255 символов.',
        ];
    }
}
