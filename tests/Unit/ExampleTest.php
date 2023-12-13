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

}
