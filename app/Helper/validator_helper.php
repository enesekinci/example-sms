<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Enums\ResponseMessage as RM;

function validateRequest(Request $request, array $rules, array $messages = [])
{
    return Validator::make($request->all(), $rules, $messages);
}
