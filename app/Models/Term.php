<?php

namespace App\Models;

use App\Enums\TableTermsFieldOrderingEnum;
use App\Traits\HasSlug;
use App\Traits\HasTranslationAuto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Term extends Model
{
    use HasFactory,HasSlug,HasTranslationAuto;
    protected $fillable= ['slug','ordering', 'assessment','course_id','extra_attributes','prerequisite_id'];
    protected $casts=[
        'ordering' => TableTermsFieldOrderingEnum::class,
    ];
    public function course():BelongsTo
    {
        return $this->belongsTo(Course::class)->with('translations');
    }

    public function classrooms(): HasMany
    {
        return $this->hasMany(Classroom::class,)->with('translations');
    }

    public function prerequisite():BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'prerequisite_id',)->with('translations');
    }
    public function children():HasMany
    {
        return $this->hasMany(__CLASS__, 'prerequisite_id', 'id')->with('translations');
    }

}
