<?php

namespace Database\Seeders;

use App\Enums\RoleEnums;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (RoleEnums::cases() as  $case){
            Role::firstOrCreate([
                'name' => $case->value,
            ]);
        }
    }
}
