<?php

namespace App\Actions\Fav;

use App\Actions\Translation\SetTranslationAction;
use App\Enums\PermissionEnum;
use App\Models\Fav;
use App\Repositories\Fav\FavRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateFavAction
{
    use AsAction;

    public function __construct(private readonly FavRepositoryInterface $repository)
    {
    }


    /**
     * @param Fav                                          $fav
     * @param array{name:string,mobile:string,email:string} $payload
     * @return Fav
     */
    public function handle(Fav $fav, array $payload): Fav
    {
        return DB::transaction(function () use ($fav, $payload) {
            $model=$this->repository->update($fav,$payload);
            SetTranslationAction::run($model,$payload['translations']);
            if(request()->hasFile('media')){
                $model->media()->delete();
                $model->addMediaFromRequest('media')
                    ->toMediaCollection('book');
            }
            return $model;
        });
    }
}
