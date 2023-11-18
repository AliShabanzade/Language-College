<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Enums\StatusEnum;
use App\Models\SmsConfig;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class SmsConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SmsConfig::firstOrCreate([
            'status' => StatusEnum::ACTIVE,
            'name' => 'ali',
            'password'=>'123456',
            'username' => '2586458'
        ]);
    }
}
