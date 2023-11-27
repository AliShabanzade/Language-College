<?php

namespace App\Traits;

use App\Models\Like;

trait HasLike
{
    public function likes()
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
                $this->Likes()->create([
                    'user_id' => auth()->id(),
                ]);
            }
        }else{
            echo "وارد سایت شوید";
        }
    }
}
