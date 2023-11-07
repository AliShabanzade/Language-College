<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\ActivationCode;
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
            'mobile_number' => '09151111111',
            'mobile_verify_at'     => now()
        ]);

        $admin->syncRoles(RoleEnum::ADMIN->value);
        User::factory(5)->create()->each(function (User $user) {
            ActivationCode::factory(3)->create([
                'user_id' => $user->id,
            ]);
        });
    }
}
