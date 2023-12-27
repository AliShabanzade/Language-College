<?php

namespace App\Repositories\Notice;


use App\Models\Notice;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedSort;

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

        $yesterday = Carbon::yesterday()->toDateString();
        $last_week = Carbon::now()->subWeeks(1)->toDateString();

        return QueryBuilder::for($this->getModel())
                           ->with(['media', 'user'])
                           ->whereDate('created_at', '=', $yesterday)
                           ->orWhere('created_at', '=', $last_week)
                           ->allowedSorts([
                               AllowedSort::field('view_count', 'extra_attributes->view_count'),
                               AllowedSort::field('like_count', 'extra_attributes->like_count'),
                               AllowedSort::field('comment_count', 'extra_attributes->comment_count')
                           ])
                           ->defaultSort('-id');


    }
}
