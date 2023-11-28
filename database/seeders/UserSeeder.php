<?php

namespace Database\Seeders;

use App\Enums\CategoryEnum;
use App\Enums\RoleEnum;
use App\Models\ActivationCode;
use App\Models\Book;
use App\Models\Cart;
use App\Models\Category;
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
            'name'          => 'admin',
            'mobile' => '09151111111',
            'mobile_verify_at'     => now(),
            'password' => 'password',
        ]);


        $admin->syncRoles(RoleEnum::ADMIN->value);
        User::factory(5)->create()->each(function (User $user) {
            ActivationCode::factory(3)->create([
                'user_id' => $user->id,
            ]);
 //__________________________________Start of Book__________________________________________
            Book::factory(5)->create([
                'user_id'=>  $user->id,
            ]);
 //__________________________________End OF Book____________________________________________


//  -------------------------------Start OF Cart---------------------------------------------
            Cart::factory(3)->create([
                'user_id' => $user->id,
                'book_id' => book::factory(),
            ]);
//----------------------------------End Of Cart-----------------------------------------------
        });


    }
}
