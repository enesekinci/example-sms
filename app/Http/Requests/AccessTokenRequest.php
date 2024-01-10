<?php

namespace App\Http\Requests;

use App\Traits\ValidationHandlerTrait;
use Illuminate\Foundation\Http\FormRequest;

class AccessTokenRequest extends FormRequest
{
    use ValidationHandlerTrait;

    public function authorize(): bool
    {
        return false;
    }

    public function rules(): array
    {
        return [
            //
        ];
    }
}
