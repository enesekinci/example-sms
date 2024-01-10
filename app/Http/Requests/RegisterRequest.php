<?php

namespace App\Http\Requests;

use App\Enums\ResponseMessage;
use App\Traits\ValidationHandlerTrait;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    use ValidationHandlerTrait;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:20',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => ResponseMessage::REQUIRED,
            'email.email' => ResponseMessage::INVALID,
            'email.unique' => ResponseMessage::ALREADY_TAKEN,
            'password.required' => ResponseMessage::REQUIRED,
            'password.min' => ResponseMessage::MIN,
            'password.max' => ResponseMessage::TOO_LONG,
        ];
    }
}
