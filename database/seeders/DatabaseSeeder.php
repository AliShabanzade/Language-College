<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\SmsConfig;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

      $this->call([
          UserSeeder::class,
          SmsConfigSeeder::class,
          PermissionSeeder::class,
          RoleSeeder::class,
      ]);
    }
}
