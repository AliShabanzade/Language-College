<?php

namespace App\Actions\Session;

use App\Enums\PermissionEnum;
use App\Models\Session;
use App\Repositories\Session\SessionRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateSessionAction
{
    use AsAction;

    public function __construct(private readonly SessionRepositoryInterface $repository)
    {
    }


    /**
     * @param Session                                          $session
     * @param array{name:string,mobile:string,email:string} $payload
     * @return Session
     */
    public function handle(Session $session, array $payload): Session
    {
        return DB::transaction(function () use ($session, $payload) {
            $session->update($payload);
            return $session;
        });
    }
}
