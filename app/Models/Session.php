<?php

namespace App\Models;

use App\Traits\HasMembers;
use App\Traits\HasSlug;
use App\Traits\HasTranslationAuto;
use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Session extends Model
{
    use HasFactory,HasTranslationAuto,HasSlug,HasMembers;
    protected $fillable= ['duration', 'ordering', 'status', 'type','term_id',
                          'classroom_id','extra_attributes','date'];
    protected     $casts        = [
        'extra_attributes' => 'array',
    ];

    public function term(): BelongsTo
    {
        return $this->belongsTo(Term::class)->with('translations');
    }

    public function classroom(): BelongsTo
    {
        return $this->belongsTo(Classroom::class)->with('translations');
    }
}
