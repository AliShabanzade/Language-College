<?php

namespace App\Repositories\Notice;

use App\Filters\FiltersCategoryTranslation;
use App\Models\Notice;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class NoticeRepository extends BaseRepository implements NoticeRepositoryInterface
{


    public function __construct(Notice $model)
    {
        parent::__construct($model);
    }

    public function getModel(): Notice
    {
        return parent::getModel();
    }


    public function query(array $payload = []): QueryBuilder|Builder
    {
//        $startOfWeek = Carbon::now()->startOfWeek();
//        $endOfWeek = Carbon::now();

        return QueryBuilder::for($this->model)
                           ->with(['media', 'user'])
                           ->allowedFilters([
                               'published',
                               AllowedFilter::custom('search', new FiltersCategoryTranslation([
                                   'key' => ['title']
                               ])),
                           ]);
//
//                           ->orderByDesc('views')
//
//                           ->orderByDesc('comments_count')
//
//                           ->orderByDesc('likes_count')
//
//                           ->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
    }
}
