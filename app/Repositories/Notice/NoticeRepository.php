<?php

namespace App\Repositories\Notice;

use App\Models\Notice;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

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



    public function query(array $payload = []): Builder
    {
        return parent::query($payload)->with('user');
    }


}
