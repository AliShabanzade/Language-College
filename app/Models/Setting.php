<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\SchemalessAttributes\SchemalessAttributesTrait;

class Setting extends Model
{
    use HasFactory;

    use SchemalessAttributesTrait;

    protected $casts = [
        'schemaless_attributes' => 'array',
    ];
}
