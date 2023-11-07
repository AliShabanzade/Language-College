<?php

namespace Database\Seeders;

use App\Enums\PermissionEnums;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (PermissionEnums::cases() as $case){
            Permission::firstOrCreate([
                'name' => $case->value
            ]);
        }
    }
}
