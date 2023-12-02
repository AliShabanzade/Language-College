<?php

namespace App\Repositories\Faq;

use App\Models\Faq;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class FaqRepository extends BaseRepository implements FaqRepositoryInterface
{
    public function __construct(Faq $model)
    {
        parent::__construct($model);
    }

    public function query(array $payload = []): Builder
    {
        return parent::query()->when(!empty($payload['search']), function (Builder $q) use ($payload) {
            $q->where('question', 'like', '%' . $payload['search'] . '%')
              ->orWhere('answer', 'like', '%' . $payload['search'] . '%');
        });
    }

    public function getModel(): Faq
    {
        return parent::getModel();
    }
}
