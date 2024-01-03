<?php

namespace App\Repositories\Blog;

use App\Enums\RoleEnum;
use App\Models\Blog;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\QueryBuilder;

class BlogRepository extends BaseRepository implements BlogRepositoryInterface
{
    public function __construct(Blog $model)
    {
        parent::__construct($model);
    }

    public function getModel(): Blog
    {
        return parent::getModel();
    }

    public function query(array $payload = []): Builder|QueryBuilder
    {
        return Blog::query()
                   ->with(['category', 'user', 'media', 'translations'])
                   ->when(!auth()->user()?->hasAnyRole([RoleEnum::ADMIN->value, RoleEnum::WRITER->value, RoleEnum::SUPPORT->value]), function (Builder $query) {
                       $query->where('published', true);
                   });
    }
}
