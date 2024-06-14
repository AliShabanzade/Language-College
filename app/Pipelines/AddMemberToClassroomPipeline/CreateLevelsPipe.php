<?php

namespace App\Pipelines\AddMemberToClassroomPipeline;

use Closure;

class CreateLevelsPipe implements AddMemberToClassroomPipelineInterface
{

    public function handle($users, Closure $next)
    {
        $levels = [];

        foreach ($users as $user) {
            $level = $this->levelRepository->getUserLevel($user, $classroom);

            if (!$level) {
                $level = $this->createUserLevel($user, $classroom);
            }

            $levels[] = $level;
        }

        return $next($users, $levels);
    }


    private function createUserLevel($user, $classroom)
    {
        // Code to create a user level
    }
}
