<?php

namespace App\Actions\View;

use App\Enums\PermissionEnum;
use App\Models\View;
use App\Repositories\View\ViewRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateViewAction
{
    use AsAction;

    public function __construct(private readonly ViewRepositoryInterface $repository)
    {
    }


    /**
     * @param View                                          $view
     * @param array{name:string,mobile:string,email:string} $payload
     * @return View
     */
    public function handle(View $view, array $payload): View
    {
        return DB::transaction(function () use ($view, $payload) {
            $view->update($payload);
            return $view;
        });
    }
}
