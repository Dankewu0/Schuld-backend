<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        $userId = $this->route('user') ?? $this->route('id');

        return [
            'name' => [$isCreating ? 'required' : 'sometimes', 'string', 'max:255'],
            'email' => [
                $isCreating ? 'required' : 'sometimes',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($userId),
            ],
            'password' => [$isCreating ? 'required' : 'sometimes', 'string', 'min:8'],
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
            'name.required' => 'Имя обязательно.',
            'name.string' => 'Имя должно быть строкой.',
            'name.max' => 'Имя не должно превышать 255 символов.',
            'email.required' => 'Email обязателен.',
            'email.email' => 'Email должен быть корректным адресом.',
            'email.max' => 'Email не должен превышать 255 символов.',
            'email.unique' => 'Такой email уже занят.',
            'password.required' => 'Пароль обязателен.',
            'password.string' => 'Пароль должен быть строкой.',
            'password.min' => 'Пароль должен быть не короче 8 символов.',
        ];
    }
}
