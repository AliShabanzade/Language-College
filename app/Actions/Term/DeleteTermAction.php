<?php

namespace App\Actions\Term;

use App\Models\Term;
use App\Repositories\Term\TermRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteTermAction
{
    use AsAction;

    public function __construct(public readonly TermRepositoryInterface $repository)
    {
    }

    public function handle(Term $term): bool
    {
        return DB::transaction(function () use ($term) {
            return $this->repository->delete($term);
        });
    }
}
