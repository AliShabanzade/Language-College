<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Attendance;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateAttendanceRequest;
use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Resources\AttendanceResource;
use App\Actions\Attendance\StoreAttendanceAction;
use App\Actions\Attendance\DeleteAttendanceAction;
use App\Actions\Attendance\UpdateAttendanceAction;
use App\Repositories\Attendance\AttendanceRepositoryInterface;


class AttendanceController extends ApiBaseController
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Attendance::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(AttendanceRepositoryInterface $repository): JsonResponse
    {
        return $this->successResponse(AttendanceResource::collection($repository->paginate()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance): JsonResponse
    {
        return $this->successResponse(AttendanceResource::make($attendance));
    }


    public function store(StoreAttendanceRequest $request): JsonResponse
    {
        $model = StoreAttendanceAction::run($request->validated());
        return $this->successResponse($model, trans('general.model_has_stored_successfully',['model'=>trans('attendance.model')]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAttendanceRequest $request, Attendance $attendance): JsonResponse
    {
        $data = UpdateAttendanceAction::run($attendance, $request->all());
        return $this->successResponse(AttendanceResource::make($data),trans('general.model_has_updated_successfully',['model'=>trans('attendance.model')]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance): JsonResponse
    {
        DeleteAttendanceAction::run($attendance);
        return $this->successResponse('', trans('general.model_has_deleted_successfully',['model'=>trans('attendance.model')]));
    }
}
