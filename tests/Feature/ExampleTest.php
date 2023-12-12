<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Blog;
use App\Models\Order;
use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        // orWhare || withCount

//        $data = Order::query()
//                     ->where("user_id", 1)
//                     ->where(function (Builder $query) {
//                         $query->where(function (Builder $query) {
//                             $query->whereHas('items', function ($q) {
//                                 $q->whereIn('book_id', [1, 2])
//                                 ->where('price',1000);
//                             });
//                         })->orWhere(function (Builder $query) {
//                             $query->where('total', ">", 3000)->get();
//                         });
//                     })
//                     ->toSql();


        $data = Order::query()
            ->whereHas('items.book.comments',function (Builder $query){
                $query->where('user_id',1);
            })->toSql();


//        $data = Order::query()
//                     ->where("user_id", 1)
//                     ->where(function (Builder $query) {
//                         $query->whereHas('items', function ($q) {
//                             $q->whereIn('book_id', [1, 2]);
//                         });
//                     })
//                     ->orWhere(function (Builder $query) {
//                         $query->where('total', ">", 3000)->get();
//                     })
//                     ->toSql();

        dd($data);

    }
}
