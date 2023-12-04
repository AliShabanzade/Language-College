<?php

namespace Tests\Unit;

use App\Models\Book;
use Illuminate\Support\Str;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_that_true_is_true(): void
    {
       $data = Book::withExtraAttributes(
           'view_count','=',4
       )->get()->toArray();
       dd($data);
    }
}
