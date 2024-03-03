<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\College;
use App\Models\CollegeCourse;
use App\Models\Course;
use App\Repositories\Course\CourseRepositoryInterface;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateCollegeRequest;
use App\Http\Requests\StoreCollegeRequest;
use App\Http\Resources\CollegeResource;
use App\Actions\College\StoreCollegeAction;
use App\Actions\College\DeleteCollegeAction;
use App\Actions\College\UpdateCollegeAction;
use App\Repositories\College\CollegeRepositoryInterface;
use Illuminate\Http\Request;


class CollegeController extends ApiBaseController
{

    public function __construct()
    {
       // $this->middleware('auth:api');
       // $this->authorizeResource(College::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(CollegeRepositoryInterface $repository): JsonResponse
    {
        return $this->successResponse(CollegeResource::collection($repository->paginate()));
    }

    /**
     * Display the specified resource.
     */
    public function show(College $college): JsonResponse
    {
        return $this->successResponse(CollegeResource::make($college));
    }


    public function store(StoreCollegeRequest $request): JsonResponse
    {
        $model = StoreCollegeAction::run($request->validated());
        return $this->successResponse(CollegeResource::make($model), trans('general.model_has_stored_successfully',['model'=>trans('college.model')]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCollegeRequest $request, College $college): JsonResponse
    {
        $data = UpdateCollegeAction::run($college, $request->all());
        return $this->successResponse(CollegeResource::make($data),
            trans('general.model_has_updated_successfully',['model'=>trans('college.model')]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(College $college): JsonResponse
    {
        DeleteCollegeAction::run($college);
        return $this->successResponse('', trans('general.model_has_deleted_successfully',['model'=>trans('college.model')]));
    }

    public function addCourse(CollegeRepositoryInterface $repository,College $college, Request $request)
    {
        $college = $repository->find($college->id,firstOrFail: true);
        $college->courses()->sync($request->input('courses'));
        return $college->courses;
    }


    public function toggle(CollegeRepositoryInterface $repository,
                           CourseRepositoryInterface $courseRepository,
                           CollegeCourse $collegeCourse,
                           College $college,Course $course)
    {

        $college = $repository->find($college->id,firstOrFail: true);
        $course = $courseRepository->find($course->id,firstOrFail: true);
        $collegeCourse->togglePublished($college, $course);
        return $this->successResponse('', trans('general.model_has_toggled_successfully',
            ['model'=>trans('college.model')]));
    }
}
