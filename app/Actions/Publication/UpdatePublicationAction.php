<?php

namespace App\Actions\Publication;

use App\Actions\Translation\SetTranslationAction;
use App\Enums\PermissionEnum;
use App\Models\Publication;
use App\Repositories\Publication\PublicationRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdatePublicationAction
{
    use AsAction;

    public function __construct(private readonly PublicationRepositoryInterface $repository)
    {
    }


    /**
     * @param Publication                                          $publication
     * @param array{name:string,mobile:string,email:string} $payload
     * @return Publication
     */
    public function handle(Publication $publication, array $payload): Publication
    {
        return DB::transaction(function () use ($publication, $payload) {
        $model=  $this->repository->update($publication,$payload);
        SetTranslationAction::run($model,$payload['translations']);
        return $publication;
        });
    }
}
