<?php

namespace App\Models;

use App\Traits\HasLike;
use App\Traits\HasUser;
use App\Traits\HasView;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Comment extends Model
{
    use HasFactory, HasUser, HasView, HasLike;

    protected $fillable = [
        'user_id', 'parent_id', 'commentable_id', 'commentable_type',
        'comment', 'published'];


    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function child(): HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function getParent(): BelongsTo
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function blog(): BelongsTo
    {
        return $this->belongsTo(Blog::class);
    }


}

