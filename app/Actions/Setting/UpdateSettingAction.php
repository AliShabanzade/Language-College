<?php

namespace App\Actions\Setting;

use App\Enums\PermissionEnum;
use App\Models\Setting;
use App\Repositories\Setting\SettingRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateSettingAction
{
    use AsAction;

    public function __construct(private readonly SettingRepositoryInterface $repository)
    {
    }


    /**
     * @param Setting                                          $setting
     * @param array{name:string,mobile:string,email:string} $payload
     * @return Setting
     */
    public function handle(Setting $setting, array $payload): Setting
    {
        return DB::transaction(function () use ($setting, $payload) {
            $model=$this->repository->update($setting,$payload);
            $model->set($payload['extra_attributes']);
            $model->save();
            return $model;
        });
    }
}
