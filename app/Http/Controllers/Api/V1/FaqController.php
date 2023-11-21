<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Faq;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateFaqRequest;
use App\Http\Requests\StoreFaqRequest;
use App\Http\Resources\FaqResource;
use App\Actions\Faq\StoreFaqAction;
use App\Actions\Faq\DeleteFaqAction;
use App\Actions\Faq\UpdateFaqAction;
use App\Repositories\Faq\FaqRepositoryInterface;
use Illuminate\Http\Request;


class FaqController extends ApiBaseController
{

    public function __construct()
    {
        $this->middleware('auth:api')->except('index' , 'show');
//        $this->authorizeResource(Faq::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request , FaqRepositoryInterface $repository): JsonResponse
    {
        $faq = $repository->paginate($request->input('limit' , 15) , $request->all());
        return $this->successResponse(FaqResource::collection($faq));
    }

    /**
     * Display the specified resource.
     */

    public function show( Faq $faq): JsonResponse
    {
        return $this->successResponse(FaqResource::make($faq));
    }


    public function store(StoreFaqRequest $request): JsonResponse
    {

        $this->authorize('create', Faq::class);

        $model = StoreFaqAction::run($request->validated());
        return $this->successResponse(FaqResource::make($model), trans('general.model_has_stored_successfully',['model'=>trans('faq.model')]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFaqRequest $request, Faq $faq): JsonResponse
    {
       $this->authorize('update', $faq);
        $data = UpdateFaqAction::run($faq, $request->all());
        return $this->successResponse(FaqResource::make($data),trans('general.model_has_updated_successfully',['model'=>trans('faq.model')]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faq $faq): JsonResponse
    {
        $this->authorize('delete' , $faq);
        DeleteFaqAction::run($faq);
        return $this->successResponse('', trans('general.model_has_deleted_successfully',['model'=>trans('faq.model')]));
    }
}
