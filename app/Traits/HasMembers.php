<?php

namespace App\Traits;

use App\Models\Like;
use App\Models\Member;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasMembers
{
    public function members(): MorphMany
    {
        return $this->morphMany(Member::class, 'memberable');
    }
}
