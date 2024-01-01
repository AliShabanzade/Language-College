<?php

namespace App\Repositories\Gallery;


use App\Actions\Fav\AddFav;
use App\Models\Gallery;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
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

        return QueryBuilder::for($this->getModel())
                           ->with(['media', 'user'])
                           ->allowedSorts([
                               AllowedSort::field('view_count', 'extra_attributes->view_count'),
                               AllowedSort::field('like_count', 'extra_attributes->like_count'),
                               AllowedSort::field('comment_count', 'extra_attributes->comment_count')
                           ])
                           ->defaultSort('-created_at');

    }
}
