<?php

namespace App\Models;

use App\Traits\HasMembers;
use App\Traits\HasSlug;
use App\Traits\HasTranslationAuto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classroom extends Model
{
    use HasFactory,HasTranslationAuto,SoftDeletes,HasSlug,HasMembers;



    protected    $fillable = ['college_id', 'course_id', 'term_id', 'teacher_id', 'date',
                              'classroom_gender', 'start', 'end', 'capacity', 'published',
                              'term_date_id', 'sort', 'type'];

    protected $casts    = [
        'extra_attributes' => 'array',
    ];

    public function college(): BelongsTo
    {
        return $this->belongsTo(College::class)->with('translations');
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class)->with('translations');
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function term():BelongsTo
    {
        return $this->belongsTo(Term::class)->with('translations');
    }

    public function term_date(): BelongsTo
    {
        return $this->belongsTo(TermDate::class)->with('translations');
    }

    public function sessions(): HasMany
    {
        return $this->hasMany(Session::class)->with('translations');
    }



}
