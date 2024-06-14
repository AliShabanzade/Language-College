<?php

namespace App\Models;

use App\Traits\HasMembers;
use App\Traits\HasSlug;
use App\Traits\HasTranslationAuto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory,HasSlug,HasTranslationAuto,SoftDeletes,HasMembers;

    protected $fillable= ['type','slug','extra_attributes'];
    protected     $casts        = [
        'extra_attributes' => 'array',
    ];
    public function terms(): HasMany
    {
        return $this->hasMany(Term::class);
    }
    public function colleges(): BelongsToMany
    {
        return $this->belongsToMany(College::class,'college_course','course_id','college_id')
            ->withPivot('published');
    }
    public function classroom(): HasMany
    {
        return $this->hasMany(Classroom::class);
    }
    public function userLevel(): BelongsToMany
    {
        return $this->belongsToMany(User::class,'level','course_id','user_id')
            ->withPivot('ordering');
    }
}
