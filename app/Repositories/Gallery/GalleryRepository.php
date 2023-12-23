<?php

namespace App\Repositories\Gallery;

use App\Filters\FiltersCategoryTranslation;
use App\Models\Gallery;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class GalleryRepository extends BaseRepository implements GalleryRepositoryInterface
{
    public function __construct(Gallery $model)
    {
        parent::__construct($model);
    }

    public function getModel(): Gallery
    {
        return parent::getModel();
    }

    public function query(array $payload = []): Builder|QueryBuilder
    {
//        $startOfWeek = Carbon::now()->startOfWeek();
//        $endOfWeek = Carbon::now();
        return QueryBuilder::for($this->model)
                           ->with(['media', 'user'])
                           ->allowedFilters([
                               'published',
                               AllowedFilter::custom('search', new FiltersCategoryTranslation([
                                   'key'         => ['title'],
                                   'value'       => ['description'],
                                   'description' => ['description'],
                               ])),
                           ]);
//                           ->orderByDesc(DB::raw('JSON_UNQUOTE(JSON_EXTRACT(galleries.extra_attributes, "$.view_count"))'));

//                          ->orderByDesc('comments_count')

//                          ->orderByDesc('likes_count')

//                           ->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
    }
}
