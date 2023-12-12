<?php

namespace Tests\Feature;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use function Laravel\Prompts\select;

class ExerciseTestDay1 extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');
          $blog = Blog::create([
                'user_id' => 1,
                'category_id' => 1
          ]);

          Blog::create([
             'user_id' => 2,
             'category_id' => 3
          ]);


        $response->assertStatus(200);
    }

    public function test_example1(): void
    {
        $response = $this->get('/');
         $blog = Blog::find(13);
         $blog->update([
              'user_id' => 5,
              'category_id' => 5
          ]);
         $blog->save();


        $response->assertStatus(200);
    }


    public function test_example2(): void
    {
        $response = $this->get('/');
        $users = DB::select('select * from users where block= ?' , [1]);

        dd([$users]);

        $response->assertStatus(200);
    }
}
