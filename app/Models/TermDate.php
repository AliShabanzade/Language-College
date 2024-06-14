<?php

namespace App\Models;

use App\Traits\HasTranslationAuto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermDate extends Model
{
    use HasFactory,HasTranslationAuto;
    protected $fillable= ['start', 'end'];
}
