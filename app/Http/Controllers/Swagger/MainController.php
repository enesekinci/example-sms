<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;


/**
 * @OA\Info(
 *     version="1.0",
 *     title="Example for response examples value"
 * )
 *
 * @OA\PathItem(path="/api")
 *
 * @OA\Put(
 *     tags={"Users"},
 *     path="/users/{id}",
 *     summary="Updates a user",
 *     @OA\Parameter(
 *         description="Parameter with mutliple examples",
 *         in="path",
 *         name="id",
 *         required=true,
 *         @OA\Schema(type="string"),
 *         @OA\Examples(example="int", value="1", summary="An int value."),
 *         @OA\Examples(example="uuid", value="0006faf6-7a61-426c-9034-579f2cfcfa83", summary="An UUID value."),
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK"
 *     )
 * )
 *
 */

class MainController extends Controller
{
    //
}
