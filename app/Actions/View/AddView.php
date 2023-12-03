<?php

namespace App\Actions\View;

use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class AddView
{
    use AsAction;

    public function handle($model)
    {
        return DB::transaction(function () use ($model) {
            $viewCount = $model->extra_attributes->get('view_count', 0) + 1;
            $model->extra_attributes->set('view_count', $viewCount);
            $model->save();
            if (auth()->check()){
                $model->views()->create([
                    'user_id' => auth()->id(),
                    'ip'      => request()->ip(),
                ]);
            }
        });
    }
}
