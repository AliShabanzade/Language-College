<?php

namespace App\Pipelines\AddMemberToClassroomPipeline;

use Closure;
use function PHPUnit\Framework\isEmpty;

class FindUsersPipe  implements  AddMemberToClassroomPipelineInterface
{

    public function handle($userIds, $levels)
    {
        $users = $this->userRepository->findMany($userIds, true);

        return $next($users);
    }
}
