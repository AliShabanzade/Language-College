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
                foreach ($keyVals as $item) {
                    $filter = array_filter($keyVals, fn($item) => $item['key'] == 'title');

                    if ($filter) {
                        $titleTranslation = array_pop($filter)['value'];
                        $model->slug = $titleTranslation;
                        $model->slug = self::makeUniqueSlug($model->slug);
                    }elseif(!$filter){
                        $model->slug = Str::slug(Str::uuid());
                    }
                }

            } else{
                $model->slug = fake()->unique()->slug();
            }

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
