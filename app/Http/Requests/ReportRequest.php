<?php

namespace App\Http\Requests;

use App\Traits\ValidationHandlerTrait;
use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
{
    use ValidationHandlerTrait;


    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'date' => 'nullable|date_format:Y-m-d'
        ];
    }

    public function messages(): array
    {
        return [
        ];
    }
}
