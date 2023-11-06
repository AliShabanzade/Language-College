<?php

namespace App\Traits;

use App\Models\Like;

trait HasLike{
    public function likes(){
        return $this->morphMany(\App\Models\like::class,'likeable');
    }

}
