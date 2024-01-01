<?php

namespace App\Traits;

use App\Models\Fav;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Http\Response;

trait HasFav
{
    public function favs(): MorphMany
    {
        return $this->morphMany(Fav::class, 'favable');
}

    public function fav(): void
    {
        if (auth()->user()) {

            $model = $this->Favs()->where('user_id', auth()->id())->first();

            if ($model) {
                $model->delete();
                $favCount = $this->extra_attributes->get('fav_count', 0) - 1;
                $this->extra_attributes->set('fav_count', $favCount);
                $this->save();
                abort(Response::HTTP_UNPROCESSABLE_ENTITY,
//                    0,
                    trans('fav.unfav')
                );

            } else {
                $favCount = $this->extra_attributes->get('fav_count', 0) + 1;
                $this->extra_attributes->set('fav_count', $favCount);
                $this->save();
                $this->Favs()->create([
                    'user_id' => auth()->id(),
                ]);
                abort(Response::HTTP_UNPROCESSABLE_ENTITY,
//                    1,
                   trans('fav.fav')
                );
            }
        } else {
            abort(Response::HTTP_FORBIDDEN,
                trans('authentication.please_sign_in_first'));
        }
    }
}
