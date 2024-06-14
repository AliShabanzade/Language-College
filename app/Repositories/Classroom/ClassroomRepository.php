<?php

namespace App\Repositories\Classroom;

use App\Enums\PermissionsEnum;
use App\Enums\RoleEnum;
use App\Filters\FiltersSearch;
use App\Filters\FuzzyFilter;
use App\Models\Classroom;
use App\Repositories\BaseRepository;
use App\Services\AdvancedSearchFields\AdvanceFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ClassroomRepository extends BaseRepository implements ClassroomRepositoryInterface
{
    public function __construct(Classroom $model)
    {
        parent::__construct($model);
    }

    public function getModel(): Classroom
    {
        return parent::getModel();
    }

    public function query(array $payload = []): Builder|QueryBuilder
    {
        $user = auth()->user();
        $user_is_admin = $user->hasThesePermissions([
            PermissionsEnum::ADMIN->value,
            PermissionsEnum::CLASSROOM_ALL->value
        ]);

        $user_is_teacher = $user->hasRole(RoleEnum::TEACHER->value);
        $termDate = request()->input('term_date', \Arr::get($payload, 'term_date'));

        return QueryBuilder::for($this->getModel())
            ->defaultSort('-id')
            ->when(isset($payload['with']) && in_array('course', $payload['with']), fn($q) => $q->with('course'))
            ->when(isset($payload['with']) && in_array('term', $payload['with']), fn($q) => $q->with('term'))
            ->allowedFilters([
                AllowedFilter::custom('a_search', new AdvanceFilter()),
                AllowedFilter::custom('search', new FiltersSearch(['key' => ['name']])),
            ])
            ->when($user_is_admin, fn(Builder $query) => $query->with('members')
                ->when($termDate, fn($q) => $q->whereHas('term_date', fn($q) => $q->where('start', $termDate))))
            ->when($user_is_teacher, fn(Builder $query) => $query->where('teacher_id', $user_is_teacher->id)
                ->when($termDate, fn($q) => $q->whereDate('term_date', $termDate)))
            ->when(!$user_is_teacher && !$user_is_admin, fn(Builder $query) => $query->whereHas('members',
                function ($q) use ($user) {
                    $q->where('memberable_type', Classroom::class)->where('user_id', $user)->get();
                })->when($termDate, fn($q) => $q->whereDate('term_date', $termDate)))
            ->allowedSorts(['id', 'course_id', 'term_id']);

    }


    public function checkSort(Classroom $classroom)
    {
        if ($classroom->sort === 0) {
            return true;
        } elseif ($classroom->sort > 0) {
            $sort = $classroom->sort;
            $classrooms = $this->getModel()->where('college_id', $classroom->college_id)
                ->where('term_id', $classroom->term_id)
                ->where('term_date_id', $classroom->term_date_id)
                ->where('classroom_gender', $classroom->classroom_gender)
                ->where('sort', $sort - 1)->get();

            foreach ($classrooms as $customClass) {
                $countMember = $classroom->members()->count();
                if ($customClass->capacity === $countMember) {
                    return true;
                } elseif ($customClass->capacity > $countMember) {
                    abort(Response::HTTP_BAD_REQUEST, trans('classroom.The_class_capacity_is_not_full'));
                }

            }
        }
    }
}
