<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class ApiBaseController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function successResponse($data = [], $message = "", $statusCode = 200): JsonResponse
    {
        return response()->json(compact('data', 'message'), $statusCode);
    }

    public function successResponseWithAdditional($data = [], string $message = null, $status = 200, $additional = []): JsonResponse
    {
        return $data->additional(array_merge([
            'message' => $message??''
        ], $additional))->response()->setStatusCode($status);
    }

    public function errorResponse($message = "", $statusCode = 404): JsonResponse
    {
        return response()->json(compact('message'), $statusCode);
    }


}
