<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;
    protected $fillable= ['date', 'classroom_gender', 'capacity', 'published','course_id','term_id','teacher_id'];

}
