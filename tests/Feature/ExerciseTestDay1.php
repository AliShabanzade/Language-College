<?php

namespace Tests\Feature;

use App\Models\Blog;
use App\Models\Book;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ExerciseTestDay1 extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');
        $blog = Blog::create([
            'user_id'     => 1,
            'category_id' => 1
        ]);

        Blog::create([
            'user_id'     => 2,
            'category_id' => 3
        ]);


        $response->assertStatus(200);
    }

    public function test_example1(): void
    {
        $response = $this->get('/');
        $blog = Blog::find(13);
        $blog->update([
            'user_id'     => 5,
            'category_id' => 5
        ]);
        $blog->save();


        $response->assertStatus(200);
    }


    public function test_example2(): void
    {
        $response = $this->get('/');
        $users = DB::select('select * from users where block= ?', [1]);

        dd([$users]);

        $response->assertStatus(200);
    }


    public function test_example3(): void
    {
        $response = $this->get('/');
        $order = Order::whereHas('user', function (Builder $query) {
            $query->where('id', 1);
        });


        $response->assertStatus(200);
    }

    public function test_example4(): void
    {
        $response = $this->get('/');

        $order = Order::whereHas('user', function (Builder $q) {
            $q->withTrashed()->whereNotNull('deleted_at');
        });


//        dd($order->toSql(), $order->getBindings() );
        dd($order->toSql());


        $response->assertStatus(200);
    }


    public function test_find_user_of_most_liked_entities(): void
    {
        $response = $this->get('/');
        $user = User::withCount('likes')
                    ->orderBy('likes_count', 'desc')
                    ->limit(5)
                    ->get();
        dd($user->toArray());
        $response->assertStatus(200);
    }

    public function test_latest_published_blogs_with_comments_count()
    {
        $response = $this->get('/');

        $blog = Blog::where('published' , 1)
            ->orderBy('created_at' , 'desc')
            ->withCount('comments')
            ->first();

//        $blog->sortByDesc('created_at');



        dd($blog->toArray());

        $response->assertStatus(200);

    }

    public function test_retrieve_books_with_no_orders_in_a_month()
    {
        $response = $this->get('/');

        $books = Book::whereDoesntHave('items')->whereHas('translations')->get();

        dd($books->toArray());
        $bookNames = [];
        foreach ($books as $book) {
            $bookNames[] = $book->translations->where('key', 'name')->value('value');
        }

        dd($bookNames);

        $response->assertStatus(200);
    }


    public function test_retrieve_books_with_no_orders_in_a_month2()
    {
        $response = $this->get('/');

        $books =  Book::whereDoesntHave('items')->with('translations')->get();

        $bookNames= $books->map(function($book){
           return $book->translations->where('key', 'name')->value('value');
        });

        dd($bookNames->toArray());

        $response->assertStatus(200);
    }

    public function test_retrieve_categories_with_count_of_blogs()
    {
        $categories = Category::withCount('books')->get();
        dd($categories->toArray());
    }
}
