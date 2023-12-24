<?php

namespace Tests\Feature;

use App\Models\Blog;
use App\Models\Book;
use App\Models\Order;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class TestQueryDay2 extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');
        $users = User::all();
        $users = $users->fresh('comments');
        dd($users->toArray());

        $response->assertStatus(200);
    }

    public function test_distinct_query()
    {
        $distinctBookCategory = Blog::distinct()->count('category_id');
        dd($distinctBookCategory);

    }

    public function test_retrieve_users_with_unique_categories_of_published_blogs()
    {
        $users = User::withTrashed()->whereHas('blogs', function (Builder $query) {
            $query->where('published', 1);
        })
                     ->with(['blogs.category' => function ($query) {
                         $query->select('categories.*')->groupBy('categories.id');
                     }])->get();
        dd($users->toArray());


    }

    public function test_retrieve_users_with_unique_categories_of_published_blogs2()
    {
        $users = User::withTrashed()
                     ->join('blogs', 'users.id', '=', 'blogs.user_id')
                     ->where('blogs.published', 1)
                     ->join('categories', 'blogs.category_id', '=', 'categories.id')
                     ->select('users.*')
                     ->distinct()
                     ->get();

        dd($users->toArray());


    }

    public function test_user_order()
    {
        $userOrders = User::join('orders', 'users.id', '=', 'orders.user_id')
                          ->select('users.name', 'orders.total')->get();

        dd($userOrders->toArray());

    }

    public function test_user_order2()
    {
        $userOrders = DB::table('users')
                        ->join('orders', 'users.id', '=', 'orders.user_id')
                        ->select('users.name', 'orders.total')->get();
        dd($userOrders->toArray());

    }

    public function test_retrieve_book_orders_user_by_specific_roles()
    {
        $orders = Order::whereHas('user.roles', function (Builder $query) {
            $query->where('name', 'admin');
        })->get();

        dd($orders->toArray());

    }

    public function test_retrieve_book_with_specifeic_language()
    {
        $books = $bookWithLanguage = Book::whereHas('translations', function (Builder $q) {
            $q->where('translatable_type', 'App\Models\Book');


        })->with('translations')->get();
        $bookName = $books->map(function ($book) {
            return $book->translations->where('key', 'name')->value('value');
        });
        dd([$bookWithLanguage->toArray(), $bookName]);

    }

    public function test_retrieve_user_with_most_liked_published_blog()
    {
        $user = User::whereHas('blogs', function (Builder $q) {
            $q->where('published', 1)
              ->whereHas('likes');


        })->withCount('likes')->orderByDesc('likes_count')->get();

        dd($user->toArray());
    }


    public function test_retrieve_books_with_custom_ordering()
    {

        $books = $mostOrderedProduct = Book::select(['books.*', DB::raw('COUNT(order_items.id) as orders_count')])
                                           ->join('order_items', 'books.id', '=', 'order_items.book_id')
                                           ->join('orders', 'order_items.order_id', '=', 'orders.id')
                                           ->groupBy('books.id')
                                           ->orderByRaw('orders_count DESC')
                                           ->get();


//        dd($books->toArray());

        dd($books->toArray());
    }

    public function test_retrieve_books_with_custom_ordering2()
    {

        $books = DB::table('books')
                   ->select('books.*', DB::raw('(SELECT COUNT(order_items.id) FROM order_items INNER JOIN orders ON order_items.order_id = orders.id WHERE order_items.book_id = books.id) as orders_count'))
                   ->whereNull('books.deleted_at')
                   ->orderByDesc('orders_count')
                   ->get();

        dd($books->toArray());
    }

    public function test_retrieve_books_with_custom_ordering3()
    {
        $books = DB::table('books')
                   ->select('books.*', DB::raw('COUNT(order_items.id) as orders_count'))
                   ->join('order_items', 'books.id', '=', 'order_items.book_id')
                   ->join('orders', 'order_items.order_id', '=', 'orders.id')
                   ->groupBy('books.id')
                   ->orderByDesc('orders_count')
                   ->toSql();


        dd($books);
    }

    public function test_retrieve_blog_with_comment_count_with_last_comment()
    {
        $blogs = Blog::withCount('comments')
                     ->with(['comments' => function ($q) {
                         $q->latest();
                     }])->get();


        dd($blogs->toArray());

    }


    public function test_retrieve_blog_with_comment_count_with_last_comment2()
    {
        $blogs = Blog::withCount('comments');
        dd($blogs->toArray());

    }


    public function test_find_order_by_books_writer2()
    {
        $user = User::whereHas('orders.items.book', function ($q) {
            $q->whereHas('translations', function ($q) {
                $q->where('translatable_type', 'App\Models\Book')
                  ->where('key', 'publication')
                  ->where('value', 'نسیم');

            });
        })->toSql();


        dd($user);

    }


    public function test_find_users_orders_book_with_unique_category()
    {
        $user = User::whereHas('orders.items.book', function (Builder $q) {
            $q->whereHas('translations', function (Builder $q) {
                $q->where('translatable_type', 'App\Models\Category')
                  ->where('key', 'name')
                  ->where('value', 'someCategory');
            });
        })->toSql();

        dd($user);

    }


    public function test_count_roles()
    {
        $roles = Role::withCount('users')
                     ->orderBy('users_count')
                     ->get();


        dd($roles->toArray());
    }

    public function test_count_user_roles()
    {
        $users = User::with(['roles:name'])->get();

        dd($users->toArray());

    }

    public function test_count_user_roles2()
    {
        $users = User::with(['roles' => function ( $query) {
            $query->select('id' , 'name');
        }])->get();

        dd($users->toArray());
    }

    public function test_retrieve_users_order_count()
    {
        $user= User::find(3);

       $result=  $user->loadCount('orders');


        dd($result->toArray());
    }
}
