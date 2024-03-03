<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CollegeCourse extends Model
{
    use HasFactory;

    protected $table = 'college_course';
    protected $fillable = ['course_id', 'college_id', 'published'];

    public function togglePublished($collegeId, $courseId)
    {
        $toggle= $this->where('college_id', $collegeId->id)
            ->where('course_id', $courseId->id)->first();
        if($toggle){
            $toggle->published = !$toggle->published;
            $toggle->save();
        }

    }
}
