<?php

namespace App\Traits;

use App\Models\Like;
use Illuminate\Database\Eloquent\Relations\MorphMany;

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
            } else {
                $likeCount = $this->extra_attributes->get('like_count', 0) + 1;
                $model->extra_attributes->set('like_count', $likeCount);
                $model->save();
                $this->Likes()->create([
                    'user_id' => auth()->id(),
                ]);
            }
        } else {
            echo "وارد سایت شوید";
        }
    }
}
