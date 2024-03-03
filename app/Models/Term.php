<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Term extends Model
{
    use HasFactory;
    protected $fillable= ['ordering', 'assessment','course_id','college_id'];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function college()
    {
        return $this->belongsTo(Term::class);
    }
}
