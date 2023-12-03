<?php

namespace App\Traits;

use App\Models\View;

trait HasView{
    public function views()
    {
        return $this->morphMany(View::class,'viewable');

    }
}
