<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Notice;
use Illuminate\Database\Seeder;

class NoticeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Notice::factory(10)->create()
              ->each(function (Notice $notice) {
                  Comment::factory(1)
                         ->create([
                             'commentable_type' => Notice::class,
                             'commentable_id'   => $notice->id,
                         ]);
              })->each(function (Notice $notice) {
                Like::factory(1)->create([
                    'likeable_id'   => $notice->id,
                    'likeable_type' => Notice::class,

                ]);
            });
    }
}
