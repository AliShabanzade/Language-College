<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class ApiBaseController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function successResponse($data,$message="",$statusCode = 200)
    {
        return response()->json(compact('data','message'),$statusCode);
    }
    public function errorResponse($message="",$statusCode=404){

        return response()->json(compact('message'),$statusCode);
    }

    //
}
