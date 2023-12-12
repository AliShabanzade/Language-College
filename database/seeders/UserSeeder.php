<?php

namespace Database\Seeders;

use App\Actions\View\AddView;
use App\Enums\RoleEnum;
use App\Models\ActivationCode;
use App\Models\Blog;
use App\Models\Book;
use App\Models\Cart;
use App\Models\Comment;
use App\Models\Gallery;
use App\Models\Like;
use App\Models\Notice;
use App\Models\Opinion;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\View;
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
        User::factory(5)->create()->each(function (User $user) {
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
            Order::factory(5)->afterCreating(function (Order $order){
                OrderItem::factory(3)->create([
                   'order_id' => $order->id,
                ]);
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
                Gallery::factory(1)->create([
                    'user_id' => $user->id,
                ])->each(function (Gallery $gallery) {
                    Comment::factory(1)
                           ->create([
                               'commentable_type' => Gallery::class,
                               'commentable_id'   => $gallery->id,
                           ]);
                })->each(function (Gallery $gallery) {
                    Like::factory(1)->create([
                        'likeable_id'   => $gallery->id,
                        'likeable_type' => Gallery::class,
                    ]);
                });
                Notice::factory(1)->create([
                    'user_id' => $user->id,
                ])->each(function (Notice $notice) {
                    Comment::factory(1)->create([
                        'commentable_type' => Notice::class,
                        'commentable_id'   => $notice->id,
                    ]);
                })->each(function (Notice $notice) {
                    Like::factory(1)->create([
                        'likeable_id'   => $notice->id,
                        'likeable_type' => Notice::class,

                    ]);
                });
            });



        });


    }
}
