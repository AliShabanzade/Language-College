<?php

namespace Database\Seeders;

use App\Models\ActivationCode;
use App\Models\User;
use Database\Factories\ActivationCodeFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       User::factory(5)->create()->each(function (User $user){
           ActivationCode::factory(3)->create([
               'user_id' => $user->id,
           ]);
       });
    }
}
