<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (RoleEnum::cases() as  $case){
            Role::firstOrCreate([
                'name' => $case->value,
            ]);
        }

        $role = Role::where('name',RoleEnum::ADMIN->value)->first();
        $role->syncPermissions(Permission::all());
    }
}
