<?php

namespace App\Http\Requests;

use App\Enums\ResponseMessage as RM;
use App\Traits\ValidationHandlerTrait;
use Illuminate\Foundation\Http\FormRequest;

class RefreshTokenRequest extends FormRequest
{
    use ValidationHandlerTrait;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => RM::REQUIRED,
            'email.email' => RM::EMAIL,
            'email.exists' => RM::NOT_EXISTS,

            'password.required' => RM::REQUIRED,
            'password.min' => RM::LENGTH,
        ];
    }
}
