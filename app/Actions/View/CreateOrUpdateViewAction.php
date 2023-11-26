<?php

namespace App\Actions\View;

use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateOrUpdateViewAction
{
    use AsAction;

    public function handle($model)
    {
        return DB::transaction(function () use ($model) {
            $model->views()->updateOrCreate([
                'user_id' => auth()->id(),
                'ip'      => request()->ip(),
            ]);
        });
    }
}
