<?php

namespace App\Traits;

use App\Models\Meta;

trait HasMeta{
    public function metas(){
        return $this->morphMany(\App\Models\Meta::class,'metaable');
    }

}
