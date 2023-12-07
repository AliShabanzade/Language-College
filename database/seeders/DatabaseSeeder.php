<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Opinion;
use Database\Factories\AttendanceFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            SmsConfigSeeder::class,
            OpinionSeeder::class,
            UserSeeder::class,
            FaqSeeder::class,
            //            NoticeSeeder::class,
            //            GallerySeeder::class,
        ]);
    }
}
