<?php

namespace Database\Seeders;

use App\Enums\TableCategoryFieldTypeEnum;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //ID=1
        $bookCategory=Category::create([
            'type'=>TableCategoryFieldTypeEnum::BOOK->value,
            'published'=>1,
        ]);

        //ID=2
        $blogCategory=Category::create([
            'type'=>TableCategoryFieldTypeEnum::BLOG->value,
            'published'=>1,
        ]);
		//ID=3
        $faqCategory=Category::create([
            'type'=>TableCategoryFieldTypeEnum::FAQ->value,
            'published'=>1,
        ]);


    }


}
