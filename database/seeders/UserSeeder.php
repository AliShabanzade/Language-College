<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\ActivationCode;
use App\Models\Blog;
use App\Models\Book;
use App\Models\Cart;
use App\Models\Comment;
use App\Models\Fav;
use App\Models\Gallery;
use App\Models\Like;
use App\Models\Notice;
use App\Models\Opinion;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Traits\HasRoles;

class UserSeeder extends Seeder
{
    use HasRoles;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name'             => 'admin',
            'mobile'           => '09151111111',
            'mobile_verify_at' => now(),
            'password'         => 'password',
        ]);


        $admin->syncRoles(RoleEnum::ADMIN->value);
        User::factory(1)->create()->each(function (User $user) {
            ActivationCode::factory(3)->create([
                'user_id' => $user->id,
            ]);

            Opinion::factory(1)->create([
                'user_id' => $user->id,
            ]);

            Book::factory(5)->create([
                'user_id' => $user->id,
            ]);


            Cart::factory(3)->create([
                'user_id' => $user->id,
                'book_id' => book::factory(),
            ]);

            Order::factory(1)->afterCreating(function (Order $order) {
                $price = 0;
                OrderItem::factory(2)->create([
                    'order_id' => $order->id,
                ])->each(function (OrderItem $orderItem) use (&$price) {
                    $price += $orderItem->price * $orderItem->quantity;
                });
                $order->update(['total' => $price]);
            })->create([
                'user_id' => $user->id,
            ]);

            Blog::factory(2)->create([
                'user_id' => $user->id,
            ])->each(function (Blog $blog) use ($user) {
                Like::factory(1)->create([
                    'user_id'       => $user->id,
                    'likeable_id'   => $blog->id,
                    'likeable_type' => Blog::class
                ]);
//                View::factory(1)->create([
//                    'user_id' => $user->id,
//                    'viewable_id' => $blog->id,
//                    'viewable_type' => Blog::class
//                ]);
                Comment::factory(1)->create([
                    'user_id'          => $user->id,
                    'commentable_id'   => $blog->id,
                    'commentable_type' => Blog::class
                ])->each(function (Comment $comment) use ($user) {
                    Like::factory(1)->create([
                        'user_id'       => $user->id,
                        'likeable_id'   => $comment->id,
                        'likeable_type' => Comment::class
                    ]);
                });
            });

            Gallery::factory(5)->create([
                'user_id' => $user->id,
            ])->each(function (Gallery $gallery) use ($user) {
                Comment::factory(1)->create([
                    'commentable_type' => Gallery::class,
                    'commentable_id'   => $gallery->id,
                    'user_id'          => User::factory(),
                ]);
                Like::factory(1)->create([
                    'likeable_id'   => $gallery->id,
                    'likeable_type' => Gallery::class,
                    'user_id'       => $user->id,
                ]);
                Fav::factory(5)->create([
                    'favable_id'   => $gallery->id,
                    'favable_type' => Gallery::class,
                    'user_id'      => $user->id,

                ]);
            });
            Notice::factory(5)->create([
                'user_id' => $user->id,
            ])->each(function (Notice $notice) use ($user) {
                Comment::factory(1)->create([
                    'commentable_type' => Notice::class,
                    'commentable_id'   => $notice->id,
                    'user_id'          => User::factory(),

                ]);
                Like::factory(1)->create([
                    'likeable_id'   => $notice->id,
                    'likeable_type' => Notice::class,
                    'user_id'       => $user->id,

                ]);
                Fav::factory(5)->create([
                    'favable_id'   => $notice->id,
                    'favable_type' => Notice::class,
                    'user_id'      => $user->id,
                ]);
            });
        });
    }
}
