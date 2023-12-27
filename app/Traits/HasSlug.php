<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasSlug
{
    protected static function bootHasSlug(): void
    {
        static::creating(function ($model) {
            if (request()->input('translations')) {
                $keyVals = request()->input('translations')[app()->getLocale()];
                $filter = array_filter($keyVals, fn($item) => $item['key'] == 'title');
                $titleTranslation = array_pop($filter)['value'];
                if ($titleTranslation !== null) {
                    $model->slug = Str::slug($titleTranslation);
                } else {
                    $model->slug = Str::slug("default-slug");
                }

                $model->slug = self::makeUniqueSlug($model->slug);
            }
            else
                $model->slug = fake()->unique()->slug();
        });
    }

    protected static function makeUniqueSlug(string $slug): string
    {
        $originalSlug = $slug;
        $counter = 1;

        while (static::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }


}
