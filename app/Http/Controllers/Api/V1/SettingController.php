<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Setting;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateSettingRequest;
use App\Http\Requests\StoreSettingRequest;
use App\Http\Resources\SettingResource;
use App\Actions\Setting\StoreSettingAction;
use App\Actions\Setting\DeleteSettingAction;
use App\Actions\Setting\UpdateSettingAction;
use App\Repositories\Setting\SettingRepositoryInterface;


class SettingController extends ApiBaseController
{

    public function __construct()
    {
        $this->middleware('auth:api')->except('index','show');
        //$this->authorizeResource(Setting::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(SettingRepositoryInterface $repository): JsonResponse
    {
        return $this->successResponse(SettingResource::collection($repository->paginate()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting): JsonResponse
    {
        return $this->successResponse(SettingResource::make($setting));
    }


    public function store(StoreSettingRequest $request): JsonResponse
    {
        $this->authorizeResource('create',Setting::class);
        $model = StoreSettingAction::run($request->validated());
        return $this->successResponse($model, trans('general.model_has_stored_successfully',['model'=>trans('setting.model')]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSettingRequest $request, Setting $setting): JsonResponse
    {
        $this->authorizeResource('update',$setting);
        $data = UpdateSettingAction::run($setting, $request->all());
        return $this->successResponse(SettingResource::make($data),trans('general.model_has_updated_successfully',['model'=>trans('setting.model')]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting): JsonResponse
    {
        $this->authorizeResource('delete',$setting);
        DeleteSettingAction::run($setting);
        return $this->successResponse('', trans('general.model_has_deleted_successfully',['model'=>trans('setting.model')]));
    }
}
