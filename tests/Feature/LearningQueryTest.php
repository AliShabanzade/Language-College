<?php

namespace Tests\Feature;

use App\Models\Blog;
use App\Models\Book;
use App\Models\Comment;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class LearningQueryTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $users = User::where('deleted_at', '!=', null)->get();
        dd($users->toArray());

        $response->assertStatus(200);
    }

    public function test_example2(): void
    {

        $response = $this->get('/');

        $orders = Order::whereHas('user', function (Builder $query) {
            $query->whereNotNull('deleted_at');
        })->get();

        $response->assertStatus(200);
    }


    public function test_example3(): void
    {

        $response = $this->get('/');

        $orders = Order::whereHas('items', function (Builder $query) {
            $query->whereHas('book', function (Builder $query2) {
                $query2->where('category_id', 1);
            });
        })->get();

        $response->assertStatus(200);
    }


    public function test_example4(): void
    {

        $orders = Order::whereHas('items', function (Builder $query) {
            $query->whereHas('book', function (Builder $query2) {
                $query2->where('published', '=', 0)
                       ->orWhere('published', '=', 1);
            });
        })->get();
    }


    public function test_example5(): void
    {

        $orders = Order::whereHas('items.book', function (Builder $query) {
            $query->whereIn('published', [1, 2]);
        })->get();
    }

    public function test_example6(): void
    {
        $response = $this->get('/');
        $orders = Order::whereHas('items.book', function (Builder $query) {
            $query->where('category_id', '=', 1);
        })->get();

        dd($orders->toArray());
        $response->assertStatus(200);
    }

    public function test_example7(): void
    {

        $response = $this->get('/');

        $orders = Order::whereHas('items', function (Builder $query) {
            $query->whereHas('book', function (Builder $query2) {
                $query2->where('category_id', 'like', 1);
            })->where('quantity', '>=', 10);

        })->get();
        dd($orders->toArray());
        $response->assertStatus(200);
    }


    public function test_example8(): void
    {

        $response = $this->get('/');

        $users = User::whereHas('roles', function (Builder $query) {
            $query->whereIn('name', ['admin', 'editor']);
        })->where('mobile_verify_at', '>=', Carbon::now()->subDays(7))->get();
        dd($users->toArray());
        $response->assertStatus(200);
    }


    public function test_example9(): void
    {

        $response = $this->get('/');

        $books = Book::whereHas('views.user', function (Builder $query) {
            $query->whereHas('roles', function (Builder $query2) {
                $query2->where('name', '=', 'admin');
            });
        })->get();

        dd($books->toArray());
        $response->assertStatus(200);
    }


    public function test_example10(): void
    {

        $response = $this->get('/');

        $blogs = Blog::whereHas('category', function (Builder $query) {
            $query->whereIn('id', [1, 2]);
        })->where('published', '=', 1)->get();
        dd($blogs->toArray());
        $response->assertStatus(200);
    }


    public function test_example11(): void
    {

        $response = $this->get('/');
        $orders = Order::whereHas('items', function (Builder $query) {
            $query->whereHas('book', function (Builder $query2) {
                $query2->whereHas('category', function (Builder $query3) {
                    $query3->where('type', '=', 'App\Models\Book');
                });
            })->where('quantity', '>=', 1);
        })->where('total', '>=', 1000);
        dd($orders);
        $response->assertStatus(200);
    }


    public function test_example12(): void

    {
        $response = $this->get('/');

        $blog = Blog::whereHas('comments.commentable' , function (Builder $query){
            $query->where('commentable_type' , '=' , Blog::class);

        })->withCount('comments')->orderBy('comments_count' , 'desc')->first();

          dd($blog->load('comments.user')->toArray());
        $response->assertStatus(200);
    }

    public function test_example13(): void
    {

        $response = $this->get('/');
        $users = User::whereHas('comments', function (Builder $query) {
            $mostCommentedBlogIdSubquery = Comment::select('commentable_id')
                                                  ->where('commentable_type', Blog::class)
                                                  ->groupBy('commentable_id')
                                                  ->orderByDesc(DB::raw('COUNT(*)'))
                                                  ->first();

            $query->whereHas('commentable', function (Builder $query2) use ($mostCommentedBlogIdSubquery) {
                $query2->whereIn('id', $mostCommentedBlogIdSubquery)
                    ->where('commentable_type', Blog::class)
                ;
            });
        })
                     ->withCount('comments')
                     ->orderByDesc('comments_count')
                     ->get();

         dump($users->toArray());

        $response->assertStatus(200);
    }


    public function test_example14(): void
    {

        $response = $this->get('/');
        $mostCommentedBlogId = Comment::where('commentable_type', Blog::class)
                                      ->select('commentable_id')
                                      ->groupBy('commentable_id')
                                      ->orderByDesc(DB::raw('COUNT(*)'))
                                      ->value('commentable_id');

        $users = User::whereHas('comments.commentable', function (Builder $query) use ($mostCommentedBlogId) {
            $query->where('id', $mostCommentedBlogId);
        })->withCount('comments')->orderByDesc('comments_count')->get();


        $response->assertStatus(200);
    }






}
