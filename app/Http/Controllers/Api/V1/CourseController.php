<?php

namespace App\Http\Controllers\Api\V1;


use App\Models\Course;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateCourseRequest;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Resources\CourseResource;
use App\Actions\Course\StoreCourseAction;
use App\Actions\Course\DeleteCourseAction;
use App\Actions\Course\UpdateCourseAction;
use App\Repositories\Course\CourseRepositoryInterface;


class CourseController extends ApiBaseController
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Course::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(CourseRepositoryInterface $repository): JsonResponse
    {
        return $this->successResponse(CourseResource::collection($repository->paginate()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course): JsonResponse
    {
        return $this->successResponse(CourseResource::make($course->load(['translations','terms'])));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCourseRequest{
     *     translation:array,
     *     type:string,
     *     published:bool,
     *     status:bool,
     *     media_uuid:string
     * } $request
     * @return JsonResponse
     */

    public function store(StoreCourseRequest $request): JsonResponse
    {
        $model = StoreCourseAction::run($request->validated());
        return $this->successResponse(CourseResource::make($model), trans('general.model_has_stored_successfully',['model'=>trans('course.model')]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, Course $course): JsonResponse
    {
        $data = UpdateCourseAction::run($course, $request->all());
        return $this->successResponse(CourseResource::make($data),trans('general.model_has_updated_successfully',['model'=>trans('course.model')]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course): JsonResponse
    {
        DeleteCourseAction::run($course);
        return $this->successResponse('', trans('general.model_has_deleted_successfully',['model'=>trans('course.model')]));
    }

}
