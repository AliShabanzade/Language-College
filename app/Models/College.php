<?php

namespace App\Models;

use App\Traits\HasSlug;
use App\Traits\HasTranslationAuto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class College extends Model
{
    use HasFactory,HasSlug,HasTranslationAuto;
    protected $fillable= ['slug', 'status'];

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class,'college_course','college_id','course_id')
               ->withPivot('published');
    }

    public function togglePublished($courseId)
    {

        $course = $this->courses()->where('course_id', $courseId)->first();
        if ($course) {
            $course->pivot->published = !$course->pivot->published;
            $course->pivot->save();
        }
    }
}
