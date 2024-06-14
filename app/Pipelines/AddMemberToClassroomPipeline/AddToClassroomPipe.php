<?php

namespace App\Pipelines\AddMemberToClassroomPipeline;

use Closure;

class AddToClassroomPipe implements  AddMemberToClassroomPipelineInterface
{

    public function handle($users, Closure $next)
    {
        $addedUsers = [];

        foreach ($users as $index => $user) {
            $level = $levels[$index];

            if ($classroom->members()->count() >= $classroom->capacity) {
                throw new \Exception(trans('classroom.capacity'));
            }

            if ($classroom->classroom_gender !== $user->gender) {
                throw new \Exception(trans('classroom.lastName_has_a_gender_opposite_to_the_gender_of_the_class', ['lastName' => $user->name]));
            }

            if (isEmpty($classroom->term->prerequisite) || $classroom->term->prerequisite === $level->term->prerequisite) {
                $user->classrooms()->sync($classroom);
                $user->colleges()->sync($classroom->college);
                $user->coursesUser()->sync($classroom->college);
                $user->terms()->sync($classroom->term);

                $addedUsers[] = $user->id;
            }
        }

        return $addedUsers;
    }
}
