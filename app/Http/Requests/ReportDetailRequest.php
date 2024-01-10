<?php

namespace App\Http\Requests;

use App\Traits\ValidationHandlerTrait;
use Illuminate\Foundation\Http\FormRequest;

class ReportDetailRequest extends FormRequest
{
    use ValidationHandlerTrait;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
        ];
    }

    public function messages(): array
    {
        return [
        ];
    }
}
