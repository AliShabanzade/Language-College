<?php

namespace Database\Seeders;

use App\Models\SmsConfig;
use Database\Factories\SmsConfigFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SmsConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       SmsConfig::factory(1)->create();
    }
}
