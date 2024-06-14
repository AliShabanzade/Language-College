<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Classroom\AddMemberToClassroomAction;
use App\Http\Requests\AssignUsersToClassroomRequest;
use App\Models\Classroom;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateClassroomRequest;
use App\Http\Requests\StoreClassroomRequest;
use App\Http\Resources\ClassroomResource;
use App\Actions\Classroom\StoreClassroomAction;
use App\Actions\Classroom\DeleteClassroomAction;
use App\Actions\Classroom\UpdateClassroomAction;
use App\Repositories\Classroom\ClassroomRepositoryInterface;
use Illuminate\Http\Request;


class ClassroomController extends ApiBaseController
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Classroom::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(ClassroomRepositoryInterface $repository): JsonResponse
    {
        return $this->successResponse(ClassroomResource::collection($repository->paginate(payload:['with' => ['college','course','term']])));
    }

    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom, Request $request): JsonResponse
    {
        $viewType = $request->input('view_type');
        if(isset($viewType) && $viewType === ClassroomViewTypeEnum::FIND_COURSE->value) {
            return $classroom->college->courses;
        }elseif(isset($viewType) && $viewType === ClassroomViewTypeEnum::FIND_TERM->value){
            return $this->successResponse(ClassroomTermResource::make($classroom->course->terms->load(['college','course','term','term_date'])));
        }
        return $this->successResponse(ClassroomResource::make($classroom->load(['college','course','term','term_date'])));
    }


    public function store(StoreClassroomRequest $request): JsonResponse
    {
        $model = StoreClassroomAction::run($request->validated());
        return $this->successResponse(ClassroomResource::make($model),
            trans('general.model_has_stored_successfully',
                ['model'=>trans('classroom.model')]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClassroomRequest $request, Classroom $classroom): JsonResponse
    {
        $data = UpdateClassroomAction::run($classroom, $request->all());
        return $this->successResponse(ClassroomResource::make($data),
            trans('general.model_has_updated_successfully',
                ['model'=>trans('classroom.model')]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom): JsonResponse
    {
        DeleteClassroomAction::run($classroom);
        return $this->successResponse('', trans('general.model_has_deleted_successfully',
            ['model'=>trans('classroom.model')]));
    }



    public function addMember(Classroom $classroom, AssignUsersToClassroomRequest $request)
    {
        $this->authorize('addMember', Classroom::class);
        AddMemberToClassroomAction::run($classroom, $request->validated());
        return $this->successResponse('',
            trans('classroom.addMember'));
    }
}
