<?php

namespace App\Traits;

use App\Models\Like;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Http\Response;

trait HasLike
{
    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function like(): void
    {

        if (auth()->user()) {

            $model = $this->Likes()->where('user_id', auth()->id())->first();

            if ($model) {
                $model->delete();
                $likeCount = $this->extra_attributes->get('like_count', 0) - 1;
                $this->extra_attributes->set('like_count', $likeCount);
                $this->save();
                abort(Response::HTTP_UNPROCESSABLE_ENTITY,
                    0
//                    trans('like.dislike')
                );

            } else {
                $likeCount = $this->extra_attributes->get('like_count', 0) + 1;
                $this->extra_attributes->set('like_count', $likeCount);
                $this->save();
                $this->Likes()->create([
                    'user_id' => auth()->id(),
                ]);
                abort(Response::HTTP_UNPROCESSABLE_ENTITY,
                    1
//                   trans('like.like')
                );
            }
        } else {
            abort(Response::HTTP_FORBIDDEN,
                trans('authentication.please_sign_in_first'));
        }
    }
}
