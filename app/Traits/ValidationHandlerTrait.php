<?php

namespace App\Traits;

use App\Enums\HttpCode;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

trait ValidationHandlerTrait
{
    /**
     * @param Validator $validator
     * @return mixed
     */
    public function failedValidation(Validator $validator): mixed
    {
        $errors = $validator->errors();

        //ResponseMessage içinden hata mesajı alınır ve kod ile birlikte döndürülür.
        $response = [];

        $messages = $errors->getMessageBag()->getMessages();

        foreach ($messages as $key => $values) {
            $response[$key] = $values;
        }

        throw new HttpResponseException(
            response()->json([
                'status' => false,
                'errors' => [
                    'code' => $response, // int or array
                ]
            ], HttpCode::UNPROCESSABLE_ENTITY->toInt(),
            )
        );
    }
}
