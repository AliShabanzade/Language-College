<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
       Order::whereHas("items", function (Builder $query){

            $query->whereHas("book", function (Builder $query){
                $query->where("price", '>=',10000)->orWhere('price','<',2000);
            })->where("quantity", ">=", 5);
        })->where("total", ">=", 100000)->get();



    }
}
