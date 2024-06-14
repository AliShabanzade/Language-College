<?php

namespace App\Actions\Term;

use App\Actions\Translation\SetTranslationAction;
use App\Enums\PermissionsEnum;
use App\Models\Term;
use App\Repositories\Term\TermRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateTermAction
{
    use AsAction;

    public function __construct(private readonly TermRepositoryInterface $repository)
    {
    }


    /**
     * @param Term                                          $term
     * @param array{name:string,mobile:string,email:string} $payload
     * @return Term
     */
    public function handle(Term $term, array $payload): Term
    {
        return DB::transaction(function () use ($term, $payload) {
            $model=$this->repository->update($term,$payload);
            SetTranslationAction::run($model,$payload['translations']);
            return $model->load('translations','course');
        });
    }
}
