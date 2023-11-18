<?php

namespace App\Actions\Faq;

use App\Enums\PermissionEnum;
use App\Models\Faq;
use App\Repositories\Faq\FaqRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateFaqAction
{
    use AsAction;

    public function __construct(private readonly FaqRepositoryInterface $repository)
    {
    }


    /**
     * @param Faq                                          $faq
     * @param array{name:string,mobile:string,email:string} $payload
     * @return Faq
     */
    public function handle(Faq $faq, array $payload): Faq
    {
        return DB::transaction(function () use ($faq, $payload) {
            $faq->update($payload);
            return $faq;
        });
    }
}
