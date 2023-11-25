<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\ActivationCode;
use App\Models\Opinion;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Notice;
use App\Models\User;
use Database\Factories\OpinionFactory;
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
            Opinion::factory(1)->create([
                'user_id' => $user->id,
            ]);
            ActivationCode::factory(3)->create([
                'user_id' => $user->id,
            ]);
        });
    }
}
