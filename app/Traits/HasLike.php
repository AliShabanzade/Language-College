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
                $this->Likes()->create([
                    'user_id' => auth()->id(),
                ]);
            }
        } else {
            echo "وارد سایت شوید";
        }
    }
}
