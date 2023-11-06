<?php

namespace App\Traits;

use App\Models\View;

trait HasView{
    public function views()
    {
        return $this->morphMany(\App\Models\View::class,'viewable');

    }
}
