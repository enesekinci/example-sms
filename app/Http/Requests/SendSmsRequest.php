<?php

namespace App\Http\Requests;

use App\Enums\ResponseMessage;
use App\Traits\ValidationHandlerTrait;
use Illuminate\Foundation\Http\FormRequest;

class SendSmsRequest extends FormRequest
{
    use ValidationHandlerTrait;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'message' => 'required|string',
            'number' => 'required|string|regex:/^5[0-9]{9}$/',
            'sender' => 'required|string|max:11',
            'send_date' => 'required|date_format:Y-m-d H:i:s',
        ];
    }

    public function messages(): array
    {
        return [
            'message.required' => ResponseMessage::REQUIRED,
            'message.string' => ResponseMessage::STRING,

            'number.required' => ResponseMessage::REQUIRED,
            'number.string' => ResponseMessage::STRING,
            'number.regex' => ResponseMessage::INVALID,

            'sender.required' => ResponseMessage::REQUIRED,
            'sender.string' => ResponseMessage::STRING,
            'sender.max' => ResponseMessage::MAX,

            'send_date.required' => ResponseMessage::REQUIRED,
            'send_date.date_format' => ResponseMessage::DATE_FORMAT,
        ];
    }
}
