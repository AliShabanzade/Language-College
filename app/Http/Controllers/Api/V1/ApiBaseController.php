<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class ApiBaseController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function successResponse($data=[],$message="",$statusCode = 200): JsonResponse
    {
        return response()->json(compact('data','message'),$statusCode);
    }
    public function errorResponse($message="",$statusCode=404): JsonResponse
    {

        return response()->json(compact('message'),$statusCode);
    }


}
