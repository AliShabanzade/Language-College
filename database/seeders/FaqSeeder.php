<?php

namespace Database\Seeders;

use App\Actions\Category\StoreCategoryAction;
use App\Models\Book;
use App\Models\Category;
use App\Models\Faq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Faq::factory(10)->create();


    }
}
