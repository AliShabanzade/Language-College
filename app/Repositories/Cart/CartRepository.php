<?php

namespace App\Repositories\Cart;

use App\Models\Cart;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;

class CartRepository extends BaseRepository implements CartRepositoryInterface
{
    public function __construct(Cart $model)
    {
        parent::__construct($model);
    }

    public function getModel(): Cart
    {
        $user = Auth::user();
        if ($user) {
            return parent::getModel()->where('user_id', $user->id);
        }

    }

    public function query(array $payload = []): Builder
    {
        $user = Auth::user();
        if ($user) {
            return parent::query($payload)
                         ->where('user_id', $user->id)
                         ->where('payment', false);
        }

    }


}
