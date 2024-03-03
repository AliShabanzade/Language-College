<?php

namespace Tests\Unit;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_that_true_is_true()
    {
        $this->assertTrue(true);
        $order = Order::query()
                      ->whereHas('user', function (Builder $query) {
       dd($query);
//                          $query->where('name', '!=', null);
                      })->get();
        dd($order);

    }

    public function test_that_true_is_true2()
    {
        $users = User::all();
        dd($users->toArray());

    }

    public function test_12()
    {
        //Retrieve all orders with their associated user's name and email.
       $t12= Order::with('user:id,name,email')->get();
       dd($t12);
    }

    public function test_13()
    {
        //Get the total number of order items for each order.
       $t13= Order::withCount('items')->get();
        dd($t13);
    }

    public function test_3()
    {
        $arr=[12,14,16,18];
        $arrI=[];
        for($i=0;$i<=4;$i++ ){
            for($j=4;$j>=1;$j++){
                $arrI[]=$arr[$j];
            }
        };
        dd($arrI);
    }

}
